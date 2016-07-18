<?php
//require_once('../../engine/start.php');
//$user = elgg_get_logged_in_user_entity();
$username = "admin"; //$user->username;
$name = "Admin"; //$user->name;
$email = "support@campuskarma.in"; //$user->email;

$comment = $_POST["message"];

//Mail To The User Confirming The Creation
$to = "support@campuskarma.in";
$subject = "Linux Lab Service Request";
$headers = "From: Campus Karma <no-reply@campuskarma.in> \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = "Dear Admin<br><br>";
$message .= "$name (usename: $username, email: $email) has requested for a new service for Linux lab. His message includes:<br><br>";
$message .= "<i>$comment</i>";
mail($to, $subject, $message, $headers);
//system_message(elgg_echo("Thank you for your request. One of our representative will contact you within the next 48 hours."));
echo "Thank you for your request. One of our representative will contact you within the next 48 hours.";
//forward($_SERVER['HTTP_REFERER']);
?>