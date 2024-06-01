
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
		document.getElementById('all-master-courses').style.display='none';
		document.getElementById('profile-block').style.display='block';
	} else if (tab_id=='user-courses-tab') {
		document.getElementById('all-master-courses').style.display='block';
		document.getElementById('user-courses-block').style.display='block';
	} else if (tab_id=='user-archive-courses-tab') {
		document.getElementById('all-master-courses').style.display='block';
		document.getElementById('user-archive-courses-block').style.display='block';
	} else if (tab_id=='school-courses-tab') {
		document.getElementById('all-master-courses').style.display='none';
		document.getElementById('school-courses-block').style.display='block';
	} else if (tab_id=='school-lessons-tab') {
		document.getElementById('all-master-courses').style.display='none';
		document.getElementById('school-lessonss-block').style.display='block';
	} else if (tab_id=='education-tab') {
		document.getElementById('all-master-courses').style.display='none';
		document.getElementById('user-education-block').style.display='block';
	} 
});



 
$('.add-shedule-btn').on('click', function() {
	



});

function showSheduleBlock(id){
	
	let this_id=id;
	var button = document.getElementById(this_id);
    var buttonText = button.getElementsByTagName('span')[0];
    var image = button.getElementsByTagName('img')[0];

    if (buttonText.innerHTML === 'Составить график') {
      buttonText.innerHTML = 'Свернуть';
      image.style.transform = 'rotate(180deg)';
    } else {
      buttonText.innerHTML = 'Составить график';
      image.style.transform = 'rotate(0deg)';
    }

	new_id=this_id.slice(16);

	$('#add-schedule-block-'+new_id).toggleClass('none');

}

/*$('.add-shedule-item-btn').click(function(e) {

	alert("ggggg");

	
	
	let schedule_block = document.getElementById('add-schedule-block');

	let schedule_item = schedule_block.querySelector('.schedule-item');
	let schedule_item_clone = schedule_item.cloneNode(true);
	
	schedule_block.appendChild(schedule_item_clone)

});*/

/*------------Деактивация курса-----------*/

function archiveCourse(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите архивировать курс?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/masters_handlers/archive_course_handler.php',
			type:'POST',
			data: {
				course_id: this_id
			},
			success (data) {
				$("#school-courses-block").html(data);
			}
		});
	}
}


/*------------Активация курса-----------*/

function activateCourse(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите активировать курс?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/masters_handlers/activate_course_handler.php',
			type:'POST',
			data: {
				course_id: this_id
			},
			success (data) {
				$("#school-courses-block").html(data);
			}
		});
	}
}


/*------------Деактивация урока -----------*/

function archiveLesson(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите архивировать урок?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/masters_handlers/archive_lesson_handler.php',
			type:'POST',
			data: {
				lesson_id: this_id
			},
			success (data) {
				$("#user-education-block").html(data);
			}
		});
	}
}


/*------------Активация урока -----------*/

function activateLesson(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите активировать урок?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/masters_handlers/activate_lesson_handler.php',
			type:'POST',
			data: {
				lesson_id: this_id
			},
			success (data) {
				$("#user-education-block").html(data);
			}
		});
	}
}

function addSheduleItem(id){
	
	let course_item_id=id;
	console.log(course_item_id)

	//получение родительского элемента
	let schedule_block = document.getElementById('schedule-block-'+course_item_id);

	//получение элемента селект
	let schedule_item = schedule_block.querySelector('.schedule-item');
	let schedule_item_clone = schedule_item.cloneNode(true);
	
	//добавляем копию селекта в родительский блок
	schedule_block.appendChild(schedule_item_clone)

}

function saveShedule(id){
	
	let org_course_item_id=id;

	let schedule_block = document.getElementById('add-schedule-block-'+org_course_item_id);

	//получение массива всех селектов
	let schedule_items = schedule_block.querySelectorAll('.schedule-item');

	const schedule_items_array = [];

	//запись значений селектов в массив
	for (let i = 0; i < schedule_items.length; i++) {
	  schedule_items_array.push(schedule_items[i].value);
	}

	console.log(schedule_items_array)


	$.ajax({
		url:'/modules/pages_handlers/masters_handlers/master_add_schedule_handler.php',
		type:'POST',
		data: {
			schedule_items_array:schedule_items_array, 
			org_course_item_id:org_course_item_id
		},
		success (data) {
			alert("Расписание для курса добавлено");
			$('.org-course-schedule-block-'+org_course_item_id).html(data);
			$('#list-img-'+org_course_item_id).attr("src", "images/icons/added_shedule.svg");
		}
	});
}


/*$.ajax({
		url:'/modules/pages_handlers/masters_handlers/master_add_schedule_handler.php',
		type:'POST',
		data: {
			schedule_items_array:schedule_items_array, 
			org_course_item_id:org_course_item_id
		},
		dataType:'json',
		success (data) {
			if(data.status) {
				alert("Расписание для курса добавлено");
				$('.org-course-schedule-block-'+org_course_item_id).html(data);
				$('#list-img-'+org_course_item_id).attr("src", "images/icons/added_shedule.svg");

			} else {
				
			}
			
		}
	});*/


function deleteShedule(id){
	
	let org_course_id=id;

	let answer=confirm("Вы уверены, что хотите удалить график курса?");
	if(answer) {
		$.ajax({
			url:'/modules/pages_handlers/masters_handlers/master_delete_schedule_handler.php',
			type:'POST',
			data: {
				org_course_id:org_course_id
			},
			success (data) {
				alert("График курса удалён");
				$('.org-course-schedule-block').html(data);
				
			}
		});
	}
}




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
	$('#course-start-date-error-span').addClass('none');
	$(`input[name="course-startDate-select"]`).removeClass('error-input');

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
		dataType:'json',
		success (data) {

			if(data.status) {
				alert("Курс добавлен в расписание");
				document.location.href='/master_panel.php';

			} else {
				$(`input[name="course-startDate-select"]`).addClass('error-input');
				$('#course-start-date-error-span').removeClass('none');
				

			}
			
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






function editLesson(id){
	
	let this_id=id;

	$.ajax({
		url:'/modules/pages_handlers/lesson_handler.php',
		type:'GET',
		data: {
			id: this_id
		},
		success (data) {
			document.location.href='/edit_lesson.php?id='+data;
		}
	});
}


function editCourse(id){
	
	let this_id=id;

	$.ajax({
		url:'/modules/pages_handlers/course2_handler.php',
		type:'GET',
		data: {
			id: this_id
		},
		success (data) {
			document.location.href='/edit_course.php?id='+data;
		}
	});
}




function endOrgCourse(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите завершить курс?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/masters_handlers/end_org_course_handler.php',
			type:'POST',
			
			data: {
				org_course_id: this_id
			},
			success (data) {
				$("#all-master-courses").html(data);
				alert("Курс завершён")
				document.getElementById('user-courses-block').style.display='block';
			}
		});
	}
}

function editOrgCourse(id){
	
	let this_id=id;
	new_id=this_id.slice(5);

	console.log(new_id);

	$.ajax({
		url:'/modules/pages_handlers/org_course_handler.php',
		type:'GET',
		data: {
			id: new_id
		},
		success (data) {
			document.location.href='/edit_org_course.php?id='+data;
		}
	});
}

function deleteOrgCourse(id){
	
	let this_id=id;
	new_id=this_id.slice(7);

	console.log(new_id);

	let answer=confirm("Вы уверены, что хотите удалить курс из расписания?");
	if(answer){
		$.ajax({
			url:'/modules/pages_handlers/masters_handlers/delete_org_course_handler.php',
			type:'POST',
			data: {
				id_org_course: new_id
			},
			dataType:'json',
			success (data) {
				if(data.status) {
					$('.master-courses-cards').html(data);
					$('.refresh-page-msg').removeClass('none');
					alert("Курс удалён");

				} 
			}
		});
	}
}

function saveEditOrgCourse(id){
	
	let this_id=id;
	let course_startDate = $('input[name="course-startDate-select"]').val(),
		course_groupType_id = $('select[name="course-groupType-select"]').val();
	
	$.ajax({
		url:'/modules/pages_handlers/masters_handlers/edit_org_course_handler.php',
		type:'POST',
		data: {
			org_course_id: this_id,
			course_startDate:course_startDate,
			course_groupType_id:course_groupType_id
		},
		success (data) {
			alert("Курс изменён");
			/*document.location.href='/master_panel.php';*/
		}
	});
}

/*------------ Отметка пройденного урока -----------*/

$(document).on('click', '.course-lessons-checkboxes', function(){

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


/*const element = document.getElementById('phone');
const maskOptions = {
  mask: '+375 (00) 000-00-00',
  lazy:false
};
const mask = IMask(element, maskOptions);*/