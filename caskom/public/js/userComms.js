var conn = null; // connection

function initComms() {
    addListeners();
    scrollMsgBottom();
}

function addListeners() {
    $('#input_button').on('click', function () {
        var msg = $('#tekst').val();
        if(msg.trim() == '')
            return false
        conn.send(msg);
        myMessage(msg);
        $('#tekst').val('');
    });
    $('#ikonica_ceta').on('click', openComms);
}

function openComms() {
    if (conn == null) {
        conn = new WebSocket('ws://localhost:8081');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };
        conn.onmessage = function(e) {
            var data = /* JSON.parse */(e.data)
            /* if ('users' in data){
            updateUsers(data.users)
            } else  *//* if('message' in data){ */
            newMessage(data);
            /* } */
        };
    }
}

function newMessage(msg){
    html = '<div class="div_poruke_primljena"> <div class="poruka_primljena" onclick="sendClick()"> <span class="tekst_poruke">' + msg/* .message */ + '</span> </div> </div>';
    $('#linija_poruka').append(html);
    scrollMsgBottom();
}

function myMessage(msg){
    html = '<div class="div_poruke_poslata"> <div class="poruka_poslata" onclick="sendClick()"> <span class="tekst_poruke">' + msg/* .message */ + '</span> </div> </div>';
    $('#linija_poruka').append(html);
    scrollMsgBottom();
}

function scrollMsgBottom(){
    var d = $('#linija_poruka');
    d.scrollTop(d.prop("scrollHeight"));
}