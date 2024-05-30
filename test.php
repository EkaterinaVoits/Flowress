<?php
	$message="Сообшение от Flowress";
	$to="kate06042003@gmail.com";
	$from="flowress@gmail.com";
	$subject="Тема сообщения";

	$subject="=?utf-8?B?".base64_encode($subject)."?=";
	$headers="From: $from\r\nReply-to: $from\r\nContent-type:text/plain; charset=utf-8\r\n";

	mail($to, $subject, $message, $headers);
?>