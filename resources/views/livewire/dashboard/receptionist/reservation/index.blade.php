<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Reservation</h1>
    <div>
        <div class="form-control">
            <label for="search" class="label">Search</label>
            <input class='input' type="search" name="search" id="search" wire:model='search'>
        </div>
    </div>
    <x-table>
        <thead class="thead">
            <tr>
                <th scope="col" class="th">Code</th>
                <th scope="col" class="th">User</th>
                <th scope="col" class="th">Room</th>
                <th scope="col" class="th">Check In</th>
                <th scope="col" class="th">Check Out</th>
                <th scope="col" class="th">Total Room(s)</th>
                <th scope="col" class="th">Total Price</th>
                <th scope="col" class="th">Status</th>
                <th scope="col" class="th">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr class="bg-white border-b">
                    <td class="td font-medium text-gray-900">{{ $reservation->code }}</td>
                    <td class="td">{{ $reservation->user->name }}</td>
                    <td class="td">
                        <a class="underline" href="{{ route('rooms.show', $reservation->room->code) }}">{{ $reservation->room->name }}</a>
                    </td>
                    <td class="td">{{ $reservation->check_in }}</td>
                    <td class="td">{{ $reservation->check_out }}</td>
                    <td class="td">{{ $reservation->total_rooms }}</td>
                    <td class="td">${{ $reservation->total_price }}</td>
                    <td class="td capitalize">{{ $reservation->status }}</td>
                    <td class="td flex space-x-2">
                        <a href="{{ route('dashboard.user.reservations.proof', $reservation->code) }}" class="btn btn-sm">Print</a>
                        @if ($reservation->status === 'waiting')
                            <button wire:click='confirm("{{ $reservation->code }}")' class="btn btn-sm btn-outline">Confirm</button>
                        @endif
                        @if ($reservation->status === 'confirmed')
                            <button wire:click='checkIn("{{ $reservation->code }}")' class="btn btn-sm btn-outline">Check In</button>
                        @endif
                         @if ($reservation->status === 'check in')
                            <button wire:click='checkOut("{{ $reservation->code }}")' class="btn btn-sm btn-outline">Check Out</button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="tracking-wide text-gray-600 sm:text-base text-sm">There is nothing here</td>
                </tr>
            @endforelse
        </tbody>
    </x-table>
    {{ $reservations->links() }}
    <div x-data="{ open: false }">
        <div x-show="open" @status:confirmed.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Successfully Confirm</h2>
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
        <div x-show="open" @status:checkin.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Successfully Check In</h2>
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
        <div x-show="open" @status:checkout.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Successfully Check Out</h2>
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
