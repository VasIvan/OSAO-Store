    <?php require "header.php"; ?>

    <main>


    <?php

        if(isset($_SESSION["idUser"])){
            echo '<section class="container container-responsive p-3 mb-5"><h1>Welcome, <span class="text-info text-capitalize font-weight-bold">' . $_SESSION["nameUser"] . '</span>!<br>You are now logged in!</h1></section>';        
        }
        else{
            echo '<section class="container container-responsive p-3 mb-5">
            <h1>Please, log in!</h1>
            <form action="action/login-exc.php" method="post" id="form-log" class="form-inline">
            <input id="log-mail" name="email" type="text" class="form-control" placeholder="Email/Username">
            <input id="log-pass" name="pwd" type="password" class="form-control" placeholder="Password">
            <button id="log-pass" type="submit" name="login-submit" class="btn btn-info">Submit</button>
            </form>
            <a href="registr.php" class="text-dark font-weight-bold">Registration</a> /
            <a href="reset-password.php" class="text-dark font-weight-bold">Forgotten password?</a>';
            
            if(isset($_GET["newpwd"])){
                if($_GET["newpwd"] == "passwordupdated"){
                    echo '<div class="alert alert-success mt-2" role="alert">
                            Your password has been updated!
                        </div>';
                }
            } elseif(isset($_GET["error"])){
                if($_GET["error"] == "emptyfields"){
                  echo '<div class="alert alert-danger mt-2" role="alert">
                          All the fields are required!
                        </div>';
                }
                elseif($_GET["error"] == "sqlerror"){
                  echo '<div class="alert alert-danger mt-2" role="alert">
                          SQL error!
                        </div>';
                }
                elseif($_GET["error"] == "wrongpassword"){
                  echo '<div class="alert alert-danger mt-2" role="alert">
                          Wrong password!
                        </div>';
                }
                elseif($_GET["error"] == "nouser"){
                  echo '<div class="alert alert-danger mt-2" role="alert">
                          No such a user exists!
                        </div>';
                }
              
              }

            echo '</section>';
        }

    ?>


    </main>
    <?php require "footer.php"; ?>