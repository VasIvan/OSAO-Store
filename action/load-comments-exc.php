<?php 

    require "dbconn.php";
    
    $commentsNewCount = $_POST["commentCountNew"];
    $sql = "SELECT * FROM comments ORDER BY id DESC LIMIT $commentsNewCount";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);


    if($numRows > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<p>";
            echo '<b>' . $row["username"] . '</b><br>';
            echo '<i>' . $row["comment"] . '</i>';
            echo "</p>";
        }

    }else{
        echo "<p> 0 comments!</p>";
    }
    
?>