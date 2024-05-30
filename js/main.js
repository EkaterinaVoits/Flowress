

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


function showMoreOrgCourse(id) {

	let this_id=id;
	org_course_id=this_id.slice(21);

	$('#icon-'+org_course_id).toggleClass('rotate');

	$('#org-course-info-'+org_course_id).toggleClass('none');

	console.log(org_course_id);
}


$('.go-to-reserve-course').click(function(e) {

	height = document.body.scrollHeight;
	window.scrollTo({ top: height, behavior: 'smooth'});

});


$(document).ready(function() {
  $('#go-to-add-perconal-course').click(function(e) {
    e.preventDefault();

    window.location.href = '/catalog.php';
    height = document.body.scrollHeight;
    window.scrollTo({ top: 1000, behavior: 'smooth' });
  });
});