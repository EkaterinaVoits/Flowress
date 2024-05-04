/*------------Добавление комментария и рейтинга-----------*/


 $('.rating-lips').on('click', function() {
	lips_rating_id=this.id;
	console.log(lips_rating_id);

	all_rating_lips=document.getElementsByClassName('rating-lips');

	for(i=0; i<lips_rating_id; i++) {
		all_rating_lips[i].style.fill='black';
	}

	for (t = lips_rating_id; t < 5; t++) {
		all_rating_lips[t].style.fill='red';
	}

 });


$('.add-review-btn').click(function(e) {

	e.preventDefault();
	
	let user_review = $('textarea[name="review-textarea"]').val();

	$.ajax({
		url:'modules/pages_handlers/comment_handler.php',
		type:'POST',
		data: {
			review:user_review, 
			lips_rating_id:lips_rating_id
		},
		success (data) {
			document.getElementById("review-textarea").value="";

			for(i=0; i<5; i++) {
				all_rating_lips[i].style.fill='blue';
			}

			alert('dfgh');			
			$("#slider-reload").html(data);
		}
	});


});