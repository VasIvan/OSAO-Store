<?php require "header.php"; ?>


<section class="container">

<?php
if(isset($_GET["error"])){
  if($_GET["error"] == "emptyfields"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            All the fields(except /Extra information/) are required!
          </div>';
  }
  elseif($_GET["error"] == "sqlerror"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            SQL error!
          </div>';
  }

}
elseif(isset($_GET["order"])){
if($_GET["order"] == "success"){
  echo '<div class="alert alert-success mt-5" role="alert">
          Food order successful!
        </div>';
}
}
elseif(isset($_GET["desc"])){
  if($_GET["desc"] == "big"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            Hello Admin! You cannot use words longer than 20 characters, make sure you do not use long words!
          </div>';
  }
  }
elseif(isset($_GET["upload"])){
  if($_GET["upload"] == "empty"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            Hello Admin! All the fields are required!
          </div>';
  }
  elseif($_GET["upload"] == "pricebad"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            Hello Admin! Problem with the price input. The price should be as the example <b>00.00</b> anything athor is not accepted!
          </div>';
  }
  elseif($_GET["upload"] == "bigimg"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            Hello Admin! This file is too big, it should be less than 5mb!
          </div>';
  }  
  elseif($_GET["upload"] == "uploaderror"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            Hello Admin! Error, something went wrong with the upload!
          </div>';
  }
  elseif($_GET["upload"] == "wrongtype"){
    echo '<div class="alert alert-danger mt-5" role="alert">
            Hello Admin! You need to upload a proper file type! <b>JPG, jpg, PNG, png ONLY!</b>
          </div>';
  }
  elseif($_GET["upload"] == "success"){
    echo '<div class="alert alert-success mt-5" role="alert">
            Your advert was successfully uploaded!
          </div>';
  }
}
?>

    <div>

          <div class="container my-5">
              <div class="row cover-border">
               <img class="glr-header" src="img/shop-clr.png" onmouseover="this.src='img/shop-black.png'" onmouseout="this.src='img/shop-clr.png'" alt="...">
              </div>
          </div>

        <div class="gallery-container">
        
        <?php

        include_once "./action/dbconn.php";

        if(isset($_SESSION["idUser"])){
          $uname = $_SESSION["nameUser"];
          $uaddress = $_SESSION["addressUser"];
          $uphone = $_SESSION["phoneUser"];
        } else{
          $uname = "";
          $uaddress = "";
          $uphone = "";
        }


        $sql = "SELECT * FROM gallery ORDER BY idGallery DESC";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL statement failed!";
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)){

                echo
'<div class="container" id="product' . $row["idGallery"] . '">
<div class="row mb-5">
  <div class="col-12 col-lg-6 img-bg">
    <div class="img-box">
      <img class="img-zoom" src="img/gallery/' . $row["imgFullNameGallery"] . '" alt="...">
    </div>
  </div>
  <div class="col-12 col-lg-6 txt-bg">
    <h2 class="card-title"><b>' . $row["titleGallery"] . '</b></h2>
<h5 id="idGlr" class="card-title" value="' . $row["idGallery"] . '"></h5>
<p class="card-text">' . $row["descGallery"] . '</p>
<h5 class="card-text">' . $row["priceGallery"] . '€</h5>
<button id="btn-tgl' . $row["idGallery"] . '" type="button" class="btn btn-info mr-3 mb-3 btn-ord" style="display: none;"><i class="material-icons">shopping_cart</i> Order</button>';

if(isset($_SESSION["idUser"])){
if( $_SESSION["idUser"] == $_SESSION["adminNumber"]){
   
  echo        '<button onclick="deleteAdmin(' . $row["idGallery"] . ')" type="button" class="btn btn-danger mb-3"><i class="material-icons">delete</i> Delete</button>';
  }
}


echo
'</div></div>

<!-- ORDER FORM -->
  <div class="row justify-content-center" id="tgl' . $row["idGallery"] . '" style="display: none;">
  <div class="col-12 col-lg-6 col-ord">


  <form action="action/order-exc.php" method="post">

    <input name="uname" type="text" class="form-control-plaintext admin-input username-ord" value="'. $uname .'" readonly>
    <input name="uaddress" type="text" class="form-control admin-input" value="'. $uaddress .'">
    <input name="uphone" type="text" class="form-control admin-input" value="'. $uphone .'">
    <input name="orderTitle" type="hidden" class="form-control" value="'. $row["titleGallery"] .'">
    <input name="orderPrice" type="hidden" class="form-control" value="'. $row["priceGallery"] .'">
    <input class="form-control admin-input" type="number" name="quantity" value="1" min="1" max="10">
    <div class="form-check admin-input">
      <input class="form-check-input" type="radio" name="delivery" id="delivery1' . $row["idGallery"] . '" value="yes">
      <label class="form-check-label" for="delivery1' . $row["idGallery"] . '">
        Home delivery (+ 5.00€)
      </label>
    </div>
    <div class="form-check admin-input">
      <input class="form-check-input" type="radio" name="delivery" id="delivery2' . $row["idGallery"] . '" value="no" checked>
      <label class="form-check-label" for="delivery2' . $row["idGallery"] . '">
        Pick up (+ 0.00€)
      </label>
    </div>
    <textarea name="orderAdd" class="form-control admin-input" placeholder="Extra information..." rows="4"></textarea>
 


  <button name="order-submit" type="submit" class="btn btn-info btn-block admin-input">Buy</button>
</form>
  
  
  
  </div>
  </div>

</div>

</div>
<script> 
$(document).ready(function(){
  $("#btn-tgl' . $row["idGallery"] . '").click(function(){
    $("#tgl' . $row["idGallery"] . '").slideToggle("slow");
  });
});
</script>
';



            }
        }

        ?>

        </div>

<?php
if(isset($_SESSION["idUser"])){

  echo'<script>
  $(document).ready(function(){
    $(".btn-ord").show();
  });
  </script>';

  if( $_SESSION["idUser"] == $_SESSION["adminNumber"]){
   
    echo        '<div class="gallery-upload mb-5">
    <form action="action/gallery-upload-exc.php" method="post" enctype="multipart/form-data">

    <div class="row">
    <div class="col-12 col-lg-6">
        <input type="text" name="filename" class="form-control admin-input" placeholder="File name...">
        <input type="text" name="filetitle" class="form-control admin-input" placeholder="Image title...Max. 30 letters" maxlength="30">
        <input type="text" name="filedesc" class="form-control admin-input" placeholder="Image description...Max. 400 letters" maxlength="400">
    </div>
        
    <div class="col-12 col-lg-6">
        <input id="choose-file" type="file" name="file" class="form-control-file">
        <input type="text" name="fileprice" class="form-control admin-input" placeholder="Price... ex: 33.95">
        <button type="submit" name="sbt-up" class="btn btn-info btn-block admin-input">Upload</button>
    </div>
    </div>

    </form>
</div>';
  }
}

?>

    </div>
</section>

<script type="text/javascript">

function deleteAdmin(id){
    if(confirm("Are you sure?")){
        $.ajax({
            type: 'post',
            url: 'action/deleteProduct-exc.php',
            data:{
                delete_id:id,    
            },
            success:function(data){
                $("#product"+id).hide();
            }

        });
    }
}

</script>

<?php require "footer.php"; ?>

