let frontSocket; //global variables

function getSocket() {
    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    return  io(ip_address + ':' + socket_port)
}
if (!frontSocket) {
    frontSocket = getSocket()
}

function saveAndEmitMove(moveObj, fen) {
    const myJSON = JSON.stringify(moveObj);
    // console.log("move object is =", myJSON, fen)
    $.ajax('/api/games/update/fen', {
        type: 'POST',
        data: {move: myJSON, code: gameCode, fen: fen},
        success: function (data, status, request) {
            let payload = {"move": moveObj, "fen": fen}
            // console.log(piece)
            frontSocket.emit('sendMoveToServer', payload);
        },
        error: function (request, testStatus, errorMessage) {
            jsonData = $.parseJSON(request.responseText)
            $.each(jsonData.errors, function(key, value){
                alert(value)
            });
        }
    })
}

frontSocket.on('sendMoveToClient', (payload) => {
    game.move(payload.move);
    board.position(game.fen());
});
frontSocket.on('inializeBoardClient', (gameObj) => {
    // window.location.href = '/game/' + gameObj.game_code;
    playerId = gameObj.player2_id
    console.log("playerId in Initialize board client", playerId)
})
