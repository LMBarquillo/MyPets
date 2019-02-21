function login() {
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
}

function logout() {
	console.log("Desconectando...");
	let data = {
		"action" : "logout"
	};
	// Y disparamos nuesta la petición Ajax
	$.ajax({
		data: data,
		url: 'engine/requests.php',
		type: 'post',
		success: function(response) {
			console.log(response);
			window.location.replace("index.php");
		},
		error: function(data) {
			console.log(data.responseText);
		}
	});
}

/**
 * Valida una fecha en formato dd/mm/yyyy
 * @param dateString
 * @returns true or false
 */
function isValidDate(dateString)
{
    if(!/^\d{1,2}-\d{1,2}-\d{4}$/.test(dateString)) return false;

    var parts = dateString.split("-");
    var day = parseInt(parts[0], 10);
    var month = parseInt(parts[1], 10);
    var year = parseInt(parts[2], 10);

    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    return day > 0 && day <= monthLength[month - 1];
};
