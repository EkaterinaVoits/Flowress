
$('.tab').on('click', function() {
	let tab_id=$(this).attr('id');

	let all_blocks=document.getElementsByClassName('block');
	let all_tabs=document.getElementsByClassName('tab');

	for(i=0; i<all_blocks.length; i++) {
		all_blocks[i].style.display='none';
		all_tabs[i].style.color='black';
		all_tabs[i].style.fontWeight = '400	';
	}

	let tab_element=document.getElementById(tab_id);
	tab_element.style.transition = '0.5s';
	tab_element.style.color='#bca1a1';
	tab_element.style.fontWeight = '600';
	tab_element.style.scale = '1.03';
	tab_element.style.cursor = 'pointer';
	
	if(tab_id=='profile-tab') {
		document.getElementById('profile-block').style.display='block';
	} else if (tab_id=='user-courses-tab') {
		document.getElementById('user-courses-block').style.display='block';
	} else if (tab_id=='school-courses-tab') {
		document.getElementById('school-courses-block').style.display='block';
	} else if (tab_id=='education-tab') {
		document.getElementById('user-education-block').style.display='block';
	} 
});

 
$('.add-shedule-btn').on('click', function() {
	



});

//------------ Редактировать профиль на странице профиля ------------

//------Иконка "редактировать профиль"------
$('.edit-profile-btn').on('click', function() {
	document.getElementById('profile_content').style.display='none';
	document.getElementById('profile-info1').style.display='none';
	document.getElementById('change_profile_content').style.display='block';

});

//------Кнопка "назад" из блока редактирования ------
$('.go-back-toProfile-btn').on('click', function() {
	document.getElementById('profile_content').style.display='block';
	document.getElementById('profile-info1').style.display='block';
	document.getElementById('change_profile_content').style.display='none';
});

//------ Кнопка "изменить фото изображения" ------
$('#change-profile-img-btn').on('click', function() {
	document.getElementById('load_new_photo').style.display='block';
});

//------ Кнопка "добавить описание" ------
$('#change-master-info-btn').on('click', function() {
	document.getElementById('edit-info-block').style.display='block';
	document.getElementById('profile-info1').style.display='none';
	document.getElementById('profile_content').style.display='none';
	document.getElementById('change_profile_content').style.display='none';
});

//------ Кнопка "созранить описание" ------
$('#save-master-info-btn').on('click', function() {
	document.getElementById('edit-info-block').style.display='none';
	document.getElementById('profile_content').style.display='block';
	document.getElementById('profile-info1').style.display='block';

	let master_info = $('textarea[name="master-info-textarea"]').val();

	$.ajax({
		url:'/modules/pages_handlers/master_add_info_handler.php',
		type:'POST',
		data: {
			master_info: master_info
		},
		success (data) {
			$("#master-info").html(data);
		}
	});

});


/*------------Добавление курса в расписание-----------*/

$('#add_org_course_btn').click(function(e) {

	e.preventDefault();

	let course_id = $('select[name="course-select"]').val();
	let course_startDate = $('input[name="course-startDate-select"]').val();
	let course_groupType_id = $('select[name="course-groupType-select"]').val();
	
	$.ajax({
		url:'/modules/pages_handlers/masters_handlers/master_add_organized_course_handler.php',
		type:'POST',
		data: {
			course_id:course_id,
			course_startDate:course_startDate,
			course_groupType_id:course_groupType_id,
		},
		success (data) {
			$(".error_org_course").html(data);
			alert("Курс добавлен");
			/*document.location.href='/master_panel.php';*/
			//header('Location:/master_panel.php');
		}
	});
});


//------ Кнопка "изменить материал урока" ------
$('#change-lessonMaterial-btn').on('click', function() {
	document.getElementById('add-new-lesson-material').style.display='block';
});

//------ Кнопка "изменить материал урока" ------
$('#change-homeworkTask-btn').on('click', function() {
	document.getElementById('add-new-lesson-homeworkTask').style.display='block';
});



/*------------Добавление материала-----------*/

/*----Получение материала с поля----*/

let new_lesson_material=false;
let new_lesson_homework=false;

$('input[name="lesson-material"]').change(function(e)  {
	new_lesson_material=e.target.files[0]; 
});

$('input[name="lesson-homeworkTask"]').change(function(e)  {
	new_lesson_homework=e.target.files[0]; 
});


$('.save_edit_lesson_btn').click(function(e)  {
	e.preventDefault();
	let lesson_id=$(this).attr('id');
	
	let title = $('textarea[name="lesson-title"]').val(),
		description = $('textarea[name="lesson-description"]').val();

	let lessonFormData=new FormData();
	lessonFormData.append('lesson_id', lesson_id);
	lessonFormData.append('title', title);
	lessonFormData.append('description', description);
	lessonFormData.append('new_lesson_material', new_lesson_material);
	lessonFormData.append('new_lesson_homework', new_lesson_homework);

	$.ajax({
			url:'/modules/pages_handlers/masters_handlers/edit_lesson_handler.php',
			type:'POST',
			processData: false,
			contentType: false,
			cache: false,
			data: lessonFormData,
			dataType:'json',
			success (data) {
				alert("Изменения сохранены");
				//document.location.href='/master_panel.php';
			}
	});
});




function editLesson(id){
	
	let this_id=id;

	$.ajax({
		url:'/modules/pages_handlers/lesson_handler.php',
		type:'GET',
		data: {
			id: this_id
		},
		success (data) {
			alert("Редактирование");
			document.location.href='/edit_lesson.php?id='+data;
		}
	});


}


/*------------ Отметка пройденного урока -----------*/

$(document).on('click', '.course-lessons-checkboxes', function(){

	/*let id_lessons_progress=[];

	$('.lessons-ckbx:checked').each(function(key){
		id_lessons_progress[key]=$(this).val();
	});


*/
	let id_lesson_progress=$(this).attr('id');

	let lesson_title=$('#lesson-title'+id_lesson_progress).text();

	console.log(id_lesson_progress)

	let answer=confirm("Отметить урок как пройденный?");

	if(answer) {

		$.ajax({
			url:'modules/pages_handlers/masters_handlers/lesson_progress_handler.php',
			type:'POST',
			data: {
				id_lesson_progress:id_lesson_progress,
				lesson_title:lesson_title
			},
			success (data) {
				$('#course-lesson-item-'+id_lesson_progress).html(data);
			}
		});
	}
});
