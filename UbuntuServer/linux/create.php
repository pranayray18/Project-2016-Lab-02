<?php
$password = $_GET['password'];
$username = $_GET['username'];
$salt = $_GET['salt'];

include('Net/SSH2.php');

$ssh = new Net_SSH2('campuskarma.cloudapp.net:22');
$ssh->login('team.ck', 'qmwneb@123') or die("Login failed");
$ssh->getServerPublicHostKey();
$cmd = "sudo useradd -m -p $(mkpasswd -m sha-512 $password $salt) $username";
$cmdr = $ssh->exec($cmd);
echo ($cmdr);

?>
