var conn = null; // connection
var idM = null; 

function initComms(id) {
    idM = id;
    addListeners();
    scrollMsgBottom();
    openComms(); // TODO pozvati samo kada se uzme ticket;
}

function addListeners() {
    $('#input_button').on('click', function () {
        var msg = $('#input_msg').val();
        if(msg.trim() == '')
            return false;
        conn.send(msg);
        myMessage(msg);
        $('#input_msg').val('');
    })
}

function openComms() {
    conn = new WebSocket('ws://localhost:8080?access_token=<?= idM ?>');  /* 'ws://localhost:8081' */
    conn.onopen = function(e) {
        console.log("Connection established!");
    };
    conn.onmessage = function(e) {
        var data = /* JSON.parse(e.data) */ e.data;
        /* if ('users' in data){
        updateUsers(data.users)
        } else  *//* if('message' in data){ */
        newMessage(data);
        /* } */
    };
}

function newMessage(msg){
    html = '<div class="msg their_msg">' + msg/* .message */ + '</div>';
    $('#messages_div').append(html);
    scrollMsgBottom();
}

function myMessage(msg){
    html = '<div class="msg my_msg">' + msg/* .message */ + '</div>';
    $('#messages_div').append(html);
    scrollMsgBottom();
}

function scrollMsgBottom(){
    var d = $('#messages_div');
    d.scrollTop(d.prop("scrollHeight"));
}
