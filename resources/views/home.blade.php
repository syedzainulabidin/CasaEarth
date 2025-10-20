@extends('partials.layout')
@section('title', 'Home')
@section('content')
    <div class="hero">
        <div class="video">
            <video src="{{ asset('assets/videos/background.mp4') }}" autoplay loop muted></video>
        </div>
        <h1 data-aos="fade-up" data-aos-delay="500">Every transformation begins within.
            And we have the tools for it
            <span>Anytime, anywhere.</span>
        </h1>
        <p data-aos="fade-up" data-aos-delay="600">
            A conscious space where inner growth meets everyday rituals — through courses, community, and creations that
            nurture your evolution.
        </p>
        <h2 data-aos="fade-up" data-aos-delay="600">BLOOMING SOON!</h2>
        <div data-aos="fade-up" data-aos-delay="700">
            <input type="text" placeholder="Enter your Email">
            <button type="button">Stay in <span>Loop</span></button>
        </div>
    </div>
    <div class="offer">
        <h1 data-aos="fade-up" data-aos-delay="200">Rooted in wisdom and guided by spirit, we offer
            a path to tune into the life you’re manifesting.</h1>
        <div class="card-container">
            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-img"><img src="{{ asset('assets/images/card1.png') }}" alt=""></div>
                <div class="card-content">
                    <h1>Learn</h1>
                    <p>Immerse yourself in digital resources that nurture conscious living, creativity, wellness, and
                        personal growth.</p>
                </div>

            </div>
            <div class="card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-img"><img src="{{ asset('assets/images/card2.png') }}" alt=""></div>
                <div class="card-content">
                    <h1>Heal</h1>
                    <p>Find guidance and balance with curated holistic practitioners, ancestral healers, coaches, and
                        experts who honor your journey.</p>
                </div>

            </div>
            <div class="card" data-aos="fade-up" data-aos-delay="400">
                <div class="card-img"><img src="{{ asset('assets/images/card3.png') }}" alt=""></div>
                <div class="card-content">
                    <h1>Grow</h1>
                    <p>Integrate the wisdom, practices, and tools you discover here to expand your lifestyle, and step into
                        your fullest self.</p>
                </div>

            </div>
        </div>
    </div>
    <div class="cta">
        <div class="content" data-aos="fade-up" data-aos-delay="500">
            <h1>A new path to heal and grow is about to unfold — your personal sanctuary, filled with trusted guidance and
                limitless digital tools will soon <span>UNLOCK.</span></h1>
            <h2>The journey inward begins soon.</h2>
            <div>
                <input type="text" placeholder="Enter your Email">
                <button type="button">Stay in <span>Loop</span></button>
            </div>
        </div>
        <img src="{{ asset('assets/images/background2.png') }}" alt="">
    </div>
@endsection
