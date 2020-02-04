<?php

if(isset($_POST["contact-submit"])){
    $name = $_POST["user"];
    $emailFrom = $_POST["email"];
    $sbj = $_POST["subject"];
    $msg = $_POST["message"];

    if(empty($emailFrom) || empty($name) || empty($msg)){
        header("Location: ../contact-form.php?error=emptyfields");
        exit();
    } else{

    $emailTo = "vasil93iv@gmail.com";
    $headers = "From: $emailFrom";
    $txt = "You have received an e-mail from $name.\n\n$msg";

    mail($emailTo, $sbj, $txt, $headers);
    header("Location: ../contact-form.php?email=success");
    }
}