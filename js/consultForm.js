$('.take-consult-btn').click(function(e)  {

	e.preventDefault();
	$(`input`).removeClass('error-input');
	
	let user_name = $('input[name="user_name_consult"]').val(),
		user_telephone = $('input[name="user_telephone_consult"]').val();

	$.ajax({
		url:'modules/pages_handlers/consult_handler.php',
		type:'POST',
		dataType:'json',
		data: {
			user_name: user_name,
			user_telephone: user_telephone
		},
		success (data) { 
			if(data.status) {
				alert("Вы подали заявку на консультацию. В ближайшее время с вами свяжется администратор");
				document.getElementById("user_name_consult").value="";
				document.getElementById("user_telephone_consult").value="";

				$(`input`).removeClass('error-input');
				$(`span[name="name-error-span"]`).addClass('none');
				$(`span[name="telephone-error-span"]`).addClass('none');

			} else {
				if(data.type===1){
					data.fields.forEach(function(field){
						$(`input[name="${field}"]`).addClass('error-input');
					});

				$(`span[name="name-error-span"]`).removeClass('none').text(data.nameError);
				$(`span[name="telephone-error-span"]`).removeClass('none').text(data.telephoneError);
				}
			}
		}
	});
});