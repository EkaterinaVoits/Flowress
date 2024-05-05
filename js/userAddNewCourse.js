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

	let start_date = $('input[name="user-course-startDate"]').val();
	let master_id = $('select[name="master-select"]').val();
	let course_wishes_description = $('textarea[name="course-wishes-description"]').val();
	let course_price=$('#course-price').text()

	let lessons_id=[];

	$('.lessons-ckbx:checked').each(function(key){
		lessons_id[key]=$(this).val();
	});

	$.ajax({
		url:'modules/pages_handlers/user_add_new_course_handler.php',
		type:'POST',
		data: {
			count_lessons:count_lessons,
			start_date:start_date, 
			master_id:master_id,
			lessons_id:lessons_id,
			course_price:course_price,
			course_wishes_description:course_wishes_description
		},
		success (data) {
			alert("Заявка на ваш индивидуальный курс отправлена. Администратор свяжется с вами в ближайшее времмя для подтверждения. Отменить заявку можно в личном кабинете");
			document.location.href='profile_page.php';
		}
	});
});