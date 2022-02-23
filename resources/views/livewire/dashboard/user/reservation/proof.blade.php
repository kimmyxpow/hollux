<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="max-w-xl mx-auto px-8 space-y-6">
        <div class="text-center space-y-4">
            <img src="{{ asset('img/brand/logo-1.png') }}" class="rounded-tr-3xl rounded-bl-3xl" width="200" alt="Hollux">
            <h1 class="font-black text-gray-800 text-4xl">Proof of Room Reservation</h1>
            <p class="tracking-wide text-gray-600">Apartemen Merkurius City No. 32, Jalan Jupiter Kav. 18, Mars, Saturnus, 13120</p>
        </div>
        <table class="prose sm:prose-base prose-sm max-w-none w-full">
            <tr>
                <th class="text-left">Reservation Code</th>
                <td>:</td>
                <td>{{ $reservation->code }}</td>
            </tr>
            <tr>
                <th class="text-left">Reservation Status</th>
                <td>:</td>
                <td class="capitalize">{{ $reservation->status }}</td>
            </tr>
            <tr>
                <th class="text-left">Reservation Date</th>
                <td>:</td>
                <td>{{ $reservation->date }}</td>
            </tr>
            <tr>
                <th class="text-left">Name</th>
                <td>:</td>
                <td>{{ $reservation->user->name }}</td>
            </tr>
            <tr>
                <th class="text-left">Email</th>
                <td>:</td>
                <td>{{ $reservation->user->email }}</td>
            </tr>
            <tr>
                <th class="text-left">Phone</th>
                <td>:</td>
                <td>{{ $reservation->user->phone_number }}</td>
            </tr>
            <tr>
                <th class="text-left">Room Type</th>
                <td>:</td>
                <td>{{ $reservation->room->name }}</td>
            </tr>
            <tr>
                <th class="text-left">Number of Room(s)</th>
                <td>:</td>
                <td>{{ $reservation->total_rooms }}</td>
            </tr>
            <tr>
                <th class="text-left">Check In</th>
                <td>:</td>
                <td>{{ $reservation->check_in }}</td>
            </tr>
            <tr>
                <th class="text-left">Check Out</th>
                <td>:</td>
                <td>{{ $reservation->check_out }}</td>
            </tr>
            <tr>
                <th class="text-left">Total Day(s)</th>
                <td>:</td>
                <td>{{ $total_days }}</td>
            </tr>
            <tr>
                <th class="text-left">Total Price</th>
                <td>:</td>
                <td>${{ $reservation->total_price }}</td>
            </tr>
        </table>
    </div>
</body>
</html>