<div class="max-w-lg mx-auto mt-10">
    <form wire:submit.prevent="addTodo" class="flex gap-2 mb-4">
        <input type="text" wire:model="newTodo" class="border rounded px-3 py-2 w-full" placeholder="Add a task...">
        <button class="bg-rose-400 text-black px-4 py-2 rounded">Add</button>
    </form>

    <ul class="space-y-2">
        @if($todos->count())
            @foreach($todos as $todo)
                <li wire:key="todo-{{ $todo->id }}">
                    @if($editingId === $todo->id)
                        <div class="space-y-2">
                            <flux:textarea placeholder="Filter by..." wire:model.defer="editingTitle" />
                            <div class="flex gap-2 mt-1">
                                <flux:button variant="primary" wire:click="saveEdit" :loading="false">save</flux:button>
                                <flux:button variant="filled" wire:click="cancelEdit">cancel</flux:button>
                            </div>
                        </div>
                    @endif
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" wire:click="toggleDone({{ $todo->id }})" {{ $todo->is_done ? 'checked' :'' }}>
                            <span class="{{ $todo->is_done ? 'line-through text-zinc-400 text-xs' : 'text-lg' }}">{{ $todo->title }}</span>
                           
                        </div>
                        <div class="flex items-center gap-2">
                            @if($todo->user_id === auth()->id())
                                @if (!$todo->is_done)
                                <button wire:click="startEdit({{ $todo->id }})" title="แก้ไข">
                                    <flux:icon.pencil class="w-5 h-5" />
                                </button>
                                @endif
                                <button wire:click="deleteTodo({{ $todo->id }})" title="ลบ">
                                    <flux:icon.trash class="w-5 h-5 text-red-500" />
                                </button>
                            @endif
                        </div>
                    </div>
                    <flux:text class="text-xs mt-1">By {{ $todo->user->name ?? 'ไม่ทราบ' }}</flux:text>
                    <livewire:todo-comments :todo="$todo->toArray()" :key="'todo-comments-' . $todo->id" />
                </li>
            @endforeach
        @else
            <div class="flex items-center gap-2">Don't have a task yet.</div>
        @endif
    </ul>
</div>