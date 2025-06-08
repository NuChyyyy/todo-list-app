<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoList extends Component
{
    public $newTodo;

    public function addTodo()
    {
        $this->validate(['newTodo' => 'required|string|max:255']);

        Todo::create([
            'title' => $this->newTodo,
            'user_id' => Auth::id(),
        ]);

        $this->newTodo = '';
    }

    public function deleteTodo($id)
    {
        $todo = Todo::findOrFail($id);

        if ($todo->user_id === Auth::id()) {
            $todo->delete();
        }
    }

    public function toggleDone($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->is_done = !$todo->is_done;
        $todo->save();
    }

    public function render()
    {
        $todos = Todo::with('user')->orderByDesc('created_at')->get();

        return view('livewire.todo-list', [
            'todos' => $todos
        ]);
    }
}
