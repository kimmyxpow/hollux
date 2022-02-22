<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">New Facility</h1>
    
    <a href="{{ route('dashboard.admin.facilities.index') }}" class="btn">Back</a>

    <form class="space-y-4" action="#" method="POST" wire:submit.prevent='store'>
        <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
            <div class="form-control">
                <label class="label" for="name">Name</label>
                <input wire:model='name' class="input" type="text" name="name" id="name">
                @error('name')
                    <span class="invalid">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="type">Type</label>
                <select wire:model='type' class="input" type="number" name="type" id="type">
                    <option value="public">Public</option>
                    <option value="room">Room</option>
                </select>
                @error('type')
                    <span class="invalid">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="description">Description</label>
                <input wire:model='description' class="input" type="text" name="description" id="description">
                @error('description')
                    <span class="invalid">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control md:col-span-3 sm:col-span-2 col-span-1">
                <label for="explanation" class="label">Explanation</label>
                <div wire:ignore><textarea wire:model='explanation' name="explanation" id="explanation"></textarea></div>
                @error('explanation')
                    <span class="invalid">{{ $message }}</span>
                @enderror
            </div>
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" class="md:col-span-3 sm:col-span-2 col-span-1 space-y-4">
                <div class="form-control relative">
                    <label class="btn" for="image">Upload Image</label>
                    <input wire:model='image' class="sr-only" type="file" name="image" id="image">
                    @error('image')
                        <span class="invalid">{{ $message }}</span>
                    @enderror
                </div>
                <div x-show="isUploading" class="rounded-tr-xl rounded-bl-xl overflow-hidden">
                    <progress max="100" class="w-full" x-bind:value="progress"></progress>
                </div>
                @if ($image)
                    <div wire:loading.class="blur-sm" wire:target='image' class="aspect-[16/9] rounded-tr-2xl rounded-bl-2xl overflow-hidden w-full">
                        <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ $image->temporaryUrl() }}">
                    </div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn" wire:loading.attr="disabled">Add</button>
    </form>
    <div x-data="{ open: false }">
        <div x-show="open" @facility:created.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Added Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            New facility have been added! You can check it on the facility dashboard!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <a href="{{ route('dashboard.admin.facilities.index') }}" class="btn">
                            View List
                        </a>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-slot name="js">
    <script>
        ClassicEditor
            .create( document.querySelector( '#explanation' ) )
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('explanation', editor.getData());
                })
                window.addEventListener('facility:created', () => {
                    @this.set('explanation', null);
                    editor.setData('');
                });
            })
            .catch( error => {
                console.error( error );
            });
    </script>
</x-slot>