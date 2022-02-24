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
            <div class="space-y-4">
                <h2 class="text-2xl text-gray-800 font-bold">{{ __('Reviews') }}</h2>
                <div class="space-y-6">
                    @forelse ($reviews as $review)
                        <div class="bg-gray-100 p-6 rounded-tr-xl rounded-bl-xl space-y-2">
                            <div>
                                @for ($i=1; $i <= $review->star; $i++)
                                    <i class="bx bx-star text-lg text-orange-500"></i>
                                @endfor
                            </div>
                            <p class="tracking-wide text-gray-800 sm:text-base text-sm">
                                "{!! nl2br($review->message) !!}"
                            </p>
                            <div class="flex items-center gap-2">
                                <img class="w-10 h-10 rounded-tr-xl rounded-bl-xl" src="{{ asset('storage/' . $review->user->avatar) }}" alt="">
                                <p class="font-bold text-gray-600 text-sm">
                                    {{ $review->user->name }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 tracking-wide sm:text-base text-sm">Be the first to review this facility!</p>
                    @endforelse
                </div>
                @if (count($reviews->where('user_id', auth()->id())))
                    <livewire:facility.review.edit :review="$reviews->firstWhere('user_id', auth()->id())" :facility="$facility" />
                @else
                    <livewire:facility.review.create :facility="$facility" />
                @endif
            </div>
        </main>
    </div>
    <div x-data="{ open: false }">
        <div x-show="open" @review:created.window="open = true" @review:edited.window="open = true" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog" aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')" class="fixed inset-0 overflow-y-auto z-50">
            <div x-show="open" x-transition.duration.300ms.opacity class="fixed inset-0 bg-black/50"></div>
            <div x-show="open" x-transition.duration.300ms x-on:click="open = false" class="relative min-h-screen flex items-center justify-center p-4">
                <div x-on:click.stop x-trap.noscroll.inert="open" class="relative max-w-md w-full bg-white rounded-xl p-10 overflow-y-auto space-y-4">
                    <div class="text-center space-y-4">
                        <i class='bx bx-check-circle text-8xl text-green-600'></i>
                        <h2 class="text-3xl font-bold text-gray-800" :id="$id('modal-title')">Review Successfully</h2>
                        <p class="tracking-wide text-gray-600 sm:text-base text-sm">Your review has been successfully submitted! Thank you for your review!</p>
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
</main>