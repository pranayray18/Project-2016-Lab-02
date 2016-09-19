<?php
//require_once('../../engine/start.php');
require_once('../../start.php');
require_once(dirname(__FILE__).'/config.php');

//$user = elgg_get_logged_in_user_entity();
$username = "admin"; //$user->username;
$name = "Admin"; //$user->name;
$email = "support@campuskarma.in"; //$user->email;

$output = file_get_contents($linux_server."delete.php?username=$username");
$vars = explode('|', $output);
$cmdr1 = $vars[0];
$cmdr2 = $vars[1];

if($cmdr1 == "" && $cmdr2 == ""){
//Update Database Status As Deactivated.
$con = mysqli_connect($lab_host,$lab_user,$lab_pass,$lab_db);
if (mysqli_connect_errno()) {
//system_message(elgg_echo("Failed to connect to MySQL: " . mysqli_connect_error()));
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_query($con,"UPDATE userlist SET status='Deactivated', password='null0null1', expiry_date='0000-00-00' WHERE username = '$username'");
mysqli_close($con);

//Mail To The User Confirming The Deletion.
$to = "$email";
$subject = "Campus Karma : Linux User Deactivation Request";
$headers = "From: Campus Karma <no-reply@campuskarma.in> \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = "<html>
<head>
<style>
body,html {padding:0px;margin:0px;}
.wrapper {
width: 500px;
display: block;
margin-left:auto;
margin-right:auto;
margin-top: 10px;
margin-bottom: 10px;
font-family: Tahoma, Geneva, sans-serif;
font-size: 14px;
}
a:link, :visited, :hover, :active { text-decoration: none; color: navyblue;}
span { font-size: 10px; }
</style>
</head>
<body>
<div class='wrapper'>
<h1>Welcome to Campus Lab!</h1>Dear $name<br><br>
Thanks for choosing Campus Karma. We hope to see you soon.<br><br>This is in reference to your account deactivation request for linux ssh access on our lab portal, your account has been deactivated successfully.<br><br>Please note, Deactivating your account has lead to deletion of all the files of your home directory as well. Your files will not be restored once you reactivate your account. For more details on how to reactivate your account <a href='".elgg_get_site_url()."linux/account'>click here</a>.
<br><br><br>Thanks & Regards, <br><b>Team Campus Karma</b><br><br><br>
<span>
Keep yourself updated. Follow us on <a href='https://www.facebook.com/campuskarma' target='_blank'>Facebook</a>, <a href='https://twitter.com/CampusKarma' target='_blank'>Twitter</a> or <a href='https://plus.google.com/+CampuskarmaIndia/' target='_blank'>Google+</a><br>Having problems using Campus Karma? Just <a href='http://www.campuskarma.in/contact' target='_blank'>Contact Us</a>.
<br><br><br>Please don't reply to this message. We can't receive email at this address, so we won't respond.<br>Please add <a href='mailto:no-reply@campuskarma.in'>no-reply@campuskarma.in</a> to your address book to ensure delivery of our emails to your inbox<br><br>
</span>
</div>
</body>
</html>";
mail($to, $subject, $message, $headers);
//system_message(elgg_echo("User has been deactivated successfully. Check your mail for confirmation."));
echo "User has been deactivated successfully. Check your mail for confirmation.";
} else {
//system_message(elgg_echo($cmdr1));
//system_message(elgg_echo($cmdr2));
//system_message(elgg_echo("There has been a problem with the execution, Please try again"));
echo "There has been a problem with the execution, Please try again";
}

//forward($_SERVER['HTTP_REFERER']);
?>