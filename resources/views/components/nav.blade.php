@props(['facilities'])

<nav class="py-4 fixed inset-x-0 top-0 z-50 bg-white">
    <div x-data="{ menu: (window.innerWidth >= 768) ? true : false }" class="container mx-auto px-8 flex items-center justify-between relative">
        <a href="{{ route('index') }}">
            <img src="{{ asset("img/brand/logo-1.png") }}" class="w-10 h-10 object-cover rounded-tr-xl rounded-bl-xl" alt="">
        </a>
        <button x-on:click="menu = (window.innerWidth >= 768) ? true : !menu" class="md:hidden btn btn-icon"><i class='bx bx-menu' ></i></button>
        <div x-show="menu" x-on:click.outside="menu = (window.innerWidth >= 768) ? true : false" x-transition.duration.300ms class="flex md:flex-row flex-col md:items-center md:space-x-10 md:space-y-0 space-y-2 md:relative absolute md:top-auto top-[120%] md:p-0 py-4  md:inset-x-auto inset-x-0 md:px-0 px-8 bg-white">
            <x-nav-link :href="route('index')" :active="Route::currentRouteNamed('index') ? 'active' : ''">Home</x-nav-link>
            <div x-data="{ open: false }">
                <x-nav-link href="/facilities" :active="Route::currentRouteNamed('facilities.*') ? 'active' : ''" x-on:click="(e) => {e.preventDefault(); open = !open;}">Facilities</x-nav-link>
                <div x-show="open" x-on:click.outside="open = false" x-transition.duration.300ms class="absolute grid sm:grid-cols-2 gap-4 bg-white shadow-2xl shadow-gray-600/20 md:min-w-[34rem] md:left-auto left-0 right-0 p-6 top-full rounded-tr-2xl rounded-bl-2xl transition-all duration-300 md:max-h-[none] max-h-[40vh]  overflow-y-auto">
                    @foreach ($facilities as $facility)
                        <a href="{{ route('facilities.index', $facility->code) }}" class="flex items-center space-x-2 group">
                            <img class="min-h-[4rem] min-w-[4rem] max-h-[4rem] max-w-[4rem] object-cover rounded-tr-xl rounded-bl-xl" src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}">
                            <div>
                                <span class="font-bold text-gray-800">{{ $facility->name }}</span>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ $facility->description }}
                                </p>
                            </div>
                            <i class='bx bx-right-arrow-alt text-gray-600 opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300' ></i>
                        </a>
                    @endforeach
                </div>
            </div>
            <x-nav-link :href="route('rooms.index')" :active="Route::currentRouteNamed('rooms.*') ? 'active' : ''">Rooms</x-nav-link>
            <x-nav-link :href="route('about')" :active="Route::currentRouteNamed('about') ? 'active' : ''">About</x-nav-link>
            @if (Route::has('login'))
                <div class="space-x-1">
                    @auth
                        <a href="{{ $dashboardLink }}">
                            <img class="w-10 h-10 object-cover rounded-tr-xl rounded-bl-xl" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                        </a>
                    @else
                        <a class="btn btn-sm" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>

                        @if (Route::has('register'))
                            <a class="btn btn-sm btn-outline" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>