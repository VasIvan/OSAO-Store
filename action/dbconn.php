<?php

$servername = "localhost";
$DBusername = "vasivan";
$DBpassword = "090893JrMo";
$DBname = "vasivan";

$conn = mysqli_connect($servername, $DBusername, $DBpassword, $DBname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}