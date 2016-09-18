<?php
require_once('../../start.php');
require_once(dirname(__FILE__) . '/config.php');

$cmdr = file_get_contents($linux_server . "loadshell.php");
echo $cmdr;
?>

