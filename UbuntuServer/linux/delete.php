<?php
$username = $_GET['username'];

include('Net/SSH2.php');

// Connect to SSH & Delete User
$ssh = new Net_SSH2('campuskarma.cloudapp.net:22');
$ssh->login('team.ck', 'qmwneb@123') or die("Login failed");
$ssh->getServerPublicHostKey();

$cmd = "pkill -KILL -u " . $username;
$cmdr1 = $ssh->exec($cmd);
$cmd = "sudo userdel " . $username;
$cmdr1 = $ssh->exec($cmd);
$cmd = "sudo rm -rf /home/". $username;
$cmdr2 = $ssh->exec($cmd);
echo $cmdr1."|".$cmdr2;
?>