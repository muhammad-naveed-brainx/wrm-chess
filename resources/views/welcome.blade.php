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


<body class="container mt-5">
<div id="myBoard" style="width: 400px"></div>
<div class="mt-4">
    <button id="startBtn" class="btn btn-primary btn-sm">Start Position</button>
    <button id="clearBtn" class="btn btn-warning btn-sm">Clear Board</button>
</div>
<div class="mt-2">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Generate Code
    </button>
</div>
<label>Status:</label>
<div id="status"></div>
<label>FEN:</label>
<div id="fen"></div>
<label>PGN:</label>
<div id="pgn"></div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="send_code" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


</body>
<!-- chessboard javascript -->
<script src="{{ asset('js/chessboard-1.0.0.min.js') }}"></script>
<!-- My custom script files-->
<script src="{{ asset('js/chess_js/chess.js') }}"></script>
</html>
