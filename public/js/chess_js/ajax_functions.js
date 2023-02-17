let gamePlayers; //global variable
let gameCode;
let playerId;
function sendInvite() {
    let email = $("#email").val();
    $.ajax('/api/games/invite', {
        type: 'POST',
        data: {email: email},
        success: function (data, status, request) {
            let successElement = $(".success-message")
            successElement.append('<p>'+ data.message +'</p>')
            successElement.append('<p> You can share your code '+ data.data +'</p>')
            successElement.removeClass("hidden").show();
        },
        error: function (request, testStatus, errorMessage) {
            jsonData = $.parseJSON(request.responseText)
            $.each(jsonData.errors, function(key, value){
                alert(value)
            });
        },
        complete: function () {
            // console.log("completed executed")
            $('#exampleModal').modal('toggle');
        }
    })
}

function sendCode() {
    let code = $("#gameCodeInput").val();
    $.ajax('/api/games/verify', {
        type: 'POST',
        data: {code: code, id: 7},
        // id of authenticated user and then start game from here
        success: function (data, status, request) {
            board.start() // set board on position start
            gameObj = data.data
            playerId = gameObj.player1_id
            gameCode = gameObj.game_code
            frontSocket.emit("inializeBoardServer", gameObj)
            // console.log("how can i get game coe", data.data)
        },
        error: function (request, testStatus, errorMessage) {
            jsonData = $.parseJSON(request.responseText)
            $.each(jsonData.errors, function(key, value){
                alert(value)
            });
        },
        complete: function () {
            $('#enterCodeModal').modal('toggle');
        }
    })
}


