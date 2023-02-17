<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>wrm-chess</title>
    <!-- chessboard css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chessboard-1.0.0.min.css') }}">
    <!-- public javascript and css -->
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    {{--iosocket client--}}
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"
            integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>
</head>
<body class="container mt-5">
    @yield('content')
</body>
</html>
