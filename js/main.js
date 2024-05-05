

/*------------Форма получения консультации-----------*/

/*$('.take-consult-btn').click(function(e) {

	e.preventDefault();
	
	let user_name = $('input[name="user_name_consult"]').val(),
		user_telephone = $('input[name="user_telephone_consult"]').val();

	$.ajax({
		url:'modules/pages_handlers/consult_handler.php',
		type:'POST',
		data: {
			user_name: user_name,
			user_telephone: user_telephone
		},
		success (data) {
			alert("Заявка отправлена! Мы свяжемся с вами в ближайшее время");
			document.getElementById("user_name_consult").value="";
			document.getElementById("user_telephone_consult").value="";
		}
	});

});*/


/*------------Переход на страницу поста-----------*/

function showCourse(id){
	
	let this_id=id;
	console.log(this_id)

	$.ajax({
		url:'modules/pages_handlers/course_handler.php',
		type:'GET',
		dataType:'json',
		data: {
			id: this_id
		},
		success (data) {
			document.location.href='/course.php?id='+data;
		}
	});

}



  
/*------------Получение значений фильтров-----------*/

$(document).on('click', '.all-checkboxes', function(){

	let courses_id=[],
		masters_id=[],
		groups_type_id=[];

	$('.courses-ckbx:checked').each(function(key){
		courses_id[key]=$(this).val();
	});

	$('.masters-ckbx:checked').each(function(key){
		masters_id[key]=$(this).val();
	});

	$('.groups-ckbx:checked').each(function(key){
		groups_type_id[key]=$(this).val();
	});

	$.ajax({
		url:'modules/pages_handlers/filter_handler.php',
		type:'POST',
		data: {
			courses_id:courses_id,
			masters_id:masters_id,
			groups_type_id:groups_type_id	
		},
		success (data) {
			$(".courses-column").html(data);
		}
	});
});



/*------------Бронь курса на странице "Выбрать курс"-----------*/

//$('.reserve-btn').click(function(e) {
function applyCourse(id){

	let this_id=id;
	console.log(this_id);

	let answer=confirm("Вы уверены, что хотите подать заявку?");
	if(answer) {

		$.ajax({
			url:'modules/pages_handlers/apply_course_handler.php',
			type:'POST',
			data: {
				id_org_course:this_id,
			},
			success (data) {
				alert("Заявка подана. Отменить запись можно в личном кабинете");
				$('.status-or-reserve-btn'+this_id).html(data);
			}
		});
	}
}


