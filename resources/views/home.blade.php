@extends('partials.layout')
@section('title', 'Cura')

@section('meta')
    <meta name="description"
        content="Cura — a conscious space for inner growth, offering courses, guidance, and tools to heal, learn, and evolve anytime, anywhere.">
@endsection

@section('content')
    <!-- ? Hero -->
    <div
        class="mt-[124px] w-full relative max-w-[1920px] flex flex-col gap-10 px-[70px] py-[80px] pb-[150px] text-white max-[680px]:px-[30px]">

        <h1 class="heading-1 max-w-[800px]" data-i18n="hero_h1">
            Every transformation begins within. And we have the tools for it
            <span>Anytime, anywhere.</span>
        </h1>

        <p class="para-1 max-w-[660px]" data-i18n="hero_p">
            A conscious space where inner growth meets everyday rituals — through
            courses, community, and creations that nurture your evolution.
        </p>

        <h2 class="heading-2 uppercase font-[100] italic" data-i18n="hero_h2">
            Blooming Soon!
        </h2>

        <form action="" class="flex gap-2 max-[500px]:flex-col">
            <input type="text" placeholder="Enter your Email"
                class="outline w-full max-w-[400px] rounded-full p-2 bg-transparent placeholder:text-white"
                data-i18n-placeholder="input_email" />
            <button class="bg-white text-black hover:invert rounded-full p-3 px-10 break-keep whitespace-nowrap"
                data-i18n="button_stay">
                Stay in the <span>loop</span>
            </button>
        </form>

        <video src="{{ asset('assets/videos/background.mp4') }}" autoplay muted loop
            class="absolute -z-10 left-0 -top-[130px] w-screen h-[calc(100%+100px)] object-cover"></video>
    </div>

    <!-- ? Root -->
    <div class="w-full max-w-[1920px] flex flex-col gap-8 py-[50px] px-[70px] text-white max-[680px]:px-[30px]">
        <h1 class="heading-1 text-black" data-i18n="offer_title">
            Rooted in wisdom and guided by spirit, we offer a path to tune into the
            life you’re manifesting.
        </h1>

        <div class="card-container w-full justify-around items-center flex flex-wrap">

            <div class="card relative flex m-1 grow items-center justify-center rounded w-[100%] max-w-[400px] aspect-3/4">
                <img src="{{ asset('assets/images/card1.png') }}" class="w-full h-full object-cover" alt="" />
                <span class="absolute p-8">
                    <h1 class="heading-2 text-center font-2 italic" data-i18n="learn_title">Learn</h1>
                    <p class="para-2" data-i18n="learn_p">
                        Immerse yourself in digital resources that nurture conscious
                        living, creativity, wellness, and personal growth.
                    </p>
                </span>
            </div>

            <div class="card relative flex m-1 grow items-center justify-center rounded w-[100%] max-w-[400px] aspect-3/4">
                <img src="{{ asset('assets/images/card2.png') }}" class="w-full h-full object-cover" alt="" />
                <span class="absolute p-8">
                    <h1 class="heading-2 text-center font-2 italic" data-i18n="heal_title">Heal</h1>
                    <p class="para-2" data-i18n="heal_p">
                        Find guidance and balance with curated holistic practitioners,
                        ancestral healers, coaches, and experts who honor your journey.
                    </p>
                </span>
            </div>

            <div class="card relative flex m-1 grow items-center justify-center rounded w-[100%] max-w-[400px] aspect-3/4">
                <img src="{{ asset('assets/images/card3.png') }}" class="w-full h-full object-cover" alt="" />
                <span class="absolute p-8">
                    <h1 class="heading-2 text-center font-2 italic" data-i18n="grow_title">Grow</h1>
                    <p class="para-2" data-i18n="grow_p">
                        Integrate the wisdom, practices, and tools you discover here to
                        expand your lifestyle, and step into your fullest self.
                    </p>
                </span>
            </div>

        </div>
    </div>

    <!-- ? CTA -->
    <div class="w-full h-fit relative flex flex-col gap-8 py-[30px] text-white max-w-[1920px]">
        <div class="flex flex-col gap-[70px] z-10 py-[100px] px-[10vw]">
            <h1 class="heading-1 text-center" data-i18n="cta_h1">
                A new path to heal and grow is about to unfold — your personal
                sanctuary, filled with trusted guidance and limitless digital tools
                will soon <b>UNLOCK.</b>
            </h1>

            <h1 class="heading-2 text-center max-[700px]:hidden" data-i18n="cta_h2">
                <span>The journey inward begins soon.</span>
            </h1>

            <form action="" class="flex justify-center gap-2 max-[700px]:flex-col">
                <input type="text" placeholder="Enter your Email"
                    class="outline outline-gray-100 w-full max-w-[500px] rounded-full p-2 bg-transparent placeholder:gray-100"
                    data-i18n-placeholder="input_email" />
                <button class="bg-white text-black hover:invert rounded-full p-3 px-10 break-keep whitespace-nowrap"
                    data-i18n="button_stay">
                    Stay in the <span>loop</span>
                </button>
            </form>
        </div>
        <img src="{{ asset('assets/images/background2.png') }}" class="absolute -z-1 w-screen h-full object-cover"
            alt="" />
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/navChange.js') }}"></script>
    @endpush
@endsection
