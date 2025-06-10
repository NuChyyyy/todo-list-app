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
        $this->validate([
            'commentText' => 'required|string|max:500',
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

    public function render()
    {
        return view('livewire.todo-comments');
    }
}
