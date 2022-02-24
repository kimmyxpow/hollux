<div>
    <h1 class="text-gray-800 text-3xl font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Welcome!!</h1>
    <div class="mt-8 grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-4">
        <h2 class="sr-only">Statistic</h2>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-receipt'></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Reservation</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalReservations }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-time'></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Waiting</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalReservationsWaiting }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-message-square-x'></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Canceled</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalReservationsCanceled }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-message-square-check'></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Confirmed</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalReservationsConfirmed }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-log-in-circle'></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Check In</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalReservationsCheckIn }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-log-out-circle'></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Check Out</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalReservationsCheckOut }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
