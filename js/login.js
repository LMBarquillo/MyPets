$(document).ready(() => {
    $("#login-btn").click(function(event) {
        let user = $("#input-user").val();
        let pass = $("#input-pass").val();

        if(user.length > 0 && pass.length > 0) {
			let data = {
				"action" : "login",
				"user" : user,
				"pass" : pass
			};
			// Y disparamos nuesta la petición Ajax
			$.ajax({
				data: data,
				url: 'engine/requests.php',
				type: 'post',
				success: function(response) {
					// console.log(response);
					window.location.replace("index.php");
				},
				error: function(data) {
					$("#login-msg").html(data.responseText);
				}
			});
        } else {
            $("#login-msg").html("Por favor, rellene el usuario y contraseña.");
        }
    });
});