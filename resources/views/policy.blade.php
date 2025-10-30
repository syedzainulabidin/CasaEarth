@extends('partials.layout')
@section('title', 'Privacy Policy')

@section('meta')
    <meta name="description"
        content="CURA Privacy Policy — Learn how we collect, use, and protect your personal information while ensuring your rights and security.">
@endsection

@section('content')
    <div
        class="mt-[124px] w-full relative max-w-[1920px] flex flex-col gap-10 px-[70px] py-[80px] pb-[150px] text-white max-[680px]:px-[30px]">

        <!-- Header -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-5">
            <h1 class="heading-1 text-black" data-i18n="privacy.title">Privacy Policy</h1>
            <p class="text-black para-1" data-i18n="privacy.updated">Last updated: 27/10/2025</p>
        </div>

        <!-- Intro -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-5">
            <p class="text-black para-1" data-i18n="privacy.intro">
                CURA respects your privacy and is committed to protecting your
                personal information. This policy explains how we collect, use, and
                safeguard your data while our platform is under development.
            </p>
        </div>

        <!-- Section 1: Information We Collect -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.collect_title">
                Information We Collect
            </h1>
            <p class="text-black para-1" data-i18n="privacy.collect_intro">
                We may collect the following types of information when you interact
                with our website:
            </p>
            <ul class="text-black list-disc ms-5 para-1">
                <li class="text-black" data-i18n="privacy.personal_info">
                    <b>Personal Information:</b> Name, email address, and other details you
                    voluntarily provide when registering or contacting us.
                </li>
                <li class="text-black" data-i18n="privacy.usage_data">
                    <b>Usage Data:</b> Basic analytics such as IP address, browser type, and
                    pages visited to help us improve the user experience.
                </li>
            </ul>
        </div>

        <!-- Section 2: How We Use Your Information -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.use_title">
                How We Use Your Information
            </h1>
            <p class="text-black para-1" data-i18n="privacy.use_intro">
                We use your information to:
            </p>
            <ul class="text-black list-disc ms-5 para-1">
                <li class="text-black" data-i18n="privacy.use_point1">
                    Communicate updates about CURA’s development and offerings.
                </li>
                <li class="text-black" data-i18n="privacy.use_point2">
                    Improve our website and pre-launch experience.
                </li>
                <li class="text-black" data-i18n="privacy.use_point3">
                    Maintain security and functionality of the site.
                </li>
            </ul>
        </div>

        <!-- Section 3: Cookies -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.cookies_title">Cookies</h1>
            <p class="text-black para-1" data-i18n="privacy.cookies_text">
                Our website may use cookies to enhance your browsing experience. You
                can disable cookies through your browser settings at any time.
            </p>
        </div>

        <!-- Section 4: Data Security -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.security_title">Data Security</h1>
            <p class="text-black para-1" data-i18n="privacy.security_text">
                We use reasonable administrative and technical measures to protect
                your data. However, no online platform is completely secure, and we
                cannot guarantee absolute protection.
            </p>
        </div>

        <!-- Section 5: Third-Party Services -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.thirdparty_title">
                Third-Party Services
            </h1>
            <p class="text-black para-1" data-i18n="privacy.thirdparty_text">
                We may use third-party tools (such as analytics or email services)
                that process data on our behalf. These services are carefully selected
                to align with privacy best practices.
            </p>
        </div>

        <!-- Section 6: Your Rights -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.rights_title">Your Rights</h1>
            <p class="text-black para-1" data-i18n="privacy.rights_text">
                You have the right to access, update, or request deletion of your
                personal information. You may do so by contacting us directly at
                [insert email].
            </p>
        </div>

        <!-- Section 7: Policy Updates -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.updates_title">
                Policy Updates
            </h1>
            <p class="text-black para-1" data-i18n="privacy.updates_text">
                We may update this Privacy Policy from time to time to reflect new
                practices or legal requirements. Updates will be posted on this page
                with a new “Last Updated” date.
            </p>
        </div>

        <!-- Section 8: Contact Us -->
        <div class="w-2/3 max-[800px]:w-full flex flex-col gap-1">
            <h1 class="para-1 text-black font-bold underline" data-i18n="privacy.contact_title">Contact Us</h1>
            <p class="text-black para-1" data-i18n="privacy.contact_text">
                If you have questions or concerns about this Privacy Policy, please
                reach us at: 📩 [Insert contact email]
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
