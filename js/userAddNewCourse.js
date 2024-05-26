let	count_lessons=0;

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

$('#user_add_new_course_btn').on('click', function(e) {

	e.preventDefault();
	$(`input`).removeClass('error-input');

	let start_date = $('input[name="user-course-startDate"]').val();
	let master_id = $('select[name="master-select"]').val();
	let course_wishes_description = $('textarea[name="course-wishes-description"]').val();
	let course_price=$('#course-price').text()

	let lessons_id=[];

	$('.lessons-ckbx:checked').each(function(key){
		lessons_id[key]=$(this).val();
	});

	let courseFormData=new FormData();
	courseFormData.append('start_date', start_date);
	courseFormData.append('master_id', master_id);
	courseFormData.append('course_wishes_description', course_wishes_description);
	courseFormData.append('course_price', course_price);
	courseFormData.append('count_lessons', count_lessons);

	for (i = 0; i < lessons_id.length; i++) {
	    courseFormData.append('lessons_array[]', lessons_id[i]);
	}

	$.ajax({
		url:'modules/pages_handlers/user_add_new_course_handler.php',
		type:'POST',
		type:'POST',
		dataType:'json',
		processData: false,
		contentType: false,
		cache: false,
		data: courseFormData,
		success (data) {
			if(data.status) {
				alert("Заявка на ваш индивидуальный курс отправлена. Администратор свяжется с вами в ближайшее времмя для подтверждения. Отменить заявку можно в личном кабинете");
				document.location.href='profile_page.php';
			} else {
				if(data.type===1){
					$(`input[name="user-course-startDate"]`).addClass('error-input');
					$(`span[name="course-lessons-error-span"]`).removeClass('none').text(data.courseLessonsError);
					$(`span[name="user-course-startDate-error-span"]`).removeClass('none').text(data.courseStartDateError);
				}
			}
		}
	});
});