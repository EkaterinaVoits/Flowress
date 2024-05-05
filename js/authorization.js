$('.login-btn').click(function(e)  {

	e.preventDefault();
	$(`input`).removeClass('error-input');

	let email = $('input[name="email"]').val(),
		password = $('input[name="password"]').val();

	$.ajax({
		url:'authorization_handler.php',
		type:'POST',
		dataType:'json',
		data: {
			email:email,
			password:password
		},
		success (data) { 

			if(data.status) {
				document.location.href='/index.php';
			} else {

				if(data.type===1){
					data.fields.forEach(function(field){
					$(`input[name="${field}"]`).addClass('error-input');
					});
				}

				$(`span[name="email-error-span"]`).removeClass('none').text(data.emailError);
				$(`span[name="password-error-span"]`).removeClass('none').text(data.passwordError);

			}
		}
	});
});