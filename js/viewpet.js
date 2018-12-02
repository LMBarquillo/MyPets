$(function() { 
	$("#datepicker").datepicker({dateFormat: 'dd-mm-yy' });
	$("#edit-img-btn").click(openFileChooser);
	$('#filechooser').on('change', uploadImage);
	$("#save-edit").click(savePet);
	$("#cancel-edit").click(cancelEdit);
	$("#edit-pet").click(editPet);	
});

function openFileChooser() {
	$('#filechooser').trigger('click');
}

// Validación del formulario de edición y guardar mascota.
function savePet() {
	let name = $('#name').val();
	let species = $('#species').val();
	let breed = $('#breed').val();
	let genre = $('input[name=genre]:checked').val();
	let birthDate = $('#datepicker').val();
	let description = $('#description').val();
		
	if(name.length > 0 && species.length > 0 && breed.length > 0 && birthDate.length > 0 && description.length > 0) {
		if(isValidDate(birthDate)) {
			// Si todo fue bien, construimos la petición y la enviamos
			let data = {
				"action" : "editPet",
				"id" : petId,
				"name" : name,
				"species" : species,
				"breed" : breed,
				"genre" : genre,
				"birthdate" : birthDate,
				"description" : description,
				"picture" : petImage
			};
			
			$.ajax({
				data: data,
				url: 'engine/requests.php',
				type: 'post',
				success: function(data) {
					console.log(data);
				},
				error: function(data) {
					$("#result-msg").addClass("msg-error");
					$("#result-msg").html(data.responseText);
				}
			});			
		} else {
			$("#result-msg").addClass("msg-error");
			$("#result-msg").html("La fecha es inválida. Introduzca una fecha correcta");
		}
	} else {
		$("#result-msg").addClass("msg-error");
		$("#result-msg").html("Por favor, rellene todos los campos");
	}
}

function cancelEdit() {
	$("#pet-edit").hide();
	$("#pet-view").show('slow');
}

function editPet() {
	$("#pet-view").hide();
	$("#pet-edit").show('slow');
	$("#datepicker").datepicker("setDate", birthDate);
}
	
function uploadImage(event)	{
	console.log(event);
	files = event.target.files;		// Obtenemos el archivo a subir del
	event.stopPropagation();		// Detenemos el submit
	event.preventDefault();

	var data = new FormData();
	$.each(files, function(key, value) {
		data.append(key, value);	// Añadimos el archivo al data del post
	});

	// Ejecutamos la petición asíncrona
	$.ajax({
		url: 'engine/uploadPicture.php?files',
		type: 'POST',
		data: data,
		cache: false,
		dataType: 'json',
		processData: false, 
		contentType: false, 
		beforeSend: function() {
			
		},
		success: function(data, textStatus, jqXHR) {
			// Al terminar la petición, nos devuelve un valor
			if(typeof data.error === 'undefined') {
				// Si no devuelve error, ponemos la imagen
				$("#img-thumbnail").attr("src", data.files[0]);
				// Y nos guardamos la ruta para cuando pinchemos en Guardar
				petImage = data.files[0];
			} else {
				// Si viene error, lo mostramos
				$("#result-msg").addClass("msg-error");
				$("#result-msg").html("Error: " + data.error);
				$("#img-thumbnail").html("");
			}
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			// Este error no es del PHP, sino de ajax. Por ejemplo, que no encontrara la ruta del PHP. 
			$("#result-msg").addClass("msg-error");
			$("#result-msg").html("Error: " + textStatus);
			$("#img-thumbnail").html("");
		}
	}); 
}