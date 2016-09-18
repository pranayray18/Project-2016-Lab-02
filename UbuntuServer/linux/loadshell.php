<?php
include('Net/SSH2.php');

$ssh = new Net_SSH2('103.250.83.144:22');
if(!$ssh->login('root', 'b3g783')) {
    echo $ssh->getLastError();
    die("Login failed");
}
$ssh->getServerPublicHostKey();
$cmd = "shellinaboxd -t -p 443";

$cmdr = $ssh->exec($cmd);
//echo ($cmdr);

?>

