@extends('partials.layout')
@section('title', 'Privacy Policy')
@section('content')
    <div class="toc-pp">
        <h1 data-i18n="privacy.title">Privacy Policy</h1>
        <p data-i18n="privacy.updated">Last updated: [Insert Date]</p>
        <p data-i18n="privacy.intro">
            CURA respects your privacy and is committed to protecting your personal information. This policy explains how we
            collect, use, and safeguard your data while our platform is under development.
        </p>

        <ol>
            <li>
                <b data-i18n="privacy.collect_title">Information We Collect</b>
                <p data-i18n="privacy.collect_intro">
                    We may collect the following types of information when you interact with our website:
                </p>
                <p data-i18n="privacy.personal_info">
                    <b>Personal Information:</b> Name, email address, and other details you voluntarily provide when
                    registering or contacting us.
                </p>
                <p data-i18n="privacy.usage_data">
                    <b>Usage Data:</b> Basic analytics such as IP address, browser type, and pages visited to help us
                    improve
                    the user experience.
                </p>
            </li>

            <li>
                <b data-i18n="privacy.use_title">How We Use Your Information</b>
                <p data-i18n="privacy.use_intro">We use your information to:</p>
                <ul>
                    <li data-i18n="privacy.use_point1">Communicate updates about CURA’s development and offerings.</li>
                    <li data-i18n="privacy.use_point2">Improve our website and pre-launch experience.</li>
                    <li data-i18n="privacy.use_point3">Maintain security and functionality of the site.</li>
                </ul>
            </li>

            <li>
                <b data-i18n="privacy.cookies_title">Cookies</b>
                <p data-i18n="privacy.cookies_text">
                    Our website may use cookies to enhance your browsing experience. You can disable cookies through your
                    browser settings at any time.
                </p>
            </li>

            <li>
                <b data-i18n="privacy.security_title">Data Security</b>
                <p data-i18n="privacy.security_text">
                    We use reasonable administrative and technical measures to protect your data. However, no online
                    platform
                    is completely secure, and we cannot guarantee absolute protection.
                </p>
            </li>

            <li>
                <b data-i18n="privacy.thirdparty_title">Third-Party Services</b>
                <p data-i18n="privacy.thirdparty_text">
                    We may use third-party tools (such as analytics or email services) that process data on our behalf.
                    These
                    services are carefully selected to align with privacy best practices.
                </p>
            </li>

            <li>
                <b data-i18n="privacy.rights_title">Your Rights</b>
                <p data-i18n="privacy.rights_text">
                    You have the right to access, update, or request deletion of your personal information. You may do so by
                    contacting us directly at [insert email].
                </p>
            </li>

            <li>
                <b data-i18n="privacy.updates_title">Policy Updates</b>
                <p data-i18n="privacy.updates_text">
                    We may update this Privacy Policy from time to time to reflect new practices or legal requirements.
                    Updates will be posted on this page with a new “Last Updated” date.
                </p>
            </li>

            <li>
                <b data-i18n="privacy.contact_title">Contact Us</b>
                <p data-i18n="privacy.contact_text">
                    If you have questions or concerns about this Privacy Policy, please reach us at: 📩 [Insert contact
                    email]
                </p>
            </li>
        </ol>
    </div>
@endsection
