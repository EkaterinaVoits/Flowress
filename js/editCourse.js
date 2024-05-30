$('.save_edit_course_btn').click(function(e) {

	e.preventDefault();
	
	let course_id=$(this).attr('id');

	$(`input`).removeClass('error-input');

	let course_title = $('input[name="course-title"]').val(),
		course_description = $('input[name="course-description"]').val();
		course_full_description = $('input[name="course-full-description"]').val();
		course_price = $('input[name="course-price"]').val();
 
	let lessons_id=[];

	$('.lessons-ckbx:checked').each(function(key){
		lessons_id[key]=$(this).val();
	});

	let courseFormData=new FormData();
	courseFormData.append('course_id', course_id);
	courseFormData.append('course_title', course_title);
	courseFormData.append('course_description', course_description);
	courseFormData.append('course_full_description', course_full_description);
	courseFormData.append('course_price', course_price);
	//courseFormData.append('course_photo', course_photo);

	for (i = 0; i < lessons_id.length; i++) {
	    courseFormData.append('lessons_array[]', lessons_id[i]);
	}
	//courseFormData.append('lessons_id', lessons_id);

	let answer=confirm("Вы уверены, что хотите изменить курс?");
	if(answer) {

		$.ajax({
			url:'modules/pages_handlers/edit_course_handler.php',
			type:'POST',
			dataType:'json',
			processData: false,
			contentType: false,
			cache: false,
			data: courseFormData,
			success (data) {
				if(data.status) {

					alert("Курс изменён");
					$(`span`).addClass('none');
					document.location.href='/master_panel.php';

				} else {
					
					if(data.type===1){
						data.fields.forEach(function(field){
							$(`input[name="${field}"]`).addClass('error-input');
						});

						$(`span[name="course-title-error-span"]`).removeClass('none').text(data.courseTitleError);
						$(`span[name="course-description-error-span"]`).removeClass('none').text(data.courseDescriptionError);
						$(`span[name="course-full-description-error-span"]`).removeClass('none').text(data.courseFullDescriptionError);
						$(`span[name="course-price-error-span"]`).removeClass('none').text(data.coursePriceError);
						//$(`span[name="course-photo-error-span"]`).removeClass('none').text(data.coursePhotoError);
						$(`span[name="course-lessons-error-span"]`).removeClass('none').text(data.courseLessonsError);
					}
				}
			}
		});
	}
});

