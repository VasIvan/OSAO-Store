<?php
/*In order to run this project to your own server you should change the following variables and create in your databse tables accordingly !!!*/
$servername = "localhost";
$DBusername = ""; /*Username must be added here(ex. Root)*/
$DBpassword = ""; /*password must be added here*/
$DBname = "";/*database name here*/

$conn = mysqli_connect($servername, $DBusername, $DBpassword, $DBname);

if (!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
