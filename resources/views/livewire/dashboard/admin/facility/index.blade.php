<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Facility</h1>
    
    <div class="flex justify-between items-center">
        <a href="{{ route('dashboard.admin.facilities.create') }}" class="btn">New</a>
        <div class="form-conteol">
            <label for="search" class="label sr-only"></label>
            <input wire:model='search' class="input" type="search" name="search" id="search" placeholder="Search...">
        </div>
    </div>

    <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-10">
        @forelse ($facilities as $facility)
            <div class="space-y-4">
                <div class="aspect-[5/4] rounded-tr-2xl rounded-bl-2xl overflow-hidden">
                    <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}">
                </div>
                <div class="bg-gray-200 text-sm text-gray-600 flex gap-x-4 gap-y-2 justify-center rounded-tr-lg rounded-bl-lg py-2 px-4">
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-tag-alt'></i>
                        <span class="text-sm capitalize">{{ $facility->type }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-show'></i>
                        <span class="text-sm capitalize">{{ $facility->views }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-star'></i>
                        <span class="text-sm capitalize">{{ $facility->rate }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-chat'></i>
                        <span class="text-sm capitalize">{{ $facility->reviews->count() }}</span>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <h3 class="font-bold font-['poppins'] text-lg text-gray-800">{{ $facility->name }}</h3>
                    <a href="{{  url('/dashboard/admin/facilities/' . $facility->code) }}" wire:click.prevent='show("{{ $facility->code }}")' class="flex items-center gap-1 group">
                        <span class="text-sm text-gray-600 group-hover:underline">Learn more</span>
                        <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
                <p class="tracking-wide text-gray-600 sm:text-base text-sm break-words">
                    {{ $facility->description }}
                </p>
                <div class="flex gap-2">
                    <a class="btn btn-sm" href="{{ route('dashboard.admin.facilities.edit', $facility->code) }}">Edit</a>
                    <button wire:click='delete("{{ $facility->code }}")' class="btn btn-sm btn-outline">Delete</button>
                </div>
            </div>
        @empty
            <p class="tracking-wide text-gray-600 sm:text-base text-sm">There is nothing here</p>
        @endforelse
    </div>

    {{ $facilities->links() }}
    
    <div x-data='{ open: false }'>
        <div x-show="open" @facility:deleted.window="open = false" @facility:delete.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
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

    @if (count($facilities))
        <div x-data='{ open: false }'>
            <div x-show="open" @facility:show.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
                <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
                <div wire:click='cancel' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                    <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-xl w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                        <div class="aspect-[16/9] rounded-tl-2xl rounded-br-2xl overflow-hidden w-full">
                            <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $selectedFacility->image) }}" alt="{{ $selectedFacility->name }}">
                        </div>
                        <div class="bg-gray-200 flex gap-x-4 gap-y-2 justify-center rounded-tr-lg rounded-bl-lg py-2 px-4">
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-tag-alt'></i>
                                <span class="text-sm capitalize">{{ $selectedFacility->type }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-show'></i>
                                <span class="text-sm capitalize">{{ $selectedFacility->views }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-star'></i>
                                <span class="text-sm capitalize">{{ $selectedFacility->rate }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-chat'></i>
                                <span class="text-sm capitalize">{{ $selectedFacility->reviews->count() }}</span>
                            </div>
                        </div>
                        <article class="prose sm:prose-base prose-sm max-w-none prose-headings:font-['poppins'] break-words">
                            <h1>{{ $selectedFacility->name }}</h1>
                            <blockquote>
                                {{ $selectedFacility->description }}
                            </blockquote>
                            {!! $selectedFacility->explanation !!}
                        </article>
                        <div class="flex space-x-2">
                            <button type="button" wire:click="cancel" x-on:click="open = false" class="btn">
                                Okay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div x-data="{ open: false }">
        <div x-show="open" @facility:deleted.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Deleted Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            The facility data has been successfully deleted!
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
