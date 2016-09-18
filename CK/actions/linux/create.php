<?php

//require_once('../../engine/start.php');
require_once('../../start.php');
require_once(dirname(__FILE__) . '/config.php');

$user = elgg_get_logged_in_user_entity();
$username = $user->username;
$name = $user->name;
$email = $user->email;

$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
$pass = array();
$alphaLength = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}
$salt = implode($pass);

$alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
$pass = array();
$alphaLength = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}
$password = implode($pass);

$cmdr = file_get_contents($linux_server . "create.php?password=$password&salt=$salt&username=$username");
//system_message(elgg_echo($cmdr));
echo $cmdr;

if ($cmdr == "") {
//Update Database Status As Activated.
    $con = mysqli_connect($lab_host, $lab_user, $lab_pass, $lab_db);
    if (mysqli_connect_errno()) {
//system_message(elgg_echo("Failed to connect to MySQL: " . mysqli_connect_error()));
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $exp_date = date('Y-m-d', strtotime("+90 days"));
    mysqli_query($con, "INSERT INTO userlist (name,username,status,password,expiry_date) VALUES ('$name', '$username','Active','$password', '$exp_date' )");
    mysqli_close($con);

//Mail To The User Confirming The Creation
    $to = "$email";
    $subject = "Campus Karma : Linux User Creation Request";
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
Thanks for choosing Campus Karma. You're ready to get started.<br><br>This is in reference to your account creation request for linux ssh access on our lab portal, We are happy to inform you that your account has been created successfully.<br><br>Please find below your login details:<br><br><b>Host: campuskarma.cloudapp.net<br>Port: 22<br>User name: $username<br>Password: $password<br>Account Expiry: $exp_date</b><br><br>Please Note, Your account is active for 90 days, prior to that you can extend the usage period for which you have to login to the portal and request for the extension. It is also requested that you login to your account and change your password. For more details on how to login <a href='" . elgg_get_site_url() . "linux/instruction'>click here</a>.
<br><br><br>Thanks & Regards, <br><b>Team Campus Karma</b><br><br><br>
<span>
Keep yourself updated. Follow us on <a href='https://www.facebook.com/campuskarma' target='_blank'>Facebook</a>, <a href='https://twitter.com/CampusKarma' target='_blank'>Twitter</a> or <a href='https://plus.google.com/+CampuskarmaIndia/' target='_blank'>Google+</a><br>Having problems using Campus Karma? Just <a href='http://www.campuskarma.in/contact' target='_blank'>Contact Us</a>.
<br><br><br>Please don't reply to this message. We can't receive email at this address, so we won't respond.<br>Please add <a href='mailto:no-reply@campuskarma.in'>no-reply@campuskarma.in</a> to your address book to ensure delivery of our emails to your inbox<br><br>
</span>
</div>
</body>
</html>";
//mail($to, $subject, $message, $headers);
//system_message(elgg_echo("User has been created successfully. Check your mail for login details."));
    echo "User has been created successfully. Check your mail for login details.";
} else {
//system_message(elgg_echo($cmdr));
//system_message(elgg_echo("There has been a problem with the execution, Please try again"));
    echo "There has been a problem with the execution, Please try again";
}
//forward($_SERVER['HTTP_REFERER']);
?>
