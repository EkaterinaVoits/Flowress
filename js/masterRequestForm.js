
let portfolio=false;

$('input[name="portfolio"]').change(function(e)  {
	portfolio=e.target.files[0]; 
});



$('.add-master-request-btn').click(function(e)  {

	e.preventDefault();
	$(`input`).removeClass('error-input');
	
	let telephone = $('input[name="user_telephone"]').val();

	let formData=new FormData();
	formData.append('telephone', telephone);
	formData.append('portfolio', portfolio);

	$.ajax({
		url:'modules/pages_handlers/master_request_handler.php',
		type:'POST',
		dataType:'json',
		processData: false,
		contentType: false,
		cache: false,
		data: formData,
		success (data) { 
			if(data.status) {
				alert("Вы подали заявку преподавателя. В ближайшее время с вами свяжется администратор");
				document.getElementById("portfolio").value="";
				document.getElementById("user_telephone").value="";

				$(`input`).removeClass('error-input');
				
				$(`span[name="telephone-error-span"]`).addClass('none');
				$(`span[name="portfolio-error-span"]`).addClass('none');

			} else {
				if(data.type===1){
					data.fields.forEach(function(field){
						$(`input[name="${field}"]`).addClass('error-input');
					}); 

				$(`span[name="portfolio-error-span"]`).removeClass('none').text(data.portfolioError);
				$(`span[name="telephone-error-span"]`).removeClass('none').text(data.telephoneError);
				}
			}
		}
	});
});

const element = document.getElementById('user_telephone');
const maskOptions = {
  mask: '+375 (00) 000-00-00',
  lazy:false
};
const mask = IMask(element, maskOptions);

