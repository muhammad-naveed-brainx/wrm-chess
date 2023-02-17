const express = require('express')
const app = express()
const server = require('http').createServer(app);

const io = require('socket.io')(server, {
    cors: {origin: "*"}
})

io.on('connection', (socket) => {
    console.log('connection')
    //receiving something and emitting on the base of receive
    socket.on('sendChatToServer', (message) => {
        console.log(message)

        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('sendChatToClient', message); //sending something
    })

    socket.on('sendMoveToServer', (move) => {
        console.log(move)

        // io.sockets.emit('sendChatToClient', message);
        socket.broadcast.emit('sendMoveToClient', move);
    })

    socket.on('inializeBoardServer', (gameObj) => {
        socket.broadcast.emit('inializeBoardClient', gameObj)
    })



    socket.on('disconnect', (socket) => {
        console.log('Disconnect')
    })
})

server.listen(3000, () => {
    console.log("server is running pa g")
})
