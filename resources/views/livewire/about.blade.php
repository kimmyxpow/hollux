<main class="lg:min-h-screen lg:mt-0 mt-32 flex items-center lg:mb-0 mb-10">
    <div class="container px-8 mx-auto grid lg:grid-cols-2 gap-10 items-center">
        <div class="space-y-4 lg:order-1 order-2">
            <h1 class="sm:text-6xl text-gray-800 text-4xl font-['poppins'] font-black">{{ $about->title }}</h1>
            <p class="tracking-wide text-gray-600 sm:text-base text-sm">
                {{ $about->text }}
            </p>
        </div>
        <div class="relative lg:order-2 order-1">
            <span class="absolute inset-0 border-2 z-0 border-gray-800 translate-x-5 -translate-y-5 rounded-tl-2xl rounded-br-2xl"></span>
            <div class="overflow-hidden rounded-tl-2xl rounded-br-2xl relative z-10">
                <img src="{{ asset('storage/' . $about->image) }}" class="w-full block hover:scale-110 transition-all duration-300" alt="About Hollux">
            </div>
        </div>
    </div>
</main>