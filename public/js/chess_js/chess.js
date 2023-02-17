let frontSocket; //global
let config = {
    draggable: true,
    sparePieces: false, //for showing pieces outside the board
    showNotation: false,
    position: {}, // for showing empty board initially
}
let board = null
board = Chessboard('myBoard', config)
