<?php require "header.php"; ?>

<main>

<section class="container container-responsive p-3 mb-5">
<?php
$selector = $_GET["selector"];
$validator = $_GET["validator"];

if(empty($selector) || empty($validator)){
    echo "Could not validate your request!";
}
else{
    if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
        ?>

        <form action="action/reset-password-exc.php" method="post" class="form-inline">
            <input type="hidden" name="selector" value="<?php echo $selector; ?>">
            <input type="hidden" name="validator" value="<?php echo $validator; ?>">
            <input type="password" name="pwd" class="form-control mb-2 mr-2" placeholder="New password...">
            <input type="password" name="pwd-repeat" class="form-control mb-2 mr-2" placeholder="Reapeat password...">
            <button type="submit" name="reset-pwd-submit" class="btn btn-info mb-2">Reset password</button>
        </form>

<?php
    }
}



if(isset($_GET["newpwd"])){
  if($_GET["newpwd"] == "empty"){
    echo '<div class="alert alert-danger" role="alert">
            Both fields are required!
          </div>';
  }
  elseif($_GET["newpwd"] == "pwdnotsame"){
    echo '<div class="alert alert-danger" role="alert">
            Passwords do not match!
          </div>';
  }

}
?>
</section>

</main>
<?php require "footer.php"; ?>