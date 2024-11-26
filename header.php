<!--Used on parts where logging in has been initiated-->
<?php
session_start();
$servername = "localhost";
$server_user = "root";
$server_pass = "";
$dbname = "kptm_aduan";
$connect = new mysqli($servername, $server_user, $server_pass, $dbname);
?>