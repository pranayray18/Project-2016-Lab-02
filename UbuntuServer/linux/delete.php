<?php
$username = $_GET['username'];

include('Net/SSH2.php');

$ssh = new Net_SSH2('103.250.83.144:22');
if(!$ssh->login('root', 'b3g783')) {
    echo $ssh->getLastError();
    die("Login failed");
}
$ssh->getServerPublicHostKey();

$cmd = "pkill -KILL -u " . $username;
$cmdr1 = $ssh->exec($cmd);
$cmd = "sudo userdel " . $username;
$cmdr1 = $ssh->exec($cmd);
$cmd = "sudo rm -rf /home/". $username;
$cmdr2 = $ssh->exec($cmd);
echo $cmdr1."|".$cmdr2;
?>