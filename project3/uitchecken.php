<?php
	require 'database.php';

	$grand_total = 0;
	$allItems = '';
	$items = [];
  $sql = mysqli_query($dbconn, "SELECT * FROM `winkelmand`");
	$price_total = 0;
   if(mysqli_num_rows($sql) > 0){
      while($product_item = mysqli_fetch_assoc($sql)){
         $product_name[] = $product_item['artikelnaam'] .' ('. $product_item['hoeveel'] .') ';
         $product_price = number_format($product_item['prijs'] * $product_item['hoeveel'],2);
         $price_total += $product_price;
      };
   };
	$allItems = implode(', ', $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <?php
  session_start();
  include ('menu.php');
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Maak je bestelling compleet!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Producten : </b><?= $allItems; ?></h6>
          <h5><b>Totaal betalen : </b><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?= number_format($price_total,2) ?></h5>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>