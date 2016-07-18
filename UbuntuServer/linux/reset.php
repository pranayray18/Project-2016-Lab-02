<?php
include('Net/SSH2.php');

$ssh = new Net_SSH2('campuskarma.cloudapp.net:22');
$ssh->login('team.ck', 'qmwneb@123') or die("Login failed");
$ssh->getServerPublicHostKey();
$cmd = "echo -e '$password\n$password\n' | sudo passwd $username";
$cmdr = $ssh->exec($cmd);

?>