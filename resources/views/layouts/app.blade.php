<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <div id="app">
        <script>
          window.location.href = "{{config('app.url')}}";
        </script>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
