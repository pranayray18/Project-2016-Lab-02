<?php
include('Net/SSH2.php');
include('File/ANSI.php');

define('NET_SSH2_LOGGING', NET_SSH2_LOG_COMPLEX);

function user_exist_in_list($con, $uname){
	//for now the username is manually input, otherwise
	//$username = $uname
	$username = "shvn"; //using this value as this is stored in my db
	
	$sql = "SELECT password from userlist where username = '$username'";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) == 0){
		return FALSE;
	}
	$row = mysqli_fetch_assoc($result);
	$pswd = $row["password"];
	
	mysqli_free_result($result);
	mysqli_close($con);
	
	return $pswd;
}
function log_into_ssh_screen($username, $password){
	$ssh = new Net_SSH2('103.250.83.144', 22);
	echo '<p>Loging you in...</p>';
	if(!$ssh->login($username, $password)) {
		echo $ssh->getLastError();
		//print_r($ssh->getErrors());
		exit('Login failed.');
	} 
	else {
		echo '<p><b>Login successful.<b></p>';
	}
	//$key = $ssh->getServerPublicHostKey();
	return $ssh;
}
function show_ssh_screen($ssh){	
	$ansi = new File_ANSI();
	
	$ssh->setTimeout(3);
	$ansi->appendString($ssh->read('username@username:~$'));
	
	$ssh->write("whoami\n");
	
	$ssh->setTimeout(3);
	$ansi->appendString($ssh->read());
	
	echo $ansi->getScreen();
	
	//echo $ssh->getLog();
}
function echo_pre($mixed = null) {
	echo '<pre>';
	echo $mixed;
	echo '</pre>';
	return null;
}