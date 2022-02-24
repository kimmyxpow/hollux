<form wire:submit.prevent='store' method="POST" class="space-y-4">
    <h3 class="text-xl text-gray-800 font-bold">Your Review</h3>
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
    <button class="btn" type="submit">Submit</button>
    <div x-data="{ open: false }">
        <div x-show="open" style="display: none" @review:forbidden.window='open = true' x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4 text-center">
                    <i class='bx bx-info-circle text-8xl text-blue-600'></i>
                    <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">You Can't Do It</h2>
                    <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                        Your role is not a user so you can't place an order!
                    </p>
                    <div class="flex space-x-2 justify-center">
                        <button type="button" x-on:click="open = false" class="btn">
                            Oh.. Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" style="display: none" @review:login.window='open = true' x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4 text-center">
                    <i class='bx bx-info-circle text-8xl text-blue-600'></i>
                    <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Must Login First</h2>
                    <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                        You must login first before making a reservation!
                    </p>
                    <div class="flex space-x-2 justify-center">
                        <a href="{{ route('login') }}" class="btn">
                            Login
                        </a>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Later
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" style="display: none" @review:verified.window='open = true' x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4 text-center">
                    <i class='bx bx-info-circle text-8xl text-blue-600'></i>
                    <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Email Verification First</h2>
                    <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                        You must verify your email first after logging in!
                    </p>
                    <div class="flex space-x-2 justify-center">
                        <a href="{{ route('verification.notice') }}" class="btn">
                            Verification
                        </a>
                        <button type="button" x-on:click="open = false" class="btn btn-outline">
                            Later
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>