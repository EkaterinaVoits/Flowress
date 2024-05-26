
let new2_lesson_material=false;
let new2_lesson_homework=false;


$('input[name="lesson-material"]').change(function(e)  {
	new2_lesson_material=e.target.files[0]; 
});

$('input[name="lesson-homeworkTask"]').change(function(e)  {
	new2_lesson_homework=e.target.files[0]; 
});


$('.save_edit_lesson_btn').click(function(e)  {
	e.preventDefault();
	let lesson_id=$(this).attr('id');
	
	let title = $('input[name="lesson-title"]').val(),
		description = $('input[name="lesson-description"]').val();

	let lesson_material = document.querySelector("#lesson-material");
	if(lesson_material!=null){
		 lesson_material_path = lesson_material.href;
	} else {
		lesson_material_path="";
	}
   
    let lesson_homework = document.querySelector("#lesson-homework");
    if(lesson_homework!=null){
		lesson_homework_path = lesson_homework.href;
	} else {
		lesson_homework_path = "";
	}
   

	let lessonFormData=new FormData();
	lessonFormData.append('lesson_id', lesson_id);
	lessonFormData.append('title', title);
	lessonFormData.append('description', description);
	lessonFormData.append('new2_lesson_material', new2_lesson_material);
	lessonFormData.append('new2_lesson_homework', new2_lesson_homework);
	lessonFormData.append('lesson_material_path', lesson_material_path);
	lessonFormData.append('lesson_homework_path', lesson_homework_path);

	$.ajax({
			url:'/modules/pages_handlers/masters_handlers/edit_lesson_handler.php',
			type:'POST',
			processData: false,
			contentType: false,
			cache: false,
			data: lessonFormData,
			dataType:'json',
			success (data) {
				if(data.status) {

					alert("Урок изменён");
					document.location.href='/master_panel.php';

				} else {

					if(data.type===1){
						data.fields.forEach(function(field){
							$(`input[name="${field}"]`).addClass('error-input');
						});

						$(`span[name="lesson-title-error-span"]`).removeClass('none').text(data.lessonTitleError);
						$(`span[name="lesson-description-error-span"]`).removeClass('none').text(data.lessonDescriptionError);
					}

				}
			}
	});
});
