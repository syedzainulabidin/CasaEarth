<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mediaqueries.css') }}"> --}}
    {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')





</head>

<body class="flex flex-col items-center">
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
</body>
<script src={{ asset('assets/js/language.js') }}></script>
<script src="{{ asset('assets/js/logoManagment.js') }}"></script>
<script src="https://js.stripe.com/clover/stripe.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{ asset('assets/js/AOS.js') }}"></script>
<script src="https://unpkg.com/@andreasremdt/simple-translator@latest/dist/umd/translator.min.js" defer></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    brand: "#4F46E5",
                },
            },
        },
    };
</script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@stack('scripts')


</html>
