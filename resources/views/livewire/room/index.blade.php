<main class="mt-28 mb-20">
    <div class="container px-8 mx-auto space-y-10">
        <div class="space-y-2">
            <h1 class="sm:text-5xl text-gray-800 text-3xl font-['poppins'] font-black capitalize after:content-[''] after:block after:w-10 after:h-1 after:bg-gray-800 after:rounded-full">Room Choices For You</h1>
            <p class="tracking-wide text-gray-600 sm:text-base text-sm">We have a choice of {{ $rooms->count() }} different room types that you can choose according to your needs</p>
        </div>
        <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8">
            @forelse ($rooms as $room)
                <div class="space-y-4">
                    <div class="aspect-[8/6]  w-full rounded-tl-2xl rounded-br-2xl overflow-hidden">
                        <img class="w-full h-full object-cover hover:scale-110 transition-all duration-300" src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}">
                    </div>
                    <div class="bg-gray-200 text-sm text-gray-600 flex gap-x-4 gap-y-2 justify-center rounded-tr-lg rounded-bl-lg py-2 px-4">
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
                            <span class="text-sm capitalize">${{ $room->price }}/night</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold font-['poppins'] text-lg text-gray-800">{{ $room->name }}</h3>
                            <a href="{{  route('rooms.show', $room->code) }}" class="flex items-center gap-1 group">
                                <span class="text-sm text-gray-600 group-hover:underline">Learn more</span>
                                <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm break-words">
                            {{ $room->description }}
                        </p>
                    </div>
                    <span class="text-sm text-gray-600 bg-gray-200 py-2 text-center rounded-tr-xl rounded-bl-xl block">{{ (int) $room->total_rooms -  (int) $room->reservations->count()}} rooms available</span>
                </div>
            @empty
                <p class="tracking-wide text-gray-600 sm:text-base text-sm">There is nothing here</p>
            @endforelse
        </div>
    </div>
</main>