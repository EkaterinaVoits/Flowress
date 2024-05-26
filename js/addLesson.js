
let lesson_material=false;
let lesson_homework=false;
let lesson_photo=false;

$('input[name="new-lesson-material"]').change(function(e)  {
	lesson_material=e.target.files[0]; 
});

$('input[name="new-lesson-homeworkTask"]').change(function(e)  {
	lesson_homework=e.target.files[0]; 
});

$('input[name="new-lesson-photo"]').change(function(e)  {
	lesson_photo=e.target.files[0]; 
});


$('.add_lesson_btn').click(function(e) {

	e.preventDefault();
	$(`input`).removeClass('error-input');

	let title = $('input[name="lesson-title"]').val();
	let description = $('input[name="lesson-description"]').val();

	let lessonFormData=new FormData();
	lessonFormData.append('title', title);
	lessonFormData.append('description', description);
	
	lessonFormData.append('new_lesson_material', lesson_material);
	lessonFormData.append('new_lesson_homeworkTask', lesson_homework);
	lessonFormData.append('new_lesson_photo', lesson_photo);
	
	$.ajax({
		url:'/modules/pages_handlers/masters_handlers/add_lesson_handler.php',
		type:'POST',
		dataType:'json',
		processData: false,
		contentType: false,
		cache: false,
		data: lessonFormData,
		success (data) {
			if(data.status) {

				alert("Урок успешно добавлен");
				document.location.href='/master_panel.php';

			} else {
				
				if(data.type===1){
					data.fields.forEach(function(field){
						$(`input[name="${field}"]`).addClass('error-input');
					});

					$(`span[name="lesson-title-error-span"]`).removeClass('none').text(data.lessonTitleError);
					$(`span[name="lesson-description-error-span"]`).removeClass('none').text(data.lessonDescriptionError);
					$(`span[name="lesson-photo-error-span"]`).removeClass('none').text(data.lessonPhotoError);
					$(`span[name="lesson-material-error-span"]`).removeClass('none').text(data.lessonMaterialError);
					$(`span[name="lesson-homeworkTask-error-span"]`).removeClass('none').text(data.lessonHomeworkTaskError);
				}
			}
		}
	});
});