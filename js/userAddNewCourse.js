$('.lessons-checkboxes').on('click', function() {
	
	let lessons_checkboxes = document.querySelectorAll("input[name=lessons-ckbx]:checked");
	count_lessons=lessons_checkboxes.length;

	console.log(count_lessons);

	$.ajax({
		url:'modules/pages_handlers/user_course_price_handler.php',
		type:'POST',
		data: {
			count_lessons:count_lessons
		},
		success (data) {
			$(".user-course-price").html(data);
		}
	});
});

$('#user_add_new_course_btn').on('click', function() {

	start_date = $('input[name="user-course-startDate"]').val();

	$.ajax({
		url:'modules/pages_handlers/user_add_new_course_handler.php',
		type:'POST',
		data: {
			count_lessons:count_lessons,
			start_date:start_date
		},
		success (data) {
			alert("Заявка на ваш индивидуальный курс отправлена. Администратор свяжется с вами в ближайшее времмя для подтверждения. Отменить заявку можно в личном кабинете");
		}
	});
});