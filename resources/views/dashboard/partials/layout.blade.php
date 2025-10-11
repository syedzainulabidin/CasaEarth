<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    @stack('styles')
    <style>
        #sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
        }

        .main-container {
            position: absolute;
            left: 250px;
            width: calc(100% - 250px);
            padding: 10px 40px;
        }
    </style>
</head>

<body>
    @include('dashboard.partials.sidebar')
    @yield('sidebar')
    <div class="main-container">
        @yield('content')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</html>
