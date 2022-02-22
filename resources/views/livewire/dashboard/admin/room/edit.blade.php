<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">New Room</h1>

    <a href="{{ route('dashboard.admin.rooms.index') }}" class="btn">Back</a>

    <form class="space-y-4" action="#" method="POST" wire:submit.prevent='update'>
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="form-control">
                <label class="label" for="name">Name</label>
                <input wire:model='name' class="input" type="text" name="name" id="name">
                @error('name')
                    <span class="invalid">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="total_rooms">Total Rooms</label>
                <input wire:model='total_rooms' class="input" type="number" name="total_rooms" id="total_rooms">
                @error('total_rooms')
                    <span class="invalid">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="price">Price/Night</label>
                <input wire:model='price' class="input" type="number" name="price" id="price">
                @error('price')
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
            <div class="form-control sm:col-span-2">
                <label for="explanation" class="label">Explanation</label>
                <div wire:ignore class="max-w-full overflow-x-auto"><textarea wire:model='explanation' name="explanation" id="explanation"></textarea></div>
                @error('explanation')
                    <span class="invalid">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-control sm:col-span-2">
                <label class="label">Facilities</label>
                <div class="flex flex-wrap gap-4">
                    @foreach ($facilities as $facility)
                        <label for="{{ $facility->code }}" class="bg-gray-100 py-2 px-4 rounded-tr-xl rounded-bl-xl flex items-center gap-1 cursor-pointer">
                            <input wire:model="selectedFacilities.{{ $facility->code }}" {{ in_array($facility->code, $roomFacilities) ? 'checked="true"' : '' }} value="{{ $facility->code }}" class="checkbox cursor-pointer" type="checkbox" name="selectedFacilities[]" id="{{ $facility->code }}">
                            <span>{{ $facility->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" class="sm:col-span-2 space-y-4">
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
                @else
                    <div wire:loading.class="blur-sm" wire:target='image' class="aspect-[16/9] rounded-tr-2xl rounded-bl-2xl overflow-hidden w-full">
                        <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $oldImage) }}">
                    </div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn" wire:loading.attr="disabled">Update</button>
    </form>
    <div x-data="{ open: false }">
        <div x-show="open" @room:edited.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Edited Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            Room data edited successfully! You can check it on the room dashboard!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <a href="{{ route('dashboard.admin.rooms.index') }}" class="btn">
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
        document.addEventListener('livewire:load', function () {
            ClassicEditor
            .create( document.querySelector( '#explanation' ) )
            .then(editor => {
                editor.setData(@this.explanation);
                editor.model.document.on('change:data', () => {
                    @this.set('explanation', editor.getData());
                });
            })
            .catch( error => {
                console.error( error );
            });
        });
    </script>
</x-slot>