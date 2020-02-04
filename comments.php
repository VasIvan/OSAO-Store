<?php require "header.php"; ?>

<main>

<?php 
if(isset($_SESSION["nameUser"])){
?>

<section id="container-responsive-comment" class="container container-responsive p-3 mb-5">
<form action="action/comments-exc.php" method="post">

    <input name="uname" type="text" class="form-control-plaintext mb-2 font-weight-bold text-uppercase" value="<?php echo $_SESSION["nameUser"];?>" readonly>

    <textarea name="cmt" class="form-control mb-3" rows="4" placeholder="Comment...Max. 400 letters" maxlength="400"></textarea>
 


  <button name="comment-submit" type="submit" class="btn btn-info mb-5">Send</button>
</form>

<?php 
if(isset($_GET["error"])){
    if($_GET["error"] == "emptyfields"){
      echo '<div class="alert alert-danger" role="alert">
              Do not leave empty fields!
            </div>';
    }
    elseif($_GET["error"] == "sqlerror"){
      echo '<div class="alert alert-danger" role="alert">
              SQL error!
            </div>';
    } 
  }
  elseif(isset($_GET["comment"])){
  if($_GET["comment"] == "success"){
    echo '<div class="alert alert-success" role="alert">
            Comment successfully sent!
          </div>';
  }
  }
?>

<h3>Comments:</h3>

<div id="comments">

    <?php 

    require "action/dbconn.php";
    
    $sql = "SELECT * FROM comments ORDER BY id DESC LIMIT 5;";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);


    if($numRows > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<p class='bg-blue'>";
            echo '<b>' . $row["username"] . ':</b><br>';
            echo '<i>' . $row["comment"] . '</i>';
            echo "</p>";
        }
        
    }else{
        echo "<p> 0 comments!</p>";
    }
    
    ?>

    

</div>

<button id="load-btn" type="button" class="btn btn-info btn-lg btn-block mb-5">Show more comments</button>

</section>

<?php
}else{
    echo "You are not logged in!";
}
?>

</main>

<script type="text/javascript">

$(document).ready(function() {
    var commentCount = 5;
    $("#load-btn").click(function(){
        commentCount = commentCount + 5;
        $("#comments").load("action/load-comments-exc.php", {
            commentCountNew: commentCount
        });
    });
});

</script>



<?php require "footer.php"; ?>