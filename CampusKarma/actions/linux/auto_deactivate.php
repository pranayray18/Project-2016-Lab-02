<?php
//require_once('../../engine/start.php');
require_once('../../start.php');
require_once(dirname(__FILE__).'/config.php');

date_default_timezone_set('Asia/Kolkata');

$con = mysqli_connect($lab_host,$lab_user,$lab_pass,$lab_db);
if (mysqli_connect_errno()) {
//system_message(elgg_echo("Failed to connect to MySQL: " . mysqli_connect_error()));
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$count = 0;
$date = date('Y-m-d');

// Deactivating User whose ID is expiring today
$result = mysqli_query($con,"SELECT * from userlist where expiry_date = '$date'");
while($row = mysqli_fetch_array($result)) {
$name = $row['name'];
$username = $row['username'];
$count++;

$cmdr = file_get_contents($linux_server."delete.php?username=$username");

mysqli_query($con,"UPDATE userlist SET status='Deactivated', password='nullnull', expiry_date='0000-00-00' WHERE username = '$username'");

$to = get_user_by_username ($username)->email;
$subject = "Campus Karma : Linux User Deletion Notification";
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
<h1>Greetings from Campus Lab!</h1>Dear $name<br><br>
Thank you for choosing Campus Karma Linux lab, hope you had a lovely time using our services. We would like to inform you that your Linux subscription has expire today.<br><br>As you were not able to extend your Linux subscription, this has lead to deletion of all the files from your home directory along with your user account. Your files cannot not be restored if you reactivate your account now. Sorry for the any inconvenience caused.
<br><br><br>Thanks & Regards, <br><b>Team Campus Karma</b><br><br><br>
<span>
Keep yourself updated. Follow us on <a href='https://www.facebook.com/campuskarma' target='_blank'>Facebook</a>, <a href='https://twitter.com/CampusKarma' target='_blank'>Twitter</a> or <a href='https://plus.google.com/+CampuskarmaIndia/' target='_blank'>Google+</a><br>Having problems using Campus Karma? Just <a href='http://www.campuskarma.in/contact' target='_blank'>Contact Us</a>.
<br><br><br>Please don't reply to this message. We can't receive email at this address, so we won't respond.<br>Please add <a href='mailto:no-reply@campuskarma.in'>no-reply@campuskarma.in</a> to your address book to ensure delivery of our emails to your inbox<br><br>
</span>
</div>
</body>
</html>";
mail($to, $subject, $message, $headers);
echo $count. ". " . $name . " (".$username.") - ".$to."; ";
} 
mysqli_close($con);
echo "Auto Deactivated ".$count." Linux Users";
?>