<div class="mt-2 pt-1">
        @if ($showComments)
            <flux:button variant="ghost" wire:click="toggleComments" :loading="false" size="xs" icon:trailing="chevron-up">
                Hide Comments
            </flux:button>
        @else
            <flux:button variant="ghost" wire:click="toggleComments" :loading="false" size="xs" icon:trailing="chevron-down">
                Show Comments
            </flux:button>
        @endif
    <div class="mt-2">
        @if($showComments)
            <flux:textarea wire:model="commentText" rows="auto" placeholder="Write a comment..." />
            <div class="flex justify-between mt-2">
                <flux:button wire:click="addComment" size="sm" :loading="false" variant="primary">Comment</flux:button>
                <flux:input type="file" size="sm" wire:model="image" class="mx-2" />
            </div>
            <div class="mt-4 space-y-3 max-h-72 overflow-y-scroll pr-2">
                @foreach($comments as $comment)
                    <div class="rounded-xl">
                        <div class="flex justify-between mb-1 items-start">
                            <div class="flex flex-row items-start">
                                <flux:profile circle :chevron="false" />
                                <div>
                                    <flux:text class="text-m mx-1" variant="strong"> {{ $comment->user->name ?? 'ไม่ทราบชื่อ' }}</flux:text>
                                    <flux:text class="mx-1">{{ $comment->body }}</flux:text>
                                    @if($comment->image_path)
                                        <img src="{{ Storage::url($comment->image_path) }}"
                                            class="mt-2 max-w-64 object-cover rounded-lg shadow" />
                                    @endif
                                </div>
                            </div>
                            @if($comment->user_id === auth()->id())
                                <button wire:click="deleteComment({{ $comment->id }})">
                                    <flux:icon.trash class="w-4 h-4 text-red-500 mt-1" title="delete your comment"/>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>