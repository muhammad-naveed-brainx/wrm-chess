@extends('layout.master')
@section('content')
<div id="myBoard" style="width: 400px"></div>
<div class="mt-2">
    <!-- Button trigger email modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Generate Code
    </button>
    <!-- Button trigger code modal -->
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#enterCodeModal">
        Enter Game Code
    </button>

</div>
<div class="mt-2">
    <p class="success-message hidden">Success! Your request has been processed.</p>

</div>

<!-- Modal for sending invitation -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Please enter email">
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button id="inviteCloseBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="inviteBtn" type="button" class="btn btn-primary">Invite</button>
            </div>
        </div>
    </div>
</div>

<!--Modal for sending game code -->

<div class="modal fade" id="enterCodeModal" tabindex="-1" role="dialog" aria-labelledby="enterCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="enterCodeModalLabel">Enter Game Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="gameCodeInput">Game Code</label>
                        <input type="text" class="form-control" id="gameCodeInput" placeholder="Enter game code">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="codeCloseBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="codeSubmitBtn" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>


@routes
<!-- chessboard javascript -->
<script src="{{ asset('js/chessboard-1.0.0.min.js') }}"></script>
<!-- My custom script files-->
<script src="{{ asset('js/chess_js/initial_chess.js') }}"></script>
<script src="{{ asset('js/chess_js/ajax_functions.js') }}"></script>
<style>
    .hidden {
        display: none;
    }
    .success-message {
        background-color: #dff0d8;
        border: 1px solid #3c763d;
        color: #3c763d;
        padding: 15px;
        border-radius: 5px;
        text-align: center;
    }
</style>
<script>
    $(document).ready(function () {
        $('#inviteBtn').on('click', sendInvite)
        $('#codeSubmitBtn').on('click', sendCode)
    })
</script>
@endsection
