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
                    <i class='bx bx-home-smile' ></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Facility Reviews</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalFacilityReviews }}</span>
                </div>
            </div>
        </div>
        <div class="py-4 px-6 bg-gray-50 rounded-tr-xl rounded-bl-xl">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 grid place-items-center rounded-tr-xl rounded-bl-xl bg-gray-800 text-white text-xl">
                    <i class='bx bx-home-heart' ></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-600 text-lg">Room Reviews</span>
                    <span class="text-gray-800 text-2xl font-bold font-['poppins']">{{ $totalRoomReviews }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
