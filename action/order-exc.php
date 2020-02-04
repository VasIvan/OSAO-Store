<?php
if (isset($_POST["order-submit"])){

    require "dbconn.php";

    $uname=$_POST["uname"];
    $uaddress=$_POST["uaddress"];
    $uphone=$_POST["uphone"];
    $orderTitle=$_POST["orderTitle"];
    $orderPrice=$_POST["orderPrice"];
    $quantity=$_POST["quantity"];
    $delivery=$_POST["delivery"];
    $orderAdd=$_POST["orderAdd"];

    if(empty($uname) || empty($uaddress) || empty($uphone) || empty($orderTitle) || empty($orderPrice) || empty($quantity) || empty($delivery)){
        header("Location: ../gallery.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "INSERT INTO orders (userOrd, nameOrd, quantityOrd, priceOrd, deliveryOrd, phoneOrd, addressOrd, extrasOrd)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../gallery.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssidssss", $uname, $orderTitle, $quantity, $orderPrice, $delivery, $uphone, $uaddress, $orderAdd);
            mysqli_stmt_execute($stmt);
            header("Location: ../gallery.php?order=success");
            exit();
                }
            }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else{
    header("Location: ../gallery.php");
    exit();
}