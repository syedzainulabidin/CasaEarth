@extends('partials.layout')
@section('title', 'Terms & Conditions')

@section('content')
    <div class="toc-pp">
        <h1 data-i18n="terms.title">Terms & Conditions</h1>
        <p data-i18n="terms.updated">Last updated: [Insert Date]</p>

        <p data-i18n="terms.intro">
            Welcome to CURA. By accessing or using our website, you agree to be bound by these Terms and Conditions.
            Please read them carefully.
        </p>

        <ol>
            <li>
                <b data-i18n="terms.general_title">General Information</b>
                <p data-i18n="terms.general_text">
                    CURA is a developing platform designed to provide tools, courses, and experiences that support personal
                    growth and conscious living. The current website serves as an informational and registration portal
                    while our full platform is being built.
                </p>
            </li>

            <li>
                <b data-i18n="terms.use_title">Use of the Website</b>
                <p data-i18n="terms.use_text">
                    By using this site, you agree to do so only for lawful purposes and in alignment with these Terms.
                    You must not misuse the site, attempt unauthorized access, or engage in any action that may harm its
                    functionality.
                </p>
            </li>

            <li>
                <b data-i18n="terms.registration_title">Registration and Communication</b>
                <p data-i18n="terms.registration_text">
                    If you register or submit your information, you agree that CURA may contact you via email regarding
                    updates, launches, or other relevant communications. You may unsubscribe at any time.
                </p>
            </li>

            <li>
                <b data-i18n="terms.intellectual_title">Intellectual Property</b>
                <p data-i18n="terms.intellectual_text">
                    All content on this website — including text, design, graphics, logos, and other materials — is the
                    intellectual property of CURA, unless otherwise stated. You may not reproduce, distribute, or modify
                    any material without prior written consent.
                </p>
            </li>

            <li>
                <b data-i18n="terms.disclaimer_title">Disclaimer</b>
                <p data-i18n="terms.disclaimer_text">
                    The information shared through this site is for general awareness. As CURA continues to develop,
                    details about our services, pricing, and membership structure are subject to change.
                </p>
            </li>

            <li>
                <b data-i18n="terms.liability_title">Limitation of Liability</b>
                <p data-i18n="terms.liability_text">
                    CURA shall not be liable for any damages arising from your use of, or inability to use, this website.
                </p>
            </li>

            <li>
                <b data-i18n="terms.changes_title">Changes to These Terms</b>
                <p data-i18n="terms.changes_text">
                    CURA reserves the right to modify or update these Terms at any time. Any changes will be posted here
                    with an updated “Last Updated” date.
                </p>
            </li>

            <li>
                <b data-i18n="terms.contact_title">Contact Us</b>
                <p data-i18n="terms.contact_text">
                    If you have questions about these Terms, you may contact us at: kindblogger@waterthruskin
                </p>
            </li>
        </ol>
    </div>
@endsection
