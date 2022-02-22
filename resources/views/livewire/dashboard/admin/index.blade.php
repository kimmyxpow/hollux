<div>
    <h1 class="text-gray-800 text-3xl font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Welcome!!</h1>
    <div class="mt-8 grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
        <h2 class="sr-only">Statistic</h2>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-home-heart'></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Room</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalRooms }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-home-smile' ></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Facilities</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalFacilities }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-images' ></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Galery</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalGalery }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 space-y-4">
        <h2 class="text-gray-800 text-xl font-['poppins'] font-bold capitalize">About Hollux</h2>
        <div class="grid md:grid-cols-2 items-start gap-x-10 gap-y-4">
            <div class="bg-gray-50 p-6 rounded-tr-xl rounded-bl-xl space-y-4">
                <div class="aspect-[16/9] rounded-tr-2xl rounded-bl-2xl overflow-hidden">
                    @if ($image)
                        <img wire:loading.class="blur-sm" wire:target='image' class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ $image->temporaryUrl() }}" alt="About Hollux">
                    @else
                        <img wire:loading.class="blur-sm" wire:target='image' class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $about->image) }}" alt="About Hollux">
                    @endif
                </div>
                <h2 class="text-2xl font-bold text-gray-800">{{ $title }}</h2>
                <p class="text-gray-600 sm:text-base text-sm tracking-wide">
                    {{ $text }}
                </p>
            </div>
            <form wire:submit.prevent='update' class="flex flex-col space-y-4" action="#" method="POST">
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" class="grid gap-4">
                    <label for="image" class="btn">Change Image</label>
                    <input type="file" id="image" name="image" wire:model="image" class="sr-only">
                    <div x-show="isUploading" class="rounded-tr-xl rounded-bl-xl overflow-hidden">
                        <progress max="100" class="w-full" x-bind:value="progress"></progress>
                    </div>
                </div>
                <div class="form-control">
                    <label for="title" class="label">Title</label>
                    <input wire:model="title" type="text" value="{{ $about->title }}" name="title" id="title" class="textarea">
                </div>
                <div class="form-control">
                    <label for="text" class="label">Text</label>
                    <textarea wire:model="text" name="text" id="text" rows="6" class="resize-none textarea">{{ $about->text }}</textarea>
                </div>
                <div class="flex space-x-2">
                    <button class="btn">Update</button>
                    <button wire:click="resetAll" type="button" class="btn btn-outline">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @about:updated.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Edited Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            About page updated successfully! Want to see it?
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <a href="{{ route('about') }}" class="btn">
                            Yeah!
                        </a>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Nah!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
