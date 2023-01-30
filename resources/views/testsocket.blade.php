@extends('layout.master')
@section('content')
    <h1>Socket Page</h1>
{{--iosocket client--}}
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"
            integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>
    <div id="chat-content">
        <ul>

        </ul>
    </div>

    <div>
        <label for="chat-input">Type Message:</label>
        <input type="text" id="chat-input" style="border: 1px solid black">
    </div>

    <script>
        $(function() {
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port)
            // socket.on('connection')
            let chatInput = $('#chat-input');

            chatInput.keypress(function(e) {
                let message = $(this).val();
                console.log(message);
                if(e.which === 13 && !e.shiftKey) {
                    socket.emit('sendChatToServer', message);
                    chatInput.val('');
                    return false;
                }
            });

            socket.on('sendChatToClient', (message) => {
                $('#chat-content ul').append(`<li>${message}</li>`);
            });
        })
    </script>
@endsection
