<div class="elgg-head clearfix">
	<h2 class="elgg-heading-main">Linux Lab for Windows User</h2>
</div>
<?php
error_reporting(E_ALL);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);

require_once('actions/linux/config.php');
require_once 'functions.inc';

//Connecting to database
$con = mysqli_connect($lab_host, $lab_user, $lab_pass, $lab_db);
if (!$con) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

//for now the username and password is manually input, otherwise
//$username = $_SESSION['username']
$username = "";	//username for my account

if($res = user_exist_in_list($con, $username)){
	// You have to write the code for user_exist_in_list()
	// If user exist then extract the user ID and pass from 
	// database and login into the ssh screen
	
	//for now the username and password is manually input, otherwise
	//$password = $res
	$password = "";	//password for my account
	
	$ssh = log_into_ssh_screen($username, $password);
	
	// PHP SSH Screen Code goes here
	show_ssh_screen($ssh);
}else{
?>
<div id="linux-lab">
<h3>Welcome to Linux Lab</h3>
<br>
<p>With the increasing demand for Linux in our day to day college life, where we have to perform dozen of Linux program in our lab/home and our biggest nightmare is that we are a windows user.</p>
<p>We at campus karma aim to improve and help you with your daily campus life problem and that's why we are happy to inform you that we have started an online linux lab for the students of India. All those students who does not have a high end configured machine to support dual boot or cannot install virtual box for linux, they can use our online linux lab. No need to install any bulky software. You can register with us and we will provide you with your very own linux account on our server.</p>
<p>"Create My Account"</p>
<p>Hope you enjoy our service. If you have any suggestion or feedback feel free to <a href="<?php echo elgg_get_site_url()?>contact_us">Contact Us</a></p>
</div>
<?php } ?>