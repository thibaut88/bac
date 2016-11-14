<?php
session_start();
session_unset();
session_destroy();
$location=str_replace('logout.php','',$_SERVER['SCRIPT_NAME']).'../index.php';
header("Location:$location");
