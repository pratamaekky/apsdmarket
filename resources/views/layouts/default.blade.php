<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.head')
    <body>
        @include('includes.navigation')

        @yield('content')

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/cart.js') }}"></script>

    </body>
</html>