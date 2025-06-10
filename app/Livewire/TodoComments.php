<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Comment;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TodoComments extends Component
{
    use WithFileUploads;

    public $todoId;
    public $todo;
    public $showComments = false;
    public $commentText = '';
    public $image;
    public $comments = [];
    public $editingCommentId = null;
    public $editingCommentText = '';

    public function mount($todo)
    {
        if (is_object($todo)) {
            $this->todoId = $todo->id;
        } elseif (is_array($todo) && isset($todo['id'])) {
            $this->todoId = $todo['id'];
        }

        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = Comment::with('user')
            ->where('todo_id', $this->todoId)
            ->latest()
            ->get();
    }

    public function toggleComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function addComment()
    {
        if (empty($this->commentText) && !$this->image) {
            $this->addError('commentText', 'Please leave a comment or attach a image.');
            return;
        }

        // validate เฉพาะ image (ไม่บังคับข้อความแล้ว)
        $this->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $this->image ? $this->image->store('comments', 'public') : null;

        Comment::create([
            'user_id' => Auth::id(),
            'todo_id' => $this->todoId,
            'body' => $this->commentText,
            'image_path' => $path,
        ]);

        $this->commentText = '';
        $this->image = null;
        $this->loadComments();
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id === Auth::id()) {
            if ($comment->image_path) {
                Storage::disk('public')->delete($comment->image_path);
            }

            $comment->delete();
            $this->loadComments();
        }
    }

    public function editComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== Auth::id()) {
            return;
        }

        $this->editingCommentId = $commentId;
        $this->editingCommentText = $comment->body;
    }

    public function updateComment()
    {
        $this->validate([
            'editingCommentText' => 'string|max:500',
        ]);

        $comment = Comment::findOrFail($this->editingCommentId);

        if ($comment->user_id !== Auth::id()) {
            return;
        }

        $comment->update([
            'body' => $this->editingCommentText,
        ]);

        $this->editingCommentId = null;
        $this->editingCommentText = '';
        $this->loadComments();
    }

    public function cancelEdit()
    {
        $this->editingCommentId = null;
        $this->editingCommentText = '';
    }

    public function render()
    {
        return view('livewire.todo-comments');
    }
}
