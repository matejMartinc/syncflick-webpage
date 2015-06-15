<!doctype html>
<html lang="sl">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Syncflick - dub your videos</title>
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}">
    @section('head')
        <link rel="stylesheet" href="{{ asset('/css/foundation.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/reform-pure.css') }}" />
    @show
    </head>
<body>  
    @yield('body')
    <script src="{{ asset('js/vendor/modernizr.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/foundation.min.js') }}"></script>
    <script src="{{ asset('js/enquire.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/reform.js') }}"></script>
    @yield('googleapi')
    <script>
        $(document).foundation();
    </script>
</body>
</html>