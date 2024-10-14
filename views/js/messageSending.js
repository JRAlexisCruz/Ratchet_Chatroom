$(document).ready(function() {
    var conn = new WebSocket('ws://localhost:8080');

    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
        var data = JSON.parse(e.data);
        var container='<div class="chat_message"><span class="username">'+data['username']+':'+'</span><span class="message">'+data['message']+'</span></div>';
        $('#chat_messages').append(container);
    };

    $('#send').click(function() {
        var message = $('#user_message').val();
        var username = $('#username').val();
        var data={
            username:username,
            message:message
        }
        conn.send(JSON.stringify(data));
    });

    $('#message_form').submit(function(e) {
        e.preventDefault();
        $('#user_message').val("");
    });

});