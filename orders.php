<?php require "header.php"; ?>

<main>

<?php

require "action/dbconn.php";

if(isset($_SESSION["idUser"])){

  if( $_SESSION["idUser"] == $_SESSION["adminNumber"]){ 

    $sql = "SELECT * FROM orders ORDER BY idOrd DESC LIMIT 5;";
    $result = mysqli_query($conn, $sql);


    if(mysqli_num_rows($result) > 0){
      echo '<section class="container table-margin-100"><table class="table table-responsive table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">Username</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Product</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price per piece</th>
          <th scope="col">Delivery</th>
          <th scope="col">Extras</th>
          <th scope="col">Total Price</th>
        </tr>
      </thead>
      <tbody id="load-ord-admin">';

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
        echo '</tbody>
        </table>
        <button id="load-btn-orders-admin" type="button" class="btn btn-dark btn-lg btn-block mb-5">Show more orders</button>
        </container>';

    }else{
        echo '<section class="container container-responsive p-3 mb-5"><h1> 0 orders!</h1></section>';
    }


  }else{
    $username = $_SESSION["nameUser"];
    $sql = "SELECT * FROM orders WHERE userOrd='$username' ORDER BY idOrd DESC LIMIT 5;";
    $result = mysqli_query($conn, $sql);


    if(mysqli_num_rows($result) > 0){
      echo '<section class="container table-margin-100"><table class="table table-responsive table-striped table-dark">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Date</th>
          <th scope="col">Username</th>
          <th scope="col">Phone</th>
          <th scope="col">Address</th>
          <th scope="col">Product</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price per piece</th>
          <th scope="col">Delivery</th>
          <th scope="col">Extras</th>
          <th scope="col">Total Price</th>
        </tr>
      </thead>
      <tbody id="load-ord-user">';

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
        echo '</tbody>
        </table>
        <button id="load-btn-orders-user" type="button" class="btn btn-dark btn-lg btn-block mb-5">Show more orders</button>
        </container>';

    }else{
        echo '<section class="container container-responsive p-3 mb-5"><h1>(0 orders) You have not ordered anything!</h1></section>';
    }
  }
} else{
  echo '<section class="container container-responsive p-3 mb-5"><h1>Please, <a class="btn btn-info" href="index.php">log in</a>!</h1></section>';
}

?>

</main>

<script type="text/javascript">

$(document).ready(function() {
    var ordersCount = 5;
    $("#load-btn-orders-admin").click(function(){
        ordersCount = ordersCount + 5;
        $("#load-ord-admin").load("action/load-order-admin-exc.php", {
            ordersCountNew: ordersCount
        });
    });
});

$(document).ready(function() {
    var ordersCount = 5;
    $("#load-btn-orders-user").click(function(){
        ordersCount = ordersCount + 5;
        $("#load-ord-user").load("action/load-order-user-exc.php", {
            ordersCountNew: ordersCount
        });
    });
});

</script>

<?php require "footer.php"; ?>