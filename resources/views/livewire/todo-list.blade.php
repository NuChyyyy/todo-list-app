<div class="max-w-lg mx-auto mt-10">
    <form wire:submit.prevent="addTodo" class="flex gap-2 mb-4">
        <input type="text" wire:model="newTodo" class="border rounded px-3 py-2 w-full" placeholder="Add a task...">
        <button class="bg-rose-400 text-black px-4 py-2 rounded">Add</button>
    </form>

    <ul class="space-y-2">
        @if($todos->count())
        @foreach($todos as $todo)
            <li class="flex justify-between items-center p-3 bg-neutral-200 text-black rounded {{ $todo->is_done ? 'border bg-neutral-700' : '' }}">
                <div class="flex items-center gap-2">
                    <input type="checkbox" wire:click="toggleDone({{ $todo->id }})" {{ $todo->is_done ? 'checked' : '' }}>
                    <span class="{{ $todo->is_done ? 'line-through text-gray-500' : '' }}">{{ $todo->title }}</span>
                </div>
                @if($todo->user_id === auth()->id())
                    <button wire:click="deleteTodo({{ $todo->id }})" class="text-red-500 hover:underline">Delete</button>
                @endif
            </li>
        @endforeach
        @else
        <div class="flex items-center gap-2">Don't have a task yet.</div>
        @endif
    </ul>
</div>