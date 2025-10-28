@extends('partials.layout')
@section('title', 'Home')
@section('content')
    <div class="hero">
        <div class="video">
            <video src="{{ asset('assets/videos/background.mp4') }}" autoplay loop muted></video>
        </div>
        <h1 data-aos="fade-up" data-aos-delay="500" data-i18n="hero_h1">
            Every transformation begins within. And we have the tools for it
            <span>Anytime, anywhere.</span>
        </h1>
        <p data-aos="fade-up" data-aos-delay="600" data-i18n="hero_p">
            A conscious space where inner growth meets everyday rituals — through courses, community, and creations that
            nurture your evolution.
        </p>
        <h2 data-aos="fade-up" data-aos-delay="600" data-i18n="hero_h2">BLOOMING SOON!</h2>
        <div data-aos="fade-up" data-aos-delay="700">
            <button type="button" data-i18n="button_stay">Join our <span>community</span></button>
        </div>
    </div>

    <div class="offer">
        <h2>Transformation is an energy <span> process</span> — here’s how it begins:</h2>
        <h1 data-aos="fade-up" data-aos-delay="200" data-i18n="offer_title">
            <span id="brand"> Cura</span> brings together everything you need to support this journey—tools, knowledge,
            and 1:1 guidance to help you
            <span>learn</span>, <span>heal</span>, and <span>grow</span> at your own rhythm.
        </h1>
        <div class="card-container">
            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-img"><img src="{{ asset('assets/images/card1.png') }}" alt=""></div>
                <div class="card-content">
                    <h1 data-i18n="learn_title">Learn</h1>
                    <p data-i18n="learn_p">
                        Immerse yourself in digital resources that nurture conscious living, creativity, wellness, and
                        personal growth.
                    </p>
                    <button>Explore our Courses</button>

                </div>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-img"><img src="{{ asset('assets/images/card2.png') }}" alt=""></div>
                <div class="card-content">
                    <h1 data-i18n="heal_title">Heal</h1>
                    <p data-i18n="heal_p">
                        Find guidance and balance with curated holistic practitioners, ancestral healers, coaches, and
                        experts who honor your journey.
                    </p>
                    <button>Explore our Courses</button>
                </div>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="400">
                <div class="card-img"><img src="{{ asset('assets/images/card3.png') }}" alt=""></div>
                <div class="card-content">
                    <h1 data-i18n="grow_title">Grow</h1>
                    <p data-i18n="grow_p">
                        Integrate the wisdom, practices, and tools you discover here to expand your lifestyle, and step into
                        your fullest self.
                    </p>
                    <button>Explore our Courses</button>

                </div>
            </div>
        </div>
    </div>

    <div class="courses">
        <div class="ex-heading">
            <h1>Treding <span>Course</span></h1>
            <div><img src="https://cdn-icons-png.flaticon.com/512/61/61457.png" alt="">Unlock All</div>
        </div>
        <div class="course-container">
            <div class="course">
                <div class="course-img"><img
                        src="https://images.unsplash.com/photo-1483691278019-cb7253bee49f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>
                <div class="course-speaker">
                    <p>Valeria Hinojosa</p>
                </div>
                <div class="course-module">
                    <p>10 Modules</p>
                </div>
                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
            <div class="course">
                <div class="course-img"><img
                        src="https://images.unsplash.com/photo-1500904156668-758cff89dcff?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>
                <div class="course-speaker">
                    <p>Valeria Hinojosa</p>
                </div>
                <div class="course-module">
                    <p>10 Modules</p>
                </div>
                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
            <div class="course">
                <div class="course-img"><img
                        src="https://images.unsplash.com/photo-1505455184862-554165e5f6ba?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1169"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>
                <div class="course-speaker">
                    <p>Valeria Hinojosa</p>
                </div>
                <div class="course-module">
                    <p>10 Modules</p>
                </div>
                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
            <div class="course">
                <div class="course-img"><img
                        src="https://images.unsplash.com/photo-1474557157379-8aa74a6ef541?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>
                <div class="course-speaker">
                    <p>Valeria Hinojosa</p>
                </div>
                <div class="course-module">
                    <p>10 Modules</p>
                </div>
                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
        </div>
    </div>
    <div class="courses">

        <div class="ex-heading">
            <h1>Popular <span>Guides</span></h1>
            <div><img src="https://cdn-icons-png.flaticon.com/512/61/61457.png" alt="">Unlock All</div>
        </div>
        <div class="course-container">
            <div class="course">
                <div class="course-img"><img
                        src="https://images.unsplash.com/photo-1549655698-c7a8a4639ec8?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>

                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
            <div class="course">
                <div class="course-img"><img
                        src="https://images.unsplash.com/photo-1515966097209-ec48f3216288?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>

                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
            <div class="course">
                <div class="course-img"><img
                        src="https://images.unsplash.com/uploads/14122810486321888a497/1b0cc699?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1171"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>

                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
            <div class="course">
                <div class="course-img"><img
                        src="https://articles-1mg.gumlet.io/articles/wp-content/uploads/2015/09/yoga3-2.jpg?compress=true&quality=80&w=640&dpr=2.6"
                        alt=""></div>
                <div class="course-title">
                    <h5>Herbalism & Rituals Course</h5>
                </div>

                <div class="course-desc">
                    <p>A complete guide to holistic living — discover plant-based remedies, self-care rituals, and ancestral
                        wisdom...</p>
                </div>
                <div class="course-rating">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    <img src="https://www.pngall.com/wp-content/uploads/13/Black-Star-PNG-Photo.png" alt="">
                    (10K)
                </div>
            </div>
        </div>
    </div>
    <div class="experts">

        <div class="ex-heading">
            <h1>Meet the <span>Experts</span></h1>
            <div><img src="https://cdn-icons-png.flaticon.com/512/61/61457.png" alt="">Unlock a session</div>
        </div>
        <div class="expert-container">
            <div class="expert">
                <div class="expert-img"><img src="{{ asset('assets/images/ex1.jpg') }}" alt=""></div>
                <div class="expert-title">
                    <h5>Valeria Hinojosa</h5>
                </div>
            </div>
            <div class="expert">
                <div class="expert-img"><img src="{{ asset('assets/images/ex2.jpg') }}" alt=""></div>
                <div class="expert-title">
                    <h5>Diego Hinojosa</h5>
                </div>
            </div>
            <div class="expert">
                <div class="expert-img"><img src="{{ asset('assets/images/ex3.jpg') }}" alt=""></div>
                <div class="expert-title">
                    <h5>Valeria HInojosa</h5>
                </div>
            </div>
            <div class="expert">
                <div class="expert-img"><img src="{{ asset('assets/images/ex4.jpg') }}" alt=""></div>
                <div class="expert-title">
                    <h5>Diego Hinojosa</h5>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="expert">
        <h1>Meet The  <span>Experts</span></h1>
    </div> --}}
    <div class="pricing">
        <h1 data-aos="fade-up" data-aos-delay="200">Plans & Pricing</h1>
        <p data-aos="fade-up" data-aos-delay="300">Your path, your rhythm. Select the plan that aligns with where you are <br>
        each one crafted to guide your healing and growth, with the freedom to shift as life unfolds.</p>
        <div class="pricing-container">
            @forelse ($tiers as $tier)
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="300">
                    <h2>{{ $tier->title }}</h2>
                    <h3>{{ ucfirst($tier->type ?? '') }}</h3>

                    <div class="price">
                        {{ $tier->price == 0 ? 'Free' : '$' . number_format($tier->price, 2) }}
                    </div>

                    @php
                        $includes = is_string($tier->includes) ? json_decode($tier->includes, true) : $tier->includes;
                    @endphp

                    @if (!empty($includes))
                        <ul>
                            @foreach ($includes as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <a href="{{ route('signup-form') }}"><button type="button">Choose Plan</button></a>
                </div>
            @empty
                <div class="no-tiers" data-aos="fade-up" data-aos-delay="200">
                    No tiers available yet.
                </div>
            @endforelse
        </div>
    </div>

    <div class="cta">
        <div class="content" data-aos="fade-up" data-aos-delay="200">
            <h1 data-i18n="cta_h1">
                A new path to heal and grow is about to unfold — your personal sanctuary, filled with trusted guidance and
                limitless digital tools will soon <span>UNLOCK.</span>
            </h1>
            <h2 data-i18n="cta_h2">The journey inward begins soon.</h2>
            <div>
                <input type="text" placeholder="Enter your Email" data-i18n-placeholder="input_email">
                <button type="button" data-i18n="button_stay">Stay in <span>Loop</span></button>
            </div>
        </div>
        <img src="{{ asset('assets/images/background2.png') }}" alt="">
    </div>
@endsection
