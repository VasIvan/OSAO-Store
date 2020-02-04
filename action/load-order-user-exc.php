<?php 
    session_start();
    require "dbconn.php";
    
    $ordersNewCount = $_POST["ordersCountNew"];
    $username = $_SESSION["nameUser"];
    $sql = "SELECT * FROM orders WHERE userOrd='$username' ORDER BY idOrd DESC LIMIT $ordersNewCount";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);


    if($numRows > 0){
        while($row = mysqli_fetch_assoc($result)){
            $idOrd = $row["idOrd"];
            $timeOrd = $row["timeOrd"];
            $userOrd = $row["userOrd"];
            $nameOrd = $row["nameOrd"];
            $quantityOrd = $row["quantityOrd"];
            $priceOrd = $row["priceOrd"];
            $deliveryOrd = $row["deliveryOrd"];
            $phoneOrd = $row["phoneOrd"];
            $addressOrd = $row["addressOrd"];
            $extrasOrd = $row["extrasOrd"];
  
            if($deliveryOrd == "yes"){
              $deliveryOrd = 5;
            } else{
              $deliveryOrd = 0;
            }
  
            $totalOrd = ($quantityOrd*$priceOrd)+$deliveryOrd;
  
            ?>
  
  
                    <tr>
                      <th scope="row"><?php echo $idOrd; ?></th>
                      <td><?php echo $timeOrd; ?></td>
                      <th><?php echo $userOrd; ?></th>
                      <td><?php echo $phoneOrd; ?></td>
                      <td><?php echo $addressOrd; ?></td>
                      <td><?php echo $nameOrd; ?></td>
                      <td><?php echo $quantityOrd; ?> / pcs</td>
                      <td><?php echo $priceOrd; ?> €</td>
                      <td><?php echo $deliveryOrd; ?> €</td>
                      <td><?php echo $extrasOrd; ?></td>
                      <td><?php echo $totalOrd; ?> €</td>
                    </tr>
  
          
          <?php
        }
    }else{
        echo "<p> 0 comments!</p>";
    }
    
?>


