function makeBlurWhileOpening() {
   $('.page-content').css({
      "filter":"blur(10px)" 
    });
      $('body').css({
      "overflow":"hidden" 
    });
}

function removeBlurStyle(){
  $('.page-content').css({
    "filter":"blur(0px)"
  });
   $('body').css({
    "overflow":"visible" 
  });
}


$(document).ready(function() {
  $('.close-btn').click(function(event) {
   $('.masters-info-form').css({
    "display":"none"
  });
   $('.page-content').css({
    "filter":"blur(0px)"
  });
   $('body').css({
    "overflow":"visible" 
  });
   
 })
});


$('.show-masters-info-form').click(function(e) {

	e.preventDefault();

    $('.header-burger, .header-menu').removeClass('active');

    $('.masters-info-form').css({
    "display":"block"
  	});
    
    makeBlurWhileOpening();
   

   let user_id=this.id;

   console.log(user_id);

   $.ajax({
		url:'modules/pages_handlers/masters_info_handler.php',
		type:'POST',
		data: {
			user_id:user_id
		},
		success (data) {
			$("#masters-info").html(data);
		}
	});
	/*
	
	let user_review = $('textarea[name="review-textarea"]').val();

	
*/

});


$(document).ready(function() {
 
});