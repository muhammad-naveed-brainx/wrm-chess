let frontSocket; //global
let config = {
    draggable: true,
    sparePieces: false, //for showing pieces outside the board
    showNotation: false,
    position: {}, // for showing empty board initially
    onDragStart: onDragStart,
    onDrop: onDrop,
    onMouseoutSquare: onMouseoutSquare,
    onMouseoverSquare: onMouseoverSquare,
    onSnapEnd: onSnapEnd
}
let board = null
board = Chessboard('myBoard', config)

let game = new Chess()
let $status = $('#status')
let $fen = $('#fen')
let $pgn = $('#pgn')

let whiteSquareGrey = '#a9a9a9'
let blackSquareGrey = '#696969'

function removeGreySquares() {
    $('#myBoard .square-55d63').css('background', '')
}

function greySquare(square) {
    let $square = $('#myBoard .square-' + square)

    let background = whiteSquareGrey
    if ($square.hasClass('black-3c85d')) {
        background = blackSquareGrey
    }

    $square.css('background', background)
}

function onMouseoverSquare(square, piece) {
    // get list of possible moves for this square
    let moves = game.moves({
        square: square, verbose: true
    })

    // exit if there are no moves available for this square
    if (moves.length === 0) return

    // highlight the square they moused over
    greySquare(square)

    // highlight the possible squares for this piece
    for (var i = 0; i < moves.length; i++) {
        greySquare(moves[i].to)
    }
}

function onMouseoutSquare(square, piece) {
    // remove highlights when mouse out
    removeGreySquares()
}


function onDragStart(source, piece, position, orientation) {
    // do not pick up pieces if the game is over
    if (game.isGameOver()) return false
    console.log("playerId =", playerId)

    // only pick the piece for correct side
    if ((playerId === 6 && piece.search(/^b/) !== -1) || (playerId === 7 && piece.search(/^w/) !== -1) ) {
        return false
        // console.log("playerId is 6")
    }

    // only pick up pieces for the side to move
    if ((game.turn() === 'w' && piece.search(/^b/) !== -1) || (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
        return false
    }
}

function onDrop(source, target) {
    removeGreySquares()
    try {
        game.move({
            from: source, to: target, promotion: 'q' // NOTE: always promote to a queen for example simplicity
        })
        saveAndEmitMove({from: source, to: target, promotion: 'q'}, game.fen())

    } catch (e) {
        // illegal move
        return 'snapback'
    }
    updateStatus()
}

// update the board position after the piece snap
// for castling, en passant, pawn promotion
function onSnapEnd() {
    board.position(game.fen())
}

function updateStatus() {
    var status = ''

    var moveColor = 'White'
    if (game.turn() === 'b') {
        moveColor = 'Black'
    }

    // checkmate?
    if (game.inCheck()) {
        status = 'Game over, ' + moveColor + ' is in checkmate.'
    }

    // draw?
    else if (game.isDraw()) {
        status = 'Game over, drawn position'
    }

    // game still on
    else {
        status = moveColor + ' to move'

        // check?
        if (game.inCheck()) {
            status += ', ' + moveColor + ' is in check'
        }
    }

    $status.html(status)
    $fen.html(game.fen())
    $pgn.html(game.pgn())
}


updateStatus()

/**
 * Socket io function
 * @returns {*}
 */
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
    board.start() // set board on position start
    playerId = gameObj.player2_id
    gameCode = gameObj.game_code
})
