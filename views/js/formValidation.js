$(document).ready(function() {
    $('#login').validate({
        rules: {
            username:{
                required: true,
            },
            password:{
                required: true,
                minlength: 8
            }
        }
    });

    $('#register').validate({
        rules: {
            username:{
                required: true,
            },
            password:{
                required: true,
                minlength: 8
            }
        }
    });
});