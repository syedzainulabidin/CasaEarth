@extends('partials.layout')
@section('title', 'Terms & Conditions')

@section('meta')
    <meta name="description"
        content="CURA Terms & Conditions — Learn the rules, rights, and responsibilities for using our platform, tools, and services safely.">
@endsection

@section('content')
    <div
        class="mt-[124px] w-full relative max-w-[1920px] flex flex-col gap-10 px-[70px] py-[80px] pb-[150px] text-white max-[680px]:px-[30px]">

        <!-- Header -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-5">
            <h1 class="heading-1 text-black" data-i18n="terms.title">Terms and Conditions</h1>
            <p class="text-black para-1" data-i18n="terms.updated">Last updated: 27/10/2025</p>
        </div>

        <!-- Intro -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-5">
            <p class="text-black para-1" data-i18n="terms.intro">
                Welcome to CURA. By accessing or using our website, you agree to be
                bound by these Terms and Conditions. Please read them carefully.
            </p>
        </div>

        <!-- Section 1: General Information -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.general_title">
                1. General Information
            </h1>
            <p class="text-black para-1" data-i18n="terms.general_text">
                CURA is a developing platform designed to provide tools, courses, and
                experiences that support personal growth and conscious living. The
                current website serves as an informational and registration portal
                while our full platform is being built.
            </p>
        </div>

        <!-- Section 2: Use of the Website -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.use_title">
                2. Use of the Website
            </h1>
            <p class="text-black para-1" data-i18n="terms.use_text">
                By using this site, you agree to do so only for lawful purposes and in
                alignment with these Terms. You must not misuse the site, attempt
                unauthorized access, or engage in any action that may harm its
                functionality.
            </p>
        </div>

        <!-- Section 3: Registration and Communication -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.registration_title">
                3. Registration and Communication
            </h1>
            <p class="text-black para-1" data-i18n="terms.registration_text">
                If you register or submit your information, you agree that CURA may
                contact you via email regarding updates, launches, or other relevant
                communications. You may unsubscribe at any time.
            </p>
        </div>

        <!-- Section 4: Intellectual Property -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.intellectual_title">
                4. Intellectual Property
            </h1>
            <p class="text-black para-1" data-i18n="terms.intellectual_text">
                All content on this website — including text, design, graphics, logos,
                and other materials — is the intellectual property of CURA, unless
                otherwise stated. You may not reproduce, distribute, or modify any
                material without prior written consent.
            </p>
        </div>

        <!-- Section 5: Disclaimer -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.disclaimer_title">
                5. Disclaimer
            </h1>
            <p class="text-black para-1" data-i18n="terms.disclaimer_text">
                The information shared through this site is for general awareness. As
                CURA continues to develop, details about our services, pricing, and
                membership structure are subject to change.
            </p>
        </div>

        <!-- Section 6: Limitation of Liability -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.liability_title">
                6. Limitation of Liability
            </h1>
            <p class="text-black para-1" data-i18n="terms.liability_text">
                CURA shall not be liable for any damages arising from your use of, or
                inability to use, this website.
            </p>
        </div>

        <!-- Section 7: Changes to These Terms -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.changes_title">
                7. Changes to These Terms
            </h1>
            <p class="text-black para-1" data-i18n="terms.changes_text">
                CURA reserves the right to modify or update these Terms at any time.
                Any changes will be posted here with an updated “Last Updated” date.
            </p>
        </div>

        <!-- Section 8: Contact Us -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="terms.contact_title">
                8. Contact Us
            </h1>
            <p class="text-black para-1" data-i18n="terms.contact_text">
                If you have questions about these Terms, you may contact us
                at: kindblogger@waterthruskin
            </p>
        </div>
    </div>

    @push('scripts')
        <script>
            let nav = document.querySelector('.nav');
            nav.classList.add("scrolled");
        </script>
    @endpush
@endsection
