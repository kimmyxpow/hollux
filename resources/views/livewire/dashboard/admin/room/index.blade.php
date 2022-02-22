<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Room</h1>

    <div class="flex items-center justify-between">
        <a href="{{ route('dashboard.admin.rooms.create') }}" class="btn">New</a>
        <div class="form-conteol">
            <label for="search" class="label sr-only"></label>
            <input wire:model='search' class="input" type="search" name="search" id="search" placeholder="Search...">
        </div>
    </div>

    <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8">
        @forelse ($rooms as $room)
            <div class="space-y-4">
                <div class="aspect-[8/6]  w-full rounded-tl-2xl rounded-br-2xl overflow-hidden">
                    <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}">
                </div>
                <div class="bg-gray-200 text-sm text-gray-600 flex gap-x-4 gap-y-2 justify-center rounded-tr-lg rounded-bl-lg py-2 px-4">
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-tag-alt'></i>
                        <span class="text-sm capitalize">{{ $room->total_rooms }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-show'></i>
                        <span class="text-sm capitalize">{{ $room->views }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-star'></i>
                        <span class="text-sm capitalize">{{ $room->rate }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-chat'></i>
                        <span class="text-sm capitalize">{{ $room->reviews->count() }}</span>
                    </div>
                    <div class="flex items-center gap-1 text-gray-800">
                        <i class='bx bx-money'></i>
                        <span class="text-sm capitalize">${{ $room->price }}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold font-['poppins'] text-lg text-gray-800">{{ $room->name }}</h3>
                        <a href="{{  url('/dashboard/admin/rooms/' . $room->code) }}" wire:click.prevent='show("{{ $room->code }}")' class="flex items-center gap-1 group">
                            <span class="text-sm text-gray-600 group-hover:underline">Learn more</span>
                            <i class='bx bx-right-arrow-alt'></i>
                        </a>
                    </div>
                    <p class="tracking-wide text-gray-600 sm:text-base text-sm break-words">
                        {{ $room->description }}
                    </p>
                </div>
                <span class="text-sm text-gray-600 bg-gray-200 py-2 text-center rounded-tr-xl rounded-bl-xl block">{{ (int) $room->total_rooms -  (int) $room->reservations->count()}} rooms available</span>
                <div class="flex gap-2">
                    <a class="btn btn-sm" href="{{ route('dashboard.admin.rooms.edit', $room->code) }}">Edit</a>
                    <button wire:click='delete("{{ $room->code }}")' class="btn btn-sm btn-outline">Delete</button>
                </div>
            </div>
        @empty
            <p class="tracking-wide text-gray-600 sm:text-base text-sm">There is nothing here</p>
        @endforelse
    </div>
    {{ $rooms->links() }}
    @if (count($rooms))
        <div x-data='{ open: false }'>
            <div x-show="open" @room:show.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
                <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
                <div wire:click='cancel' x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                    <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-xl w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                        <div class="aspect-[16/9] rounded-tl-2xl rounded-br-2xl overflow-hidden w-full">
                            <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $selectedRoom->image) }}" alt="{{ $selectedRoom->name }}">
                        </div>
                        <div class="bg-gray-200 text-sm text-gray-600 flex gap-x-4 gap-y-2 justify-center rounded-tr-xl rounded-bl-xl py-2 px-4">
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-tag-alt'></i>
                                <span class="text-sm capitalize">{{ $selectedRoom->total_rooms }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-show'></i>
                                <span class="text-sm capitalize">{{ $selectedRoom->views }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-star'></i>
                                <span class="text-sm capitalize">{{ $selectedRoom->rate }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-chat'></i>
                                <span class="text-sm capitalize">{{ $selectedRoom->reviews->count() }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-gray-800">
                                <i class='bx bx-money'></i>
                                <span class="text-sm capitalize">${{ $selectedRoom->price }}</span>
                            </div>
                        </div>
                        <article class="prose sm:prose-base prose-sm max-w-none prose-headings:font-['poppins'] break-words">
                            <h1>{{ $selectedRoom->name }}</h1>
                            <blockquote>
                                {{ $selectedRoom->description }}
                            </blockquote>
                            {!! $selectedRoom->explanation !!}
                            @if (count($selectedRoom->facilities))
                                <h2>Facilities</h2>
                                <ul>
                                    @foreach ($selectedRoom->facilities as $facility)
                                        <li>{{ $facility->facility->name }}</li>
                                    @endforeach
                                </ul>
                                @foreach ($selectedRoom->facilities as $facility)
                                    <h3>{{ $facility->facility->name }}</h3>
                                    <div class="aspect-[16/9] rounded-tl-2xl rounded-br-2xl overflow-hidden w-full not-prose">
                                        <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $facility->facility->image) }}" alt="{{ $facility->facility->name }}">
                                    </div>
                                    <blockquote>
                                        {{ $facility->facility->description }}
                                    </blockquote>
                                    {!! $facility->facility->explanation !!}
                                @endforeach
                            @endif
                        </article>
                        <span class="text-sm text-gray-600 bg-gray-200 py-2 text-center rounded-tr-xl rounded-bl-xl block">{{ (int) $selectedRoom->total_rooms -  (int) $selectedRoom->reservations->count()}} rooms available</span>
                        <button type="button" wire:click="cancel" x-on:click="open = false" class="btn">
                            Okay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div x-data='{ open: false }'>
        <div x-show="open" @room:deleted.window="open = false" @room:delete.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
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
    <div x-data="{ open: false }">
        <div x-show="open" @room:deleted.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Deleted Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                            The room data has been successfully deleted!
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
