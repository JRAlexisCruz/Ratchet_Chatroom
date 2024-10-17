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
        },
        messages:{
            username:{
                required: "Username is required"
            },
            password:{
                required: "Password is required",
                minlength: "Password must be at least 8 characters long"
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
        },
        messages:{
            username:{
                required: "Username is required"
            },
            password:{
                required: "Password is required",
                minlength: "Password must be at least 8 characters long"
            }
        }
    });
});