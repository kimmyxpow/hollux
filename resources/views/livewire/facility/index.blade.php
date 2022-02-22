<main class="mt-20 mb-10">
    <div class="container px-8 mx-auto flex gap-10 relative" x-data="{ sidebar: (window.innerWidth >= 768) ? true : false }">
        <aside x-show="sidebar" x-transition.duration.300ms x-on:click.outside="sidebar = (window.innerWidth >= 768) ? true : false" class="w-[300px] space-y-2 bg-white md:static absolute md:opacity-100 md:translate-x-0 md:pointer-events-auto transition-all duration-300 z-40 md:p-0 p-6 md:shadow-none shadow-2xl md:rounded-none rounded-tr-xl rounded-bl-xl">
            <h1 class="text-gray-400 uppercase tracking-widest font-['poppins'] font-bold px-4 text-sm">Our Facilities</h1>
            <div class="space-y-1">
                @foreach ($facilities as $row)
                    <a href="{{ route('facilities.index', $row->code) }}" class="flex items-center gap-2 py-2 px-4 rounded-tr-xl rounded-bl-xl hover:bg-gray-100 transition-all duration-300">
                        <div class="h-10 w-10 grid place-items-center rounded-tr-xl rounded-bl-xl font-bold {{ $row->code === $facility->code ? 'bg-gray-800 text-gray-100' : 'bg-gray-100 text-gray-800' }}">
                            <i class='bx bx-crown' ></i>
                        </div>
                        <span class="font-semibold font-['poppins'] text-gray-800">{{ $row->name }}</span>
                    </a>
                @endforeach
            </div>
        </aside>
        <main class="w-full space-y-6 relative z-30">
            <button x-on:click="sidebar = (window.innerWidth >= 768) ? true : !sidebar" class="md:hidden btn btn-icon">
                <i class='bx bx-menu-alt-left' ></i>
            </button>
            <div class="aspect-[16/9] rounded-tr-2xl rounded-bl-2xl overflow-hidden w-full">
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
            <article class="prose sm:prose-base prose-sm max-w-none prose-headings:font-['poppins']">
                <h1>{{ $facility->name }}</h1>
                <blockquote>
                    {{ $facility->description }}
                </blockquote>
                {!! $facility->explanation !!}
            </article>
        </main>
    </div>
</main>