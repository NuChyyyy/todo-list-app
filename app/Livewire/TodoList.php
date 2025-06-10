<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoList extends Component
{
    public $newTodo;
    public $editingId = null;
    public $editingTitle = '';
    public $editingComment = '';
    public $todos;

    public function mount()
    {
        $this->loadTodos();
    }

    public function loadTodos()
    {
        $this->todos = Todo::with('user')
            ->orderByDesc('created_at')
            ->get();
    }

    public function addTodo()
    {
        $this->validate(['newTodo' => 'required|string|max:255']);

        Todo::create([
            'title' => $this->newTodo,
            'user_id' => Auth::id(),
        ]);

        $this->newTodo = '';
        $this->loadTodos();
    }

    public function deleteTodo($id)
    {
        $todo = Todo::findOrFail($id);

        if ($todo->user_id === Auth::id()) {
            $todo->delete();
            $this->loadTodos();
        }
    }


    public function toggleDone($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->is_done = !$todo->is_done;

        if ($todo->is_done) {
            $todo->checked_by = Auth::id();
        } else {
            $todo->checked_by = null;
        }

        $todo->save();
        $this->loadTodos();
    }

    public function startEdit($id)
    {
        $todo = Todo::findOrFail($id);

        if ($todo->user_id === Auth::id()) {
            $this->editingId = $id;
            $this->editingTitle = $todo->title;
        }
    }

    public function cancelEdit()
    {
        $this->editingId = null;
        $this->editingTitle = '';
    }

    public function saveEdit()
    {
        $todo = Todo::findOrFail($this->editingId);

        if ($todo->user_id === Auth::id()) {
            $this->validate([
                'editingTitle' => 'required|string|max:255',
            ]);

            $todo->title = $this->editingTitle;
            $todo->save();
        }

        $this->cancelEdit();
    }
    public $showComments = false;

    public function toggleComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function render()
    {
        return view('livewire.todo-list');
    }

}
