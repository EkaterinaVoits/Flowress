<?php


require_once __DIR__ . '/vendor/autoload.php';
$settings = require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/functions.php';


$body="<h1>Ваша заявка на курс одобрена</h1>\n
Посмотреть подробности о курсе можноо в личном кабинете";

$attachments=[
	__DIR__ . '/img/4.jpg',
	__DIR__ . '/img/5.jpg',
];

var_dump(send_mail($settings['mail_settings_prod'], ['katevoits06@gmail.com'], 'Письмо с сайта Flowress', $body));

?>
