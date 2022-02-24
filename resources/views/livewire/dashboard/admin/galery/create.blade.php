<div x-data='{ open: false }'>
    <button class="btn" x-on:click='open = true'>New</button>
    <div x-show="open" @galery:created.window="open = false" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
        <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
        <form method="POST" action="#" wire:submit.prevent='store' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
            <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                <div class="text-center space-y-4">
                    <i class='bx bx-plus-circle text-8xl text-gray-600'></i>
                    <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">New Image</h2>
                </div>
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" class="space-y-4">
                    <div class="form-control">
                        <label for="image" class="btn w-full text-center">Upload Image</label>
                        <input class="sr-only" type="file" id="image" wire:model='image'>
                        @error('image')
                            <span class="invalid text-left">{{ $message }}</span>
                        @enderror
                    </div>
                    <div x-show="isUploading" class="rounded-tr-xl rounded-bl-xl overflow-hidden">
                        <progress max="100" class="w-full" x-bind:value="progress"></progress>
                    </div>
                </div>
                @if ($image)
                    <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl">
                        <img class="w-full" wire:loading.class="blur-sm" wire:target="image" src="{{ $image->temporaryUrl() }}">
                    </div>
                @endif
                <div class="form-control">
                    <label class="label" for="title" class="text-left">Title</label>
                    <input class="input" type="text" id="title" wire:model='title'>
                    @error('title')
                        <span class="invalid text-left">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex space-x-2 justify-center">
                    <button type="submit" class="btn" wire:loading.attr="disabled">
                        Confirm
                    </button>
                    <button type="button" x-on:click="open = false" wire:click='resetAll' class="btn btn-outline">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>