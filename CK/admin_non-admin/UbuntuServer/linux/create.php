<?php
$password = $_GET['password'];
$username = $_GET['username'];
$salt = $_GET['salt'];

include('Net/SSH2.php');

$ssh = new Net_SSH2('103.250.83.144:22');
if(!$ssh->login('root', 'b3g783')) {
    echo $ssh->getLastError();
    die("Login failed");
}
$ssh->getServerPublicHostKey();

$ssh->setTimeout(1);
$cmd = "sudo useradd -m -p $(mkpasswd -m sha-512 $password $salt) $username";
$cmdr = $ssh->exec($cmd);

echo ($cmdr);
?>
