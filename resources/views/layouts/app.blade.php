<!-- resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title>App Name</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/all.css">
        <script src="{{ mix('/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0-rc.4/dist/js.cookie.min.js"></script>
    </head>
    <body>
        @include('layouts.nav')
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>