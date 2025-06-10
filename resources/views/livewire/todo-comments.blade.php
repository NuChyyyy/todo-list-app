<div class="mt-2 pt-1">
    <flux:button variant="subtle" wire:click="toggleComments" :loading="false" size="xs">
        {{ $showComments ? 'Hide Comments' : 'Show Comments' }}
    </flux:button>
    <div class="mt-2">
        @if($showComments)
            <flux:textarea wire:model="commentText" rows="auto" placeholder="Write a comment..." />
            <div class="flex justify-between mt-2">
                <flux:button wire:click="addComment" class="mr-2" :loading="false">comment</flux:button>
                <flux:input type="file" wire:model="image" />
            </div>
            <div class="mt-4 space-y-3 max-h-48 overflow-y-auto pr-2">
                @foreach($comments as $comment)
                    <div class="p-3 rounded-xl">
                        <div class="flex justify-between items-center mb-1">
                            <flux:text class="text-m mt-1" variant="strong"> {{ $todo->user->name ?? 'ไม่ทราบ' }}</flux:text>
                            @if($comment->user_id === auth()->id())
                                <button wire:click="deleteComment({{ $comment->id }})">
                                    <flux:icon.trash class="w-4 h-4 text-red-500" />
                                </button>
                            @endif
                        </div>
                        <flux:text class="mt-2">{{ $comment->body }}</flux:text>

                        @if($comment->image_path)
                            <img src="{{ Storage::url($comment->image_path) }}"
                                class="mt-2 w-32 h-32 object-cover rounded-lg shadow" />
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>