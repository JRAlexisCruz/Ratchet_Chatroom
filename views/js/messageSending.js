$(document).ready(function() {
    var conn = new WebSocket('ws://localhost:8080');

    conn.onopen = function(e) {
        var data={
            type: 'connection',
            username:$('#username').val()
        };
        conn.send(JSON.stringify(data));
    };

    conn.onmessage = function(e) {
        console.log(e.data);
        var data = JSON.parse(e.data);
        if(data['type']=='connection'){
            var table=$('#active-users table tbody');
            table.empty();
            data['usernames'].forEach(elemento => {
                var row='<tr><td class="text-center">'+elemento+'</td></tr>';
                table.append(row);
            });
        }else{
            var container='<div class="chat-message d-flex flex-column justify-content-start align-items-start px-2 py-1"><div class="username">'+data['username']+'</div><div class="message">'+data['message']+'</div><div class="time mt-1 align-self-end">'+data['time']+'</div></div></div>';
            $('#chat-messages').append(container);
        }
    };

    $('#send').click(function() {
        var message = $('#user-message').val();
        var username = $('#username').val();
        if(message!=""){
            var data={
                type: 'message',
                username:username,
                message:message
            }
            conn.send(JSON.stringify(data));
        }
    });

    $('#message-form').submit(function(e) {
        e.preventDefault();
        $('#user-message').val("");
    });

});