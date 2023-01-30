<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
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
</head>

<body>
<div class="container">
    @yield('content')
</div>
</body>

</html>
