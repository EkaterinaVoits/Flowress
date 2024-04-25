$('.take-consult-btn').click(function(e)  {

	e.preventDefault();

	alert("Вы подали заявку на консультацию. В ближайшее время с вами свяжется администратор");
	
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

			alert("Заявка отправлена! Мы свяжемся с вами в ближайшее время");
			document.getElementById("user_name_consult").value="";
			document.getElementById("user_telephone_consult").value="";
		}
	});
});