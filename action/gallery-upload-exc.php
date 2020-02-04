<?php

if(isset($_POST["sbt-up"])){

    $newFileName = $_POST["filename"];
    if(empty($_POST["filename"])){
        $newFileName = "gallery";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST["filetitle"];
    $imageDesc = $_POST["filedesc"];
    $imagePrice = $_POST["fileprice"];



    function desc_check_word( $imageDesc ){
        foreach ( explode(' ', $imageDesc )  as $word) {
            if ( strlen($word) > 20 ) return true;
        }
        return false;
    }

    if(desc_check_word($imageDesc)){
        header("Location: ../gallery.php?desc=big");
        exit();
    } else{







    $file = $_FILES["file"];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 5000000){
                $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "../img/gallery/" . $imageFullName;

                include_once "dbconn.php";

                if(empty($imageTitle) || empty($imageDesc) || empty($imagePrice)){
                    header("Location: ../gallery.php?upload=empty");
                    exit();
                }elseif(!preg_match('/^[0-9]+(\\.[0-9]+)?$/', $imagePrice)){

                    header("Location: ../gallery.php?upload=pricebad");
                    exit();

                } else{
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed!";
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;

                        $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery, priceGallery) VALUES (?, ?, ?, ?, ?);";
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL statement failed!";
                        } else {
                            mysqli_stmt_bind_param($stmt, "ssssd", $imageTitle, $imageDesc, $imageFullName, $setImageOrder, $imagePrice);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);

                            header("Location: ../gallery.php?upload=success");
                        }
                    }
                }
            } else{
                header("Location: ../gallery.php?upload=bigimg");
                exit();
            }
        } else{
            header("Location: ../gallery.php?upload=uploaderror");
            exit();
        }
    } else{
        header("Location: ../gallery.php?upload=wrongtype");
        exit();
    }








}






}