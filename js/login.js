$(document).ready(() => {
    $("#login-btn").click(function(event) {
        let user = $("#input-user").val();
        let pass = $("#input-pass").val();

        if(user.length > 0 && pass.length > 0) {
            
        } else {
            $("#login-msg").html("Por favor, rellene el usuario y contraseña.");
        }
    });
});