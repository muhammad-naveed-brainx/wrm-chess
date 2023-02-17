@extends('layout.master')
@section('content')
<div id="myBoard" style="width: 400px"></div>
<div class="mt-3">
    <label for="status">Status:</label>
    <p id="status"></p>
</div>
@routes
<!-- chessboard javascript -->
<script src="{{ asset('js/chessboard-1.0.0.min.js') }}"></script>
<!-- My custom script files-->
<script src="{{ asset('js/chess_js/started_chess.js') }}"></script>
<script src="{{ asset('js/chess_js/ajax_functions.js') }}"></script>
@endsection
