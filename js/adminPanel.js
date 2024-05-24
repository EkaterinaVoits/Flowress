
//------------ Боковое меню  ------------

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
	
	
	if (tab_id=='registration-admin-tab') {
		document.getElementById('admin-registration-block').style.display='block';
	} else if (tab_id=='masters-admin-tab') {
		document.getElementById('admin-masters-block').style.display='block';
	} else if (tab_id=='org-courses-tab') {
		document.getElementById('admin-organized-courses-block').style.display='block';
	} else if (tab_id=='ended-org-courses-tab') {
		document.getElementById('admin-ended-organized-courses-block').style.display='block';
	} else if (tab_id=='courses-admin-tab') {
		document.getElementById('admin-courses-block').style.display='block';
	} else if (tab_id=='lessons-admin-tab') {
		document.getElementById('admin-lessons-block').style.display='block';
	} else if (tab_id=='consult-admin-tab') {
		document.getElementById('admin-consult-block').style.display='block';
	}

});



/*------------Изменение статуса регистрации в админке-----------*/

$(".status_select").on('change', function(){
	
	let this_select_id=$(this).attr('id');
	console.log(this_select_id);
	var value=$(this).val();

	$.ajax({
		url:'/modules/pages_handlers/admins_handlers/change_reg_status_handler.php',
		type:'POST',
		data: {
			reg_status:value,
			id_status_select:this_select_id
		},
		success (data) {
			$("#course_status"+this_select_id).html(data);
			//document.getElementById("this_select_id").value="";
			document.getElementsByClassName('status_select').value="no_status";
		}
	});
});

/*------------Удаление регистрации в админке-----------*/

$('.del-reg-btn').click(function(e) {

	let this_id=$(this).attr('id');
	console.log(this_id);

	let answer=confirm("Вы уверены, что удалить запись?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/admins_handlers/admin_delete_reg_handler.php',
			type:'POST',
			data: {
				reg_id: this_id
			},
			success (data) {

				$(".reg-body-table").html(data);
				alert("Запись удалена");
			}
		});
	}
});





/*------------Удаление курса в админке-----------*/

//$('.del-master-btn').click(function(e) {
function deleteCourse(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что удалить курс?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/admins_handlers/admin_delete_course_handler.php',
			type:'POST',
			
			data: {
				course_id: this_id
			},
			success (data) {
				$(".courses-body-table").html(data);
			}
		});
	}
}

function endOrgCourse(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите завершить курс?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/admins_handlers/end_org_course_handler.php',
			type:'POST',
			
			data: {
				org_course_id: this_id
			},
			success (data) {
				$(".all-org-courses").html(data);
				document.getElementById('admin-organized-courses-block').style.display='block';
				
			}
		});
	}
}

function editOrgCourse(id){

	let this_id=id;
	new_id=this_id.slice(4)

	console.log(new_id);

	$.ajax({
		url:'/modules/pages_handlers/admins_handlers/edit_org_course_handler.php',
		type:'GET',
		data: {
			id: new_id
		},
		success (data) {
			document.location.href='/edit_org_course.php?id='+data;
		}
	});
}


/*------------Добавление регистрации на курс в админке-----------*/

$('#add_reg_btn').click(function(e) {

	e.preventDefault();

	let users_email = $('input[name="users-email"]').val();
	let id_orgCourse = $('select[name="org-course-select1"]').val();
	
	$.ajax({
		url:'/modules/pages_handlers/admins_handlers/add_reg_handler.php',
		type:'POST',
		data: {
			users_email:users_email,
			id_orgCourse: id_orgCourse
		},
		success (data) {
			document.getElementById("users_email").value="";
			$(".error_reg").html(data);
		}
	});
});

/*------------Добавление преподавателя в админке-----------*/

/*$('.add_master_btn').click(function(e) {

	e.preventDefault();

	let user_email = $('input[name="users-email"]').val();
	
	$.ajax({
		url:'/modules/pages_handlers/admins_handlers/add_master_handler.php',
		type:'POST',
		data: {
			master_email:user_email
		},
		success (data) {
			document.getElementById("users_email").value="";
			$(".error_master").html(data);
		}
	});
});
*/
function addMaster(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите добавить мастера?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/admins_handlers/add_master_handler.php',
			type:'POST',
			data: {
				user_id: this_id
			},
			success (data) {
				$("#admin-masters-block").html(data);
				alert("Мастер добавлен")
				/*$(".masters-requests-body-table").html(data);*/
			}
		});
	}
}

/*------------Удаление мастера в админке-----------*/

//function deleteMaster(id){
function deleteMaster(id){
	
	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что удалить мастера?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/admins_handlers/admin_delete_master_handler.php',
			type:'POST',
			data: {
				master_id: this_id
			},
			success (data) {
				$("#admin-masters-block").html(data);
			}
		});
	}
}


/*------------Добавление курса в расписание-----------*/

$('#add_org_course_btn').click(function(e) {

	e.preventDefault();

	let course_id = $('select[name="course-select"]').val();
	let master_id = $('select[name="master-select"]').val();
	let course_startDate = $('input[name="course-startDate-select"]').val();
\	let course_groupType_id = $('select[name="course-groupType-select"]').val();
	
	$.ajax({
		url:'/modules/pages_handlers/admins_handlers/admin_add_organized_course_handler.php',
		type:'POST',
		data: {
			course_id:course_id,
			master_id:master_id,
			course_startDate:course_startDate,
			course_groupType_id:course_groupType_id,
		},
		success (data) {
			$(".error_org_course").html(data);
			if() {
				document.location.href='/admin_panel.php';
			}
		}
	});
});


/*------------Добавление мастера в админке-----------*/

//----получение фото----
/*let masters_photo=false;

$('input[name="masters_photo"]').change(function(e)  {
	masters_photo=e.target.files[0]; 
});*/

/*
$('#add_master_btn').click(function(e) {

	e.preventDefault();
	
	let masters_name = $('input[name="masters-name"]').val();
	let masters_email = $('input[name="masters-email"]').val();
	let masters_telephone = $('input[name="masters-telephone"]').val();
	let masters_info = $('textarea[name="masters-info"]').val();

	let formDataMaster=new FormData();
	formDataMaster.append('masters_name', masters_name);
	formDataMaster.append('masters_email', masters_email);
	formDataMaster.append('masters_telephone', masters_telephone);
	formDataMaster.append('masters_info', masters_info);
	formDataMaster.append('masters_photo', masters_photo);
	
	$.ajax({
		url:'/modules/pages_handlers/add_master_handler.php',
		type:'POST',
		processData: false,
		contentType: false,
		cache: false,
		data: formDataMaster,
		success (data) {
			alert("Мастер добавлен");
			document.getElementById("masters_name").value="";
			document.getElementById("masters_email").value="";
			document.getElementById("masters_telephone").value="";
			document.getElementById("masters_info").value="";
			document.getElementById("masters_photo").value="";
			$(".masters-body-table").html(data);
		}
	});
});

*/

/*------------Изменение курса в админке-----------*/

function editCourse(id) {

	let course_id=id;

	let course_title = document.getElementById("title-course"+course_id).innerHTML;
	let course_description = document.getElementById("description-course"+course_id).innerHTML;
	let course_price = document.getElementById("price-course"+course_id).innerHTML;

	$.ajax({
		url:'/modules/pages_handlers/edit_course_handler.php',
		type:'POST',
		data: {
			course_id:course_id,
			course_title:course_title,
			course_description:course_description,
			course_price:course_price
		},
		success (data) {
			alert("Редактирование");
			$("#row"+course_id).html(data);
		}
	});
}

function saveChangesCourse(id) {

	let course_id=id;

	let new_course_title = $('textarea[name="new-course-title"]').val();
	let new_course_description = $('textarea[name="new-course-description"]').val();
	let new_course_price = $('input[name="new-course-price"]').val();

	$.ajax({
		url:'/modules/pages_handlers/admins_handlers/saveChanges_course_handler.php',
		type:'POST',
		data: {
			course_id:course_id,
			new_course_title:new_course_title,
			new_course_description:new_course_description,
			new_course_price:new_course_price
		},
		success (data) {
			alert("Сохранение");
			$("#row"+course_id).html(data);
		}
	});
}



/*------------Изменение статуса консультации в админке-----------*/

$(".consult_status_select").on('change', function(){
	
	let this_select_id=$(this).attr('id');
	var value=$(this).val();

	$.ajax({
		url:'/modules/pages_handlers/admins_handlers/change_consult_status_handler.php',
		type:'POST',
		data: {
			consult_status:value,
			id_status_select:this_select_id
		},
		success (data) {
			$("#consult_status"+this_select_id).html(data);
			document.getElementsByClassName('consult_status_select').value="no_status";
		}
	});
});

/*------------Удаление консультации в админке-----------*/

$('.del-consult-btn').click(function(e) {

	let this_id=$(this).attr('id');
	console.log(this_id);

	let answer=confirm("Вы уверены, что удалить запись?");
	if(answer) {
			$.ajax({
			url:'/modules/pages_handlers/admins_handlers/admin_delete_consult_handler.php',
			type:'POST',
			data: {
				consult_id: this_id
			},
			success (data) {
				$(".consult-body-table").html(data);
				alert("Запись удалена");
			}
		});
	}
});

