<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
        
$lab_host = "localhost";
$lab_user = "root";
$lab_pass = "";
$lab_db = "ckdb";

try {
    $dbh = new PDO("mysql:host=$lab_host;dbname=$lab_db", $lab_user, $lab_pass);
    /*** echo a message saying we have connected ***/
    //echo 'Connected to database mys';
    }
catch(PDOException $e)
    {
	echo 'could not connect';
    //echo $e->getMessage();
    }

$linux_server = "http://localhost/Project-2016-Lab-02/UbuntuServer/linux/"; // http path to linux (ubuntu) server
?>