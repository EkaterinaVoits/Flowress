
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
	} else if (tab_id=='user-requests-tab') {
		document.getElementById('user-requests-block').style.display='block';
	} else if (tab_id=='user-courses-tab') {
		document.getElementById('user-courses-block').style.display='block';
	} else if (tab_id=='education-tab') {
		document.getElementById('user-education-block').style.display='block';
	} else if (tab_id=='user-archive-tab') {
		document.getElementById('user-archive-block').style.display='block';
	} 
});

 


//------------ Редактировать профиль на странице профиля ------------

//------Иконка "редактировать профиль"------
$('.edit-profile-btn').on('click', function() {
	document.getElementById('profile_content').style.display='none';
	document.getElementById('change_profile_content').style.display='block';
});

//------Кнопка "назад" из блока редактирования ------
$('.go-back-toProfile-btn').on('click', function() {
	document.getElementById('profile_content').style.display='block';
	document.getElementById('change_profile_content').style.display='none';
});

//------ Кнопка "изменить фото изображения" ------
$('#change-profile-img-btn').on('click', function() {
	document.getElementById('load_new_photo').style.display='block';
});

//-------- Редактировать профиль на странице профиля --------


/*----Получение аватарки с поля----*/

let new_user_photo=false;

$('input[name="new_profile_photo"]').change(function(e)  {
	new_user_photo=e.target.files[0]; 
});


$('.save_edit_changes').click(function(e)  {

	e.preventDefault();
	let user_email_beforeChanges=$(this).attr('id');

	$(`input`).removeClass('error-input');
	$(".error-span").addClass('none');
	
	let name = $('input[name="profile_name"]').val(),
		email = $('input[name="profile_email"]').val(),
		telephone = $('input[name="profile_telephone"]').val(),
		old_password = $('input[name="old_password"]').val(),
		new_password = $('input[name="new_password"]').val(),
		password_confirm = $('input[name="new_password_confirm"]').val();

	let userFormData=new FormData();
	userFormData.append('name', name);
	userFormData.append('user_email_beforeChanges', user_email_beforeChanges);
	userFormData.append('email', email);
	userFormData.append('telephone', telephone);
	userFormData.append('old_password', old_password);
	userFormData.append('new_password', new_password);
	userFormData.append('password_confirm', password_confirm);
	userFormData.append('new_user_photo', new_user_photo);

	$.ajax({
			url:'/modules/pages_handlers/edit_profile_handler.php',
			type:'POST',
			processData: false,
			contentType: false,
			cache: false,
			data: userFormData,
			dataType:'json',
			success (data) {
				if(data.status) {
					alert("Изменения сохранены");
					
					$("#profile-name1").text(data.new_name);
					$("#profile-telephone1").text(data.new_telephone);
					$("#profile-email1").text(data.new_email);

					document.getElementById("profile-img").src="../../images/users_photos/"+data.new_photo;
					document.getElementById("profile-img2").src="../../images/users_photos/"+data.new_photo;
					document.getElementById("new_profile_photo_input").value="";

					document.getElementById("old_password").value="";
					document.getElementById("new_password").value="";
					document.getElementById("new_password_confirm").value="";

					document.getElementById('profile_content').style.display='block';
					document.getElementById('change_profile_content').style.display='none';

				} else {

					if(data.type===1){

						alert("Изменения не были сохранены");

						data.fields.forEach(function(field){
						$(`input[name="${field}"]`).addClass('error-input');
						});

					}

					$(`span[name="profile_name-error-span"]`).removeClass('none').text(data.nameError);
					$(`span[name="profile_telephone-error-span"]`).removeClass('none').text(data.telephoneError);
					$(`span[name="profile_email-error-span"]`).removeClass('none').text(data.emailError);
					$(`span[name="old_password-error-span"]`).removeClass('none').text(data.oldPasswordError);
					$(`span[name="new_password-error-span"]`).removeClass('none').text(data.newPasswordError);
					$(`span[name="new_password_confirm-error-span"]`).removeClass('none').text(data.confirmPasswordError);

				}
			}
	});
});


/*------------Отмена курса в профиле -----------*/

//$('.cancel-reg-btn').click(function(e) {
function cancelReg(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите отменить заявку?");
	if(answer) {

		$.ajax({
			url:'/modules/pages_handlers/user_delete_reg_handler.php',
			type:'POST',
			data: {
				reg_id: this_id
			},
			success (data) {
				$("#user-courses-block").html(data);
				alert("Запись отменена");
			}
		});
	}
}


