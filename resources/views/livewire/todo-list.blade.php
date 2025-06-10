@php use Illuminate\Support\Str; @endphp

<div class="max-w-lg mx-auto mt-10">
    <flux:field class="mb-4">
        <div class="flex justify-between gap-2">
            <flux:input placeholder="Add a task..." wire:model="newTodo"/>
            <flux:button variant="primary" wire:click="addTodo" :loading="false">Add</flux:button>
        </div>
    </flux:field>
    <ul class="space-y-2">
        @if($todos->count())
            @foreach($todos as $todo)
                <li wire:key="todo-{{ $todo->id }}"
                    class="p-3 rounded-lg {{ $todo->is_done ? '' : ' bg-zinc-800' }}">
                    @if($editingId === $todo->id)
                        <div class="space-y-2">
                            <flux:textarea placeholder="Filter by..." wire:model.defer="editingTitle" />
                            <div class="flex gap-2 mt-1">
                                <flux:button variant="primary" wire:click="saveEdit" :loading="false">save</flux:button>
                                <flux:button variant="filled" wire:click="cancelEdit" :loading="false">cancel</flux:button>
                            </div>
                        </div>
                    @endif
                    <div class="flex justify-between items-center">
                        @if (!$editingId)
                        <div class="flex items-center gap-2">
                            <input type="checkbox" wire:click="toggleDone({{ $todo->id }})" {{ $todo->is_done ? 'checked' : '' }}>
                            <span title="{{ $todo->title }}" class="{{ $todo->is_done ? 'line-through text-zinc-400 text-md' : 'text-lg' }}">
                                {{ Str::limit($todo->title, 20) }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($todo->user_id === auth()->id())
                                @if (!$todo->is_done)
                                    <button wire:click="startEdit({{ $todo->id }})" title="edit your task">
                                        <flux:icon.pencil class="w-5 h-5" />
                                    </button>
                                    @endif
                                <button onclick="confirm('Are you sure you want to delete this task?') || event.stopImmediatePropagation()" 
                                wire:click="deleteTodo({{ $todo->id }})" title="delete your task">
                                    <flux:icon.trash class="w-5 h-5 text-red-500" />
                                </button>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="flex justify-between mt-1">
                        <flux:text class="text-xs">Create by {{ $todo->user->name ?? 'ไม่ทราบ' }}</flux:text>
                        @if($todo->is_done)
                            <flux:text class="text-xs">Checked by {{ $todo->checker->name ?? 'Unknown' }} at
                                {{ $todo->updated_at->format('d M Y H:i') }}
                            </flux:text>
                        @endif
                    </div>
                    <livewire:todo-comments :todo="$todo->toArray()" :key="'todo-comments-' . $todo->id" />
                </li>
            @endforeach
        @else
            <div class="flex items-center gap-2">Don't have a task yet.</div>
        @endif
    </ul>
</div>