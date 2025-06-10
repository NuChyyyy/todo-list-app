<x-layouts.app :title="__('Todo list')">
    <div class="flex h-full w-full flex-1 rounded-xl">
        <div class="relative h-full flex-1 overflow-hidden">
            <h1 class="text-2xl font-bold text-primary text-center">Welcome to Todo List</h1>
            <livewire:todo-list />
        </div>
    </div>
</x-layouts.app>
