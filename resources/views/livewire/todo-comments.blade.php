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
                        @if ($editingCommentId === $comment->id)
                            <div class="space-y-2 mt-2">
                                <flux:textarea placeholder="Leave your comment here..." wire:model.defer="editingCommentText" />
                                <div class="flex gap-2 mt-1">
                                    <flux:button variant="primary" wire:click="updateComment" :loading="false">save</flux:button>
                                    <flux:button variant="filled" wire:click="cancelEdit" :loading="false">cancel</flux:button>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-between mb-1 items-start">
                                <div class="flex flex-row items-start">
                                    <flux:profile circle :chevron="false" />
                                    <div>
                                        <flux:text class="text-m mx-1" variant="strong"> {{ $comment->user->name ?? 'ไม่ทราบชื่อ' }}
                                        </flux:text>
                                        <flux:text class="mx-1">{{ $comment->body }}</flux:text>
                                        @if($comment->image_path)
                                            <img src="{{ Storage::url($comment->image_path) }}"
                                                class="mt-2 max-w-64 object-cover rounded-lg shadow" />
                                        @endif
                                    </div>
                                </div>
                                @if($comment->user_id === auth()->id())
                                    <div>
                                        <button wire:click="editComment({{ $comment->id }})" title="edit your comment">
                                            <flux:icon.pencil class="w-4 h-4" />
                                        </button>
                                        <button
                                            onclick="confirm('Are you sure you want to delete this comment?') || event.stopImmediatePropagation()"
                                            wire:click="deleteComment({{ $comment->id }})">
                                            <flux:icon.trash class="w-4 h-4 text-red-500 mt-1" title="delete your comment" />
                                        </button>
                                    </div>
                                @endif
                        @endif
                        </div>
                @endforeach
                </div>
        @endif
        </div>
    </div>