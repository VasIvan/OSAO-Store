    <?php require "header.php"; ?>

<main>

<section class="container container-responsive p-3">
<h1>Reset your password</h1>
<p><i class="px-1">An e-mail will be send to you with instructions on how to reset your password.</i></p>
<form action="action/reset-request-exc.php" method="post" class="form-inline">
<input id="mail-rst" type="text" name="email" class="form-control mr-2 mb-2" placeholder="Enter your e-mail...">
<button type="submit" name="reset-request-submit" class="btn btn-info">Reset</button>
</form>

<?php

if(isset($_GET["reset"])){
    if($_GET["reset"] == "success"){
        echo '<div class="alert alert-success mt-2" role="alert">
                Check your e-mail!
            </div>';
    }
}

?>
</section>

</main>
<?php require "footer.php"; ?>

