<div>
    <main class="lg:min-h-screen lg:mt-0 mt-32 flex items-center lg:mb-0 mb-10">
        <div class="container px-8 mx-auto grid lg:grid-cols-2 gap-10 items-center">
            <div class="space-y-4 lg:order-1 order-2">
                <h1 class="sm:text-6xl text-gray-800 text-4xl font-['poppins'] font-black">Make Your Travel Easier</h1>
                <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                    Find hotel rooms with 14 complete choices to accompany your trip. We offer many attractive facilities for the convenience of our clients. Interested?
                </p>
                @auth
                    @if (auth()->user()->hasVerifiedEmail())
                        @if (!auth()->user()->hasRole('user'))
                            <div x-data="{ open: false }" class="flex sm:flex-row flex-col sm:space-x-2 sm:space-y-0 space-y-2 sm:items-end">
                                <div class="form-control">
                                    <label class="label" for="check_in">Check In</label>
                                    <input min="2022-01-01" class="w-full input" id="check_in" type="date">
                                </div>
                                <div class="form-control">
                                    <label class="label" for="check_out">Check Out</label>
                                    <input min="2022-01-01" class="w-full input" id="check_out" type="date">
                                </div>
                                <button x-on:click="open = true" class="btn">Order</button>
                                <div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
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
                        @else
                            <div x-data="{ open: false }" class="flex sm:flex-row flex-col sm:space-x-2 sm:space-y-0 space-y-2 sm:items-end">
                                <div class="form-control">
                                    <label for="check_in" class="label">Check In</label>
                                    <input class="input" type="date" name="check_in" id="check_in" wire:model='check_in' wire:change='setCheckIn' min="{{ $minCheckIn }}">
                                    @error('check_in')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-control">
                                    <label for="check_out" class="label">Check Out</label>
                                    <input class="input" type="date" name="check_out" id="check_out" wire:model='check_out' wire:change='setCheckOut' min="{{ $minCheckOut }}">
                                    @error('check_out')
                                        <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button x-on:click="open = true" class="btn">Order</button>
                                <div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
                                    <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
                                    <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                                        <form method="POST" action="#" wire:submit.prevent='reservation' x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-xl w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                                            <div class="text-center space-y-4">
                                                <i class='bx bx-info-circle text-8xl text-blue-600'></i>
                                                <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Choose Your Favorite Room</h2>
                                                <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                                                    If you want to see a list of what rooms we provide, you can see it <a class="underline" href="{{ route('rooms.index') }}">here</a>.
                                                </p>
                                            </div>
                                            <div class="grid sm:grid-cols-2 gap-4 items-start">
                                                <div class="form-control">
                                                    <label for="check_in_modal" class="label">Check In</label>
                                                    <input class="input" type="date" name="check_in" id="check_in_modal" wire:model='check_in' wire:change='setCheckIn' min="{{ $minCheckIn }}">
                                                    @error('check_in')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-control">
                                                    <label for="check_out_modal" class="label">Check Out</label>
                                                    <input class="input" type="date" name="check_out" id="check_out_modal" wire:model='check_out' wire:change='setCheckOut' min="{{ $minCheckOut }}">
                                                    @error('check_out')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-control">
                                                    <label for="selected_room" class="label">Room</label>
                                                    <select class="select" name="selected_room" id="selected_room" wire:change='setPrice' wire:model='selected_room'>
                                                        @if (count($rooms->where("available", ">", 0)) > 0)    
                                                            <optgroup label="Available">
                                                                @foreach ($rooms->where("available", ">", 0) as $room)
                                                                    <option value="{{ $room->code }}">{{ $room->name }}</option>  
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                        @if (count($rooms->where("available", "=", 0)) > 0)
                                                            <optgroup label="Not Available" disabled>
                                                                @foreach ($rooms->where("available", "=", 0) as $room)
                                                                    <option>{{ $room->name }}</option>  
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    </select>
                                                    @error('selected_room')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-control">
                                                    <label for="total_rooms" class="label">Total Rooms</label>
                                                    <input class="input" type="number" name="total_rooms" id="total_rooms" wire:model='total_rooms' wire:keyup='setPrice'>
                                                    @error('total_rooms')
                                                        <span class="invalid">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if ($check_in && $check_out && $total_rooms && $selected_room)
                                                <p class="tracking-wide text-gray-600 sm:text-base text-sm">Total price to pay for this <span class="font-bold">{{ $totalDays }}</span> day stay with <span class="font-bold">{{ $total_rooms }} {{ $room_name }}</span> rooms is <span class="font-bold">${{ $totalPrice }}</span>. <span class="font-bold">Paid directly at the hotel, not online.</span></p>
                                            @endif
                                            <div class="flex space-x-2 justify-center">
                                                <button class="btn">
                                                    Confirm
                                                </button>
                                                <button type="button" wire:click="resetAll" x-on:click="open = false" class="btn btn-outline">
                                                    Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{ open: false }">
                                <div x-show="open" @reservation:created.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
                                    <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
                                    <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                                        <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                                            <div class="text-center space-y-4">
                                                <i class='bx bx-check-circle text-8xl text-green-600'></i>
                                                <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Reservation Successfully</h2>
                                                <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                                                    You have successfully made a reservation! Wait for confirmation from the receptionist first. You can view your reservation data on the dashboard.
                                                </p>
                                            </div>
                                            <div class="flex space-x-2 justify-center">
                                                <a href="{{ route('dashboard.user.reservations.index') }}" class="btn">
                                                    View Reservations
                                                </a>
                                                <button type="button" x-on:click="open = false" class="btn btn-outline">
                                                    Okay
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div x-data="{ open: false }" class="flex sm:flex-row flex-col sm:space-x-2 sm:space-y-0 space-y-2 sm:items-end">
                            <div class="form-control">
                                <label class="label" for="check_in">Check In</label>
                                <input min="2022-01-01" class="w-full input" id="check_in" type="date">
                            </div>
                            <div class="form-control">
                                <label class="label" for="check_out">Check Out</label>
                                <input min="2022-01-01" class="w-full input" id="check_out" type="date">
                            </div>
                            <button x-on:click="open = true" class="btn">Order</button>
                            <div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
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
                    @endif
                @else
                    <div x-data="{ open: false }" class="flex sm:flex-row flex-col sm:space-x-2 sm:space-y-0 space-y-2 sm:items-end">
                        <div class="form-control">
                            <label class="label" for="check_in">Check In</label>
                            <input min="2022-01-01" class="w-full input" id="check_in" type="date">
                        </div>
                        <div class="form-control">
                            <label class="label" for="check_out">Check Out</label>
                            <input min="2022-01-01" class="w-full input" id="check_out" type="date">
                        </div>
                        <button x-on:click="open = true" class="btn">Order</button>
                        <div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
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
                @endauth
            </div>
            <div class="relative lg:order-2 order-1">
                <span class="absolute inset-0 border-2 z-0 border-gray-800 translate-x-5 -translate-y-5 rounded-tr-2xl rounded-bl-2xl"></span>
                <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl relative z-10">
                    <img src="{{ asset('img/hero.jpg') }}" class="w-full block hover:scale-110 transition-all duration-300" alt="Hollux Building">
                </div>
            </div>
        </div>
    </main>

    <section class="my-20">
        <div class="container px-8 mx-auto space-y-10">
            <div class="space-y-2">
                <h1 class="sm:text-5xl text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Our Best Facilities</h1>
                <p class="tracking-wide text-gray-600 sm:text-base text-sm">We offer the best facilities to accompany your rest</p>
            </div>
            <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-10">
                @foreach ($facilities as $facility)
                    <div class="space-y-4">
                        <div class="aspect-[5/4] rounded-tr-2xl rounded-bl-2xl overflow-hidden">
                            <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset("storage/$facility->image") }}" alt="{{ $facility->name }}">
                        </div>
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold font-['poppins'] text-lg text-gray-800">{{ $facility->name }}</h3>
                            <a href="{{ route('facilities.index', $facility->code) }}" class="flex items-center gap-1 group">
                                <span class="text-sm text-gray-600 group-hover:underline">Learn more</span>
                                <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lg:my-40 mt-10 mb-20">
        <div class="container px-8 mx-auto lg:space-y-20 space-y-10">
            <div class="space-y-2">
                <h1 class="sm:text-5xl text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Favorite Room</h1>
                <p class="tracking-wide text-gray-600 sm:text-base text-sm">We provide many types of rooms that you can choose according to your needs. <a href="{{ route('rooms.index') }}" class="underline">Click here to see all options</a></p>.
            </div>
            <div class="grid md:gap-20 gap-10">
                @foreach ($favouriteRooms as $room)
                    <div class="flex md:flex-row flex-col lg:gap-20 md:gap-10 gap-6 md:items-center h-full">
                        <span class="lg:text-6xl text-4xl md:block min-w-[1.5rem] hidden text-gray-800 font-['poppins']">{{ $loop->iteration }}</span>
                        <div class="aspect-[8/6] lg:min-w-[24rem] md:min-w-[20rem] lg:max-w-[24rem] md:max-w-[20rem] w-full rounded-tr-2xl rounded-bl-2xl overflow-hidden">
                            <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset("storage/$room->image") }}" alt="{{ $room->name }}">
                        </div>
                        <div class="flex flex-col justify-between md:h-full gap-1">
                            <h3 class="font-bold text-gray-600">{{ $room->name }}</h3>
                            <p class="lg:text-6xl text-4xl text-gray-800">{{ $room->description }}</p>
                            <span class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">{{ (int) $room->total_rooms -  (int) $room->reservations->count()}} rooms available</span>

                                <a class="group" href="{{ route('rooms.show', $room->code) }}"><i class='bx bx-right-arrow-alt lg:text-4xl text-3xl text-gray-600 group-hover:translate-x-2 transition-all duration-300'></i></a>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lg:my-40 mt-10 mb-20">
        <div class="container px-8 mx-auto space-y-6">
            <div class="space-y-2">
                <h1 class="sm:text-5xl text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Gallery</h1>
                <p class="tracking-wide text-gray-600 sm:text-base text-sm">Want to see our rooms and facilities?</p>
            </div>
            <div class="md:columns-3 sm:columns-2 gap-4 space-y-4">
                @foreach ($gallery as $image)
                    <div class="overflow-hidden rounded-tr-2xl rounded-bl-2xl">
                        <img class="w-full hover:scale-110 transition-all duration-300" src="{{ asset("storage/$image->image") }}" alt="{{ $image->title }}" title="{{ $image->title }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lg:my-40 mt-10 mb-20">
        <div class="container px-8 mx-auto space-y-6 text-center">
            <div class="space-y-2">
                <h1 class="sm:text-5xl text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full max-w-max mx-auto">Fascinated?</h1>
                <p class="tracking-wide text-gray-600 sm:text-base text-sm">Choose your desired hotel room now</p>
            </div>
            <a href="{{ route('rooms.index') }}" class="btn">View All Rooms</a>
        </div>
    </section>
</div>
