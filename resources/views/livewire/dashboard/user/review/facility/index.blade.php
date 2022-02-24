<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Facility Review</h1>
    <div class="space-y-6">
        @forelse ($reviews as $review)
            <div class="bg-gray-100 p-6 rounded-tr-xl rounded-bl-xl space-y-2">
                <span class="block text-gray-600 font-bold text-lg">For: <a class="underline" href="{{ route('facilities.index', $review->facility->code) }}">{{ $review->facility->name }}</a></span>
                <div>
                    @for ($i=1; $i <= $review->star; $i++)
                        <i class="bx bx-star text-lg text-orange-500"></i>
                    @endfor
                </div>
                <p class="tracking-wide text-gray-800 sm:text-base text-sm">
                    "{!! nl2br($review->message) !!}"
                </p>
                <div class="flex gap-2">
                    <button class="btn btn-sm ring-offset-gray-100 text-gray-100" wire:click='edit("{{ $review->code }}")'>Edit</button>
                    <button class="btn btn-sm btn-outline bg-gray-100 ring-offset-gray-100" wire:click='delete("{{ $review->code }}")'>Delete</button>
                </div>
            </div>
        @empty
            <p class="text-gray-600 tracking-wide sm:text-base text-sm">There is nothing here</p>
        @endforelse
    </div>
    <div x-data='{ open: false }'>
        <div x-show="open" @review:edited.window="open = false" @review:edit.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <form method="POST" action="#"  wire:submit.prevent='update' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-edit text-8xl text-orange-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Edit Review</h2>
                    </div>
                    <div class="grid gap-2">
                        <div class="form-control">
                            <label for="star" class="label">Star</label>
                            <div>
                                @for ($i = 0; $i < $star; $i++)
                                    <i wire:click="setRating({{ $i+1 }})" class='bx bx-star text-lg cursor-pointer text-orange-600'></i>
                                @endfor

                                @for ($i = $star; $i < 5; $i++)
                                    <i wire:click="setRating({{ $i+1 }})" class='bx bx-star text-lg cursor-pointer text-gray-400'></i>
                                @endfor
                            </div>
                            @error('star')
                                <span class="text-red-500 italic font-medium text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label for="message" class="label">Message</label>
                            <textarea placeholder="Message..." wire:model="message" id="message" class="textarea" rows="6"></textarea>
                            @error('message')
                                <span class="text-red-500 italic font-medium text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="submit" class="btn">
                            Confirm
                        </button>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @review:edited.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Review Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">Your review has been successfully submitted! Thank you for your review!</p>
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
    <div x-data='{ open: false }'>
        <div x-show="open" @review:deleted.window="open = false" @review:delete.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-info-circle text-8xl text-red-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Are You Sure?</h2>
                    </div>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" wire:click="destroy" class="btn">
                            Yeah!
                        </button>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Nah!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @review:deleted.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Deleted Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            Review successfully deleted! Thank you for participating in assessing our performance!
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
