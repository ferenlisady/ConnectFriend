<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="icon" href="{{ asset('assets/logo1.png') }}" type="image/png">
    <title>@yield('title')</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex-grow: 1;
    }
</style>

<body>
    <header>
        @include('layouts.navbar')
    </header>

    <main>
        @yield('contents')
    </main>

    <footer>
        @include('layouts.footer')
    </footer>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>