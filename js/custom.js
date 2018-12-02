var imagen = "";

$(function() { 
	$("#datepicker").datepicker();
	$("#edit-img-btn").click(openFileChooser);
	$('#filechooser').on('change', uploadImage);
	$("#save-edit").click(savePet);
	$("#cancel-edit").click(cancelEdit);
	$("#edit-pet").click(editPet);	
});

function openFileChooser() {
	$('#filechooser').trigger('click');
}

function savePet() {
	
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
	files = event.target.files;
	event.stopPropagation();
	event.preventDefault();

	var data = new FormData();
	$.each(files, function(key, value) {
		data.append(key, value);
	});

	$.ajax({
		url: 'engine/subirimagen.php?files',
		type: 'POST',
		data: data,
		cache: false,
		dataType: 'json',
		processData: false, 
		contentType: false, 
		beforeSend: function() {
			
		},
		success: function(data, textStatus, jqXHR) {
			if(typeof data.error === 'undefined') {
				$("#img-thumbnail").html('<img src="'+data.files[0]+'"/>');
				imagen = data.files[0];
			} else {
				//$("#uploaderror").html("<p style='color: #990000; font-weight:bold; text-align: center;'>Error: " + data.error + "</p>");
				$("#img-thumbnail").html("");
			}
		},
		error: function(jqXHR, textStatus, errorThrown)	{
			//$("#uploaderror").html("<p style='color: #990000;'>Se produjo un error: " + textStatus + "</p>");
			$("#img-thumbnail").html("");
		}
	}); 
}