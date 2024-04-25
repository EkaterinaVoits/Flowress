<!DOCTYPE html>
<?php 
	if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	include 'connect\connect_database.php';
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Flowress</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
	<?php require 'modules/page_elements/header.php';?>
	
	<div class="page-content">

	<!-- HOME SCREEN -->
	<div class="home-screen">

		<div class="bgr-image bgr-paralax home-img" >
		</div>

		<div class="home-block-wrapper">
			<div class="container">
				<div class="about-description">
					<p class="about-description-1 ">
						Курсы визажа для новичков и продвинутых
					</p>

					<hr class="dividing-line">

					<p class="about-description-2">
						школа визажа
					</p>	
				</div>
				
				<div class="home-btn-wrapper">
					<a class="btn" href="courses.html">
						<p>Записаться на курс</p>
						<img src="images/arrow.png" class="arrow">
					</a>	
				</div>	
			</div>

		</div>

	</div>
	<!-- /HOME SCREEN -->

	<!-- WHITE BLOCK -->
	<div class="white-block">
		<div class="container">
			<div class="white-block-wrapper">
				<div class="white-rectangle">
					<div class="white-block-content">
						<div>уже более 10 лет создаём</div>
						<p class="title">ПРОФЕССИОНАЛЬНЫЕ КУРСЫ</p>
						<div>ПО ОБУЧЕНИЮ МАСТЕРОВ ИНДУСТРИИ КРАСОТЫ</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /WHITE BLOCK -->

	<!-- LEFT PLANT -->
	<img src="images/plant_1.png" class="plant plant_1">

	<!-- ABOUT BLOCK -->
	<div class="block block-1">
		<div class="container">
			<div class="about-block">

				<div class="image-rect about-block-img">
					<img src="images/about_block_img.png">
				</div>

				<div class="about-block-content">

					<div class="title-group">
						<p class="title first-title">НЕМНОГО</p>
						<p class="title second-title">о школе</p>
					</div>

					<div class="about-content-text">
						Наша авторская система модульного обучения сочетает в себе фундаментальные знания и современные техники макияжа.
						<br><br>
						Благодаря системному подходу и всегда актуальной информации, ученики добиваются высоких результатов, следуя всем рекомендациям преподавателей начинают успешную карьеру в beauty-индустрии!
					</div>

				</div>

			</div>
		</div>
	</div>
	<!-- /ABOUT BLOCK -->

	<!-- RIGHT PLANT -->
	<img src="images/plant_2.png" class="plant plant_2">

	<!-- ADVANTAGE BLOCK -->
	<div class="block block-2">
		<div class="brown-rect">
			<div class="white-line">
				<div class="container">

					<div class="advantages-block-content">
						<div class="advantage">
							<img src="images/advantage_1.png">
							<div>
								Мы предоставляем  качественную  косметику для учеников нашей школы
							</div>
						</div>

						<div class="advantage">
							<img src="images/advantage_2.png">
							<div>
								Удобная локация в центре города, можно добраться на транспорте из любой точки
							</div>
						</div>

						<div class="advantage">
							<img src="images/advantage_3.png">
							<div>
								Мы создали лучшую программу: минимум времени и максимум знаний
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>
	<!-- /ADVANTAGE BLOCK -->

	<!-- LEFT PLANT -->
	<img src="images/plant_3.png" class="plant plant_3">

	<!-- SPLATTERS -->
	<img src="images/splatters_1.png" class="splatters splatters_1">

	<!-- RIGHT PLANT -->
	<img src="images/plant_4.png" class="plant plant_4">

	<!-- ABOUT FOUNDER BLOCK -->
	<div class="block block-3">
		<div class="container">
			<div class="about-block">

				<div class="about-founder-block">
					<!-- title -->
					<div class="title-group">
						<p class="title first-title">основатель курсов</p>
						<p class="title second-title">АННА НЕКРАСОВА</p>
					</div>

					<div class="about-founder-text">
						Анна является основателем студии красоты и ведущим визажистом международного уровня с опытом работы более 12 лет
						<br><br>
						Действующим преподавателем в собственной школе макияжа непрерывно повышает свою квалификацию, проходит различные стажировки, мастер-классы и семинары, что позволяет всегда оставаться в курсе современных техник и инноваций.
					</div>
				</div>

				<div class="image-rect founder-img">
					<img src="images/founder_img.png">
				</div>

			</div>
		</div>
	</div>
	<!-- /ABOUT FOUNDER BLOCK -->

	<!-- SPLATTERS -->
	<img src="images/splatters_2.png" class="splatters splatters_2">


	<!-- PARRALAX BLOCK -->
	<div class="block block-4">

		<div class="bgr-image bgr-paralax center-paralax">

		</div>

		<div class="text-block-wrapper">
			<div class="container">
				<div class="text-block">
					<p class="text-block-1 ">
						Мы докажем, что красота- 
					</p>
					<p class="text-block-2">
						ваш лучший выбор
					</p>	
				</div>		
			</div>
		</div>
	</div>
	<!-- /PARRALAX BLOCK -->


	<!-- POPULAR COURSES BLOCK -->
	<div class="block block-5">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">ПОПУЛЯРНЫЕ КУРСЫ </p>
				<p class="title second-title">НАШЕЙ ШКОЛЫ</p>
			</div>

			<div class="cards-block">

				<div class="card">
					<div class="card-content">
						<img src="images/card_img1.png" class="card-img">
						<div>
							<p class="title">базовый визажист</p>
							<div>
								Для тех, кто хочет попробовать профессию "визажист" и освоить базовые техники макияжа
							</div>
						</div>
					</div>
					<div class="two-lines"></div>
				</div>

				<div class="card center-card">
					<div class="card-content">
						<img src="images/card_img2.png" class="card-img">
						<div>
							<p class="title">сам себе визажист</p>
							<div>
								Чтобы быть неотразимой каждый день и уметь создать образ на каждый случай
							</div>
						</div>
					</div>
					<div class="two-lines"></div>
				</div>

				<div class="card">
					<div class="card-content">
						<img src="images/card_img3.png" class="card-img">
						<div>
							<p class="title">продвинутый визажист</p>
							<div>
								Для опытных визажистов, кто не готов стоять на месте и хочет прокачать свои знания
							</div>
						</div>
					</div>
					<div class="two-lines"></div>
				</div>

			</div>

			<div class="btn-wrapper">
				<a class="btn" href="courses.html">
					<p>Узнать больше</p>
					<img src="images/arrow.png" class="arrow">
				</a>	
			</div>

		</div>
	</div>
	<!-- /POPULAR COURSES -->

	<!-- RIGHT PLANT -->
	<img src="images/plant_5.png" class="plant plant_5">

	<!-- LEFT PLANT -->
	<img src="images/plant_3.png" class="plant plant_6">


	<!-- SERVICES BLOCK -->
	<div class="block block-6" id="services-block">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">услуги, КОТОРЫЕ МЫ </p>
				<p class="title second-title">ПРЕДОСТАВЛЯЕМ</p>
			</div>

			<div class="services">

				<div>
					<div class="service-item">
						<div class="service-title">
							Причёски
						</div>
						<div class="show-block">
							<span></span>
						</div>
					</div>

					<div class="more-content">
						<div class="more-content-wrapper">

							<!-- Block Image -->
							<div class="image-rect service-img">
								<img src="images/hair_4.jpg">
							</div>

							<div class="services-list">

								<div class="service">
									<div class="service-description">Классические локоны</div>
									<div class="service-price">80 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Голливудские локоны</div>
									<div class="service-price">90 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Высокий пучок</div>
									<div class="service-price">90 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Низкий пучок с плетением</div>
									<div class="service-price">100 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Хвост с локонами</div>
									<div class="service-price">70 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Косы и плетения</div>
									<div class="service-price">100 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Причёска "Мальвина"</div>
									<div class="service-price">80 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Причёска «Ракушка»</div>
									<div class="service-price">80 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Причёска «Объёмные косы»</div>
									<div class="service-price">90 BYN</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				

				<div>
					<div class="service-item">
						<div class="service-title">
							Макияж
						</div>
						<div class="show-block">
							<span></span>
						</div>
					</div>

					<div class="more-content">
						<div class="more-content-wrapper">

							<div class="image-rect service-img">
								<img src="images/service_img.png">
							</div>

							<div class="services-list">

								<div class="service">
									<div class="service-description">Повседневный макияж</div>
									<div class="service-price">60 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Nude makeup</div>
									<div class="service-price">70 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Smoky eyes</div>
									<div class="service-price">110 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Коммерческий макияж</div>
									<div class="service-price">120 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Тематический макияж</div>
									<div class="service-price">120 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Вечерний макияж</div>
									<div class="service-price">100 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Colour makeup</div>
									<div class="service-price">100 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Hollywood makeup</div>
									<div class="service-price">100 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Cat eyes</div>
									<div class="service-price">90 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Свадебный макияж</div>
									<div class="service-price">140 BYN</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>


				<div>
					<div class="service-item">
						<div class="service-title">
							Маникюр/педикюр
						</div>
						<div class="show-block">
							<span></span>
						</div>
					</div>

					<div class="more-content">
						<div class="more-content-wrapper">

							<div class="image-rect service-img">
								<img src="images/nails.jpg">
							</div>

							<div class="services-list">
								<div class="service">
									<div class="service-description">Аппаратный маникюр</div>
									<div class="service-price">35 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Наращивание ногтей</div>
									<div class="service-price">65 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Коррекция ногтей</div>
									<div class="service-price">60 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Покрытие ногтей гель-лаком</div>
									<div class="service-price">50 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Укрепление гелем/акриловой пудрой</div>
									<div class="service-price">+5 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Френч</div>
									<div class="service-price">+5 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Дизайн (слайдеры, фольга, втирка, стразы)</div>
									<div class="service-price">+1 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Педикюр</div>
									<div class="service-price">45 BYN</div>
								</div>
								<div class="service">
									<div class="service-description">Педикюр с обработкой стоп</div>
									<div class="service-price">55 BYN</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /SERVICES BLOCK -->

	<!-- RIGHT PLANT -->
	<img src="images/plant_6.png" class="plant plant_7">

	<!-- STUDENTS WORKS BLOCK -->
	<div class="block block-7">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">РАБОТЫ</p>
				<p class="title second-title">НАШИХ УЧЕНИКОВ</p>
			</div>

			<div class="students_works">
				<img src="images/students_works_img.png">
			</div>
		</div>
	</div>
	<!-- /STUDENTS WORKS BLOCK -->

	<!-- SPLATTERS -->
	<img src="images/splatters_3.png" class="splatters splatters_3">

	<!-- LEFT PLANT -->
	<img src="images/plant_7.png" class="plant plant_8">

	<!-- SPLATTERS -->
	<img src="images/splatters_4.png" class="splatters splatters_4">

	<!-- RIGHT PLANT -->
	<img src="images/plant_2.png" class="plant plant_9">

	<!-- CONSULTATION BLOCK -->
	<!-- <div class="block block-8">
		<div class="container">

			<div class="title-group">
				<p class="title first-title">ДЛЯ КОНСУЛЬТАЦИИ</p>
				<p class="title second-title">ЗАПОЛНИТЕ ФОРМУ</p>
			</div>

			<div class="white-form-wrapper">
				<div class="white-form">
					<div class="form-content">

						<div>
							<p>Ваше имя</p>
							<input type="text" name="name" size="30" class="border-style">
						</div>
						<div>
							<p>Номер телефона</p>
							<input type="text" name="telephone" size="30" class="border-style">
						</div>

						<button class="form-btn">
							<p>Отправить</p>
							<img src="images/arrow.png" class="arrow">
						</button>

					</div>
					<div class="two-lines"></div>
				</div>
			</div>
		</div>
	</div> -->

	<?php require 'modules/page_elements/consult_form.php';?>

	<!-- /CONSULTATION BLOCK -->

	</div>
</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/main.js"></script>

</html>




