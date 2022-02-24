@props(['title'])

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="{{ asset('js/app.js')  }}"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <title>{{ $title }}</title>
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <style>
        .editor__editable,
        /* Classic build. */
        main .ck-editor[role='application'] .ck.ck-content {
            min-height: 400px;
            max-height: 400px;
        }
    </style>
    <livewire:styles />
</head>
<body>
    <div class="relative overflow-x-hidden min-h-screen">
       <section class="flex min-h-screen max-h-screen overflow-hidden relative" x-data="{ sidebar: (window.innerWidth >= 1024) ? true : false }">
            <aside x-show="sidebar" x-on:click.outside="sidebar = (window.innerWidth >= 1024) ? true : false" x-transition.duration.300ms class="lg:w-[400px] w-[300px] max-w-full px-8 overflow-y-auto py-4 mt-14 lg:static absolute inset-y-0 bg-white">
                <div class="space-y-6">
                    @if (auth()->user()->hasRole('user'))
                        <div class="space-y-2">
                            <span class="font['poppins'] uppercase tracking-widest text-gray-400 font-bold px-6 text-sm">User</span>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.user.index') }}" class="{{ !Route::currentRouteNamed('dashboard.user.index') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-category text-xl {{ !Route::currentRouteNamed('dashboard.user.index') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.user.index') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Dasbboard</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.user.reservations.index') }}" class="{{ !Route::currentRouteNamed('dashboard.user.reservations.*') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-receipt text-xl {{ !Route::currentRouteNamed('dashboard.user.reservations.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.user.reservations.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Reservation</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.user.reviews.rooms.index') }}" class="{{ !Route::currentRouteNamed('dashboard.user.reviews.rooms.*') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-home-heart text-xl {{ !Route::currentRouteNamed('dashboard.user.reviews.rooms.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.user.reviews.rooms.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Room Reviews</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.user.reviews.facilities.index') }}" class="{{ !Route::currentRouteNamed('dashboard.user.reviews.facilities.*') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-home-smile text-xl {{ !Route::currentRouteNamed('dashboard.user.reviews.facilities.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.user.reviews.facilities.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Facility Reviews</span>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->hasRole('admin'))
                        <div class="space-y-2">
                            <span class="font['poppins'] uppercase tracking-widest text-gray-400 font-bold px-6 text-sm">Admin</span>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.admin.index') }}" class="{{ !Route::currentRouteNamed('dashboard.admin.index') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-category text-xl {{ !Route::currentRouteNamed('dashboard.admin.index') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.admin.index') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Dasbboard</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.admin.rooms.index') }}" class="{{ !Route::currentRouteNamed('dashboard.admin.rooms.*') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-home-heart text-xl {{ !Route::currentRouteNamed('dashboard.admin.rooms.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.admin.rooms.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Rooms</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.admin.facilities.index') }}" class="{{ !Route::currentRouteNamed('dashboard.admin.facilities.*') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-home-smile text-xl {{ !Route::currentRouteNamed('dashboard.admin.facilities.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.admin.facilities.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Facilities</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.admin.galeries') }}" class="{{ !Route::currentRouteNamed('dashboard.admin.galeries') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-images text-xl {{ !Route::currentRouteNamed('dashboard.admin.galeries') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.admin.galeries') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Galery</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.admin.users.index') }}" class="{{ !Route::currentRouteNamed('dashboard.admin.users.*') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-group text-xl {{ !Route::currentRouteNamed('dashboard.admin.users.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.admin.users.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">User</span>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->hasRole('receptionist'))
                        <div class="space-y-2">
                            <span class="font['poppins'] uppercase tracking-widest text-gray-400 font-bold px-6 text-sm">Receptionist</span>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.receptionist.index') }}" class="{{ !Route::currentRouteNamed('dashboard.receptionist.index') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-category text-xl {{ !Route::currentRouteNamed('dashboard.receptionist.index') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.receptionist.index') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Dasbboard</span>
                                </a>
                            </div>
                            <div class="grid gap-2">
                                <a href="{{ route('dashboard.receptionist.reservations.index') }}" class="{{ !Route::currentRouteNamed('dashboard.receptionist.reservations.*') ? 'hover:bg-gray-100' : 'bg-gray-100' }} py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                    <i class="bx bx-receipt text-xl {{ !Route::currentRouteNamed('dashboard.receptionist.reservations.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300"></i>
                                    <span class="font-semibold {{ !Route::currentRouteNamed('dashboard.receptionist.reservations.*') ? 'text-gray-400 group-hover:text-gray-600' : 'text-gray-800' }} transition-all duration-300">Reservation</span>
                                </a>
                            </div>
                    @endif
                    <div class="space-y-2">
                        <span class="font['poppins'] uppercase tracking-widest text-gray-400 font-bold px-6 text-sm">Account</span>
                        <div class="grid gap-2">
                            <a href="#" class="hover:bg-gray-100 py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                <i class='bx bx-user text-xl text-gray-400 group-hover:text-gray-600 transition-all duration-300'></i>
                                <span class="font-semibold text-gray-400 group-hover:text-gray-600 transition-all duration-300">Profile</span>
                            </a>
                        </div>
                        <div class="grid gap-2">
                            <a href="#" class="hover:bg-gray-100 py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                <i class='bx bx-cog text-xl text-gray-400 group-hover:text-gray-600 transition-all duration-300'></i>
                                <span class="font-semibold text-gray-400 group-hover:text-gray-600 transition-all duration-300">Setting</span>
                            </a>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="grid gap-2">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-gray-100 py-4 px-6 rounded-tr-xl rounded-bl-xl flex items-center gap-2 transition-all duration-300 group">
                                <i class='bx bx-log-out text-xl text-gray-400 group-hover:text-gray-600 transition-all duration-300'></i>
                                <span class="font-semibold text-gray-400 group-hover:text-gray-600 transition-all duration-300">Logout</span>
                            </a>
                        </form>
                    </div>
                </div>
            </aside>
            <main class="w-full px-8 overflow-y-auto pt-20 pb-4">
                <nav class="py-2 border-b border-gray-100 backdrop-blur-sm bg-white/30 fixed inset-x-0 top-0 z-50">
                    <div class="lg:px-14 px-8 flex justify-between items-center bg-transparent">
                        <div class="flex items-center gap-4">
                            <button x-on:click="sidebar = (window.innerWidth >= 1024) ? true : !sidebar" class="lg:hidden bg-gray-800 text-white h-10 w-10 grid place-items-center text-sm font-semibold hover:bg-gray-600 ring ring-offset-2 ring-transparent focus:ring-gray-800 focus:bg-gray-800 transition-all duration-300">
                                <i class='bx bx-menu-alt-left' ></i>
                            </button>
                            <a href="/">
                                <img src="{{ asset("img/brand/logo-1.png") }}" class="w-10 h-10 object-cover rounded-tr-xl rounded-bl-xl" alt="Hollux">
                            </a>
                        </div>
                        <div class="flex items-center gap-2 bg-transparent">
                            <span>{{ auth()->user()->name }}</span>
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-10 h-10 object-cover rounded-tr-xl rounded-bl-xl" alt="{{ auth()->user()->name }}">
                        </div>
                    </div>
                </nav>
                {{ $slot }}
           </main>
       </section>
    </div>
    <livewire:scripts />
    {{ $js ?? '' }}
</body>
</html>