<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Galery</h1>
    
    <livewire:dashboard.admin.galery.create />
    
    <div x-data='{ open: false }'>
        <div x-show="open" @galery:edited.window="open = false" @galery:edit.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <form method="POST" action="#"  wire:click='cancel' wire:submit.prevent='update' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-edit text-8xl text-orange-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Edit Image</h2>
                    </div>
                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                        class="space-y-4"
                    >
                        <div class="form-control">
                            <label for="new_image" class="btn w-full text-center">New Image</label>
                            <input class="sr-only" type="file" id="new_image" wire:model='new_image'>
                            @error('new_image')
                                <span class="invalid text-left">{{ $message }}</span>
                            @enderror
                        </div>
                        <div x-show="isUploading" class="rounded-tr-xl rounded-bl-xl overflow-hidden">
                            <progress max="100" class="w-full" x-bind:value="progress"></progress>
                        </div>
                    </div>

                    @if ($new_image)
                        <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl">
                            <img class="w-full" wire:loading.class="blur-sm" wire:target="new_image" src="{{ $new_image->temporaryUrl() }}">
                        </div>
                    @else
                        <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl">
                            <img class="w-full" wire:loading.class="blur-sm" wire:target="new_image" src="{{ asset('storage/' . $oldImage) }}">
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
                        <button type="submit" class="btn">
                            Confirm
                        </button>
                        <button type="button" x-on:click="open = false" wire:click='cancel' class="btn btn-outline">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div x-data='{ open: false }'>
        <div x-show="open" @galery:deleted.window="open = false" @galery:delete.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div wire:click='cancel' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-info-circle text-8xl text-red-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Are You Sure?</h2>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" wire:click="destroy" class="btn">
                            Yeah!
                        </button>
                        <button type="button" x-on:click="open = false" wire:click='cancel' class="btn btn-outline">
                            Nah!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md:columns-3 sm:columns-2 gap-4 space-y-4">
        @forelse ($galeries as $galery)
            <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl relative">
                <div class="flex space-x-4 absolute top-4 left-4 z-10">
                    <button class="btn btn-icon" wire:click="edit('{{ $galery->code }}')">
                        <i class='bx bx-edit'></i>
                    </button>
                    <button class="btn btn-icon" wire:click="delete('{{ $galery->code }}')">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
               <img class="w-full hover:scale-110 transition-all duration-300 relative z-0" src="{{ asset('storage/' . $galery->image) }}" alt="{{ $galery->title }}" title="{{ $galery->title }}">
           </div>
        @empty
            <p class="tarcking-wide text-gray-600 sm:text-base text-sm">There is nothing here</p>
        @endforelse
    </div>

    <div x-data="{ open: false }">
        <div x-show="open" @galery:created.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Added Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            New image successfully added to gallery!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" x-on:click="open = false" class="btn">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @galery:edited.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Edited Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            Gallery successfully updated!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" x-on:click="open = false" class="btn">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @galery:deleted.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Deleted Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            Image successfully removed from gallery!
                        </p>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" x-on:click="open = false" class="btn">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
