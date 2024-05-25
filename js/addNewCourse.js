$('#add_new_course_btn').click(function(e) {

	let course_title = $('input[name="course_title"]').val(),
		course_description = $('textarea[name="course_description"]').val();
		course_full_description = $('textarea[name="course_full_description"]').val();
		course_price = $('input[name="course_price"]').val();

	let lessons_id=[];

	$('.lessons-ckbx:checked').each(function(key){
		lessons_id[key]=$(this).val();
	});

	$.ajax({
		url:'modules/pages_handlers/add_new_course_handler.php',
		type:'POST',
		data: {
			course_title:course_title, 
			course_description:course_description,
			course_full_description:course_full_description,
			course_price:course_price,
			lessons_id:lessons_id
		},
		success (data) {
			$(".massage_add_new_course").html(data);
		}
	});
});

