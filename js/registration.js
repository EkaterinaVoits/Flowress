$('.reg-btn').click(function(e)  {

	e.preventDefault();
	$(`input`).removeClass('error-input');
	
	let name = $('input[name="name"]').val(),
		email = $('input[name="email"]').val(),
		telephone = $('input[name="telephone"]').val(),
		password = $('input[name="password"]').val(),
		password_confirm = $('input[name="password_confirm"]').val();

	let formData=new FormData();
	formData.append('email', email);
	formData.append('name', name);
	formData.append('telephone', telephone);
	formData.append('password', password);
	formData.append('password_confirm', password_confirm);

	$.ajax({
		url:'registration_handler.php',
		type:'POST',
		dataType:'json',
		processData: false,
		contentType: false,
		cache: false,
		data: formData,
		success (data) {

			if(data.status) {
				 document.location.href='/index.php';
			} else {

				if(data.type===1){
					data.fields.forEach(function(field){
					$(`input[name="${field}"]`).addClass('error-input');
					});
				}

				$(`span[name="name-error-span"]`).removeClass('none').text(data.nameError);
				$(`span[name="email-error-span"]`).removeClass('none').text(data.emailError);
				$(`span[name="telephone-error-span"]`).removeClass('none').text(data.telephoneError);
				$(`span[name="photo-error-span"]`).removeClass('none').text(data.photoError);
				$(`span[name="password-error-span"]`).removeClass('none').text(data.passwordError);
				$(`span[name="password_confirm-error-span"]`).removeClass('none').text(data.password_confirmError);


			}
		}
	});
});
