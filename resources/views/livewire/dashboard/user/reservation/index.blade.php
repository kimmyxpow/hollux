<div class="space-y-8">
    <h1 class="text-gray-800 text-3xl font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Reservation</h1>
    <x-table>
        <thead class="thead">
            <tr>
                <th scope="col" class="th">Code</th>
                <th scope="col" class="th">Room</th>
                <th scope="col" class="th">Check In</th>
                <th scope="col" class="th">Check Out</th>
                <th scope="col" class="th">Total Room(s)</th>
                <th scope="col" class="th">Total Price</th>
                <th scope="col" class="th">Status</th>
                <th scope="col" class="th"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
                <tr class="bg-white border-b">
                    <td class="td font-medium text-gray-900">{{ $reservation->code }}</td>
                    <td class="td">
                        <a class="underline" href="{{ route('rooms.show', $reservation->room->code) }}">{{ $reservation->room->name }}</a>
                    </td>
                    <td class="td">{{ $reservation->check_in }}</td>
                    <td class="td">{{ $reservation->check_out }}</td>
                    <td class="td">{{ $reservation->total_rooms }}</td>
                    <td class="td">${{ $reservation->total_price }}</td>
                    <td class="td capitalize">{{ $reservation->status }}</td>
                    <td class="td">
                        <a href="{{ route('dashboard.user.reservations.proof', $reservation->code) }}" class="btn btn-sm">Print</a>
                        @if ($reservation->status === 'waiting')
                            <button class="btn btn-sm btn-outline">Cancel</button>
                        @endif
                    </td>
                </tr>
            @empty
                
            @endforelse
        </tbody>
    </x-table>
    {{ $reservations->links() }}
</div>
