<?php

$servername = "localhost";
$DBusername = "";
$DBpassword = ""; /*password must be added here*/
$DBname = "";/*database name here*/

$conn = mysqli_connect($servername, $DBusername, $DBpassword, $DBname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
