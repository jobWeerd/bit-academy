<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>winkelmand</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <?php
  session_start();
  include ('menu.php');
  ?>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

</style>
<body>

  <div id="myUL">
  <div class="container">
  <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			include 'database.php';
  			$stmt = $dbconn->prepare('SELECT * FROM artikel');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
        <div class="card-deck">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['foto'] ?>" class="card-img-top" height="250">
            <div class="card-body p-1">
            <li><h4 class="card-title text-center text-info"><?= $row['artikelnaam'] ?></h4></li>
              <h5 class="card-text text-center text-black"></i><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?= number_format($row['prijs'],2) ?></h5>
            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                    <b>Hoeveel : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" min="0" class="form-control pqty" value="<?= $row['hoeveel'] ?>">
                  </div>
                  <img id="myimg" hidden="hidden" src="<?= $row['barcodefoto'] ?>" class="card-img-bottom">
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['artikelnaam'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['prijs'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['foto'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['code'] ?>">
                <button class="btn btn-info btn-block addItemBtn" onclick="addToCart(event)" <?php if ($row['voorraad'] == '0'){ ?>style="display: none;"<?php } ?>>
                <i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Toevoegen
                </button>
                <span <?php if ($row['voorraad'] != '0'){ ?>style="display: none;"<?php } ?>>
                  uitverkocht
              </span>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  </div>
<script>

function addToCart(event) {
  event.preventDefault();
  var $form = $(event.target).closest(".form-submit");
  var pid = $form.find(".pid").val();
  var pname = $form.find(".pname").val();
  var pprice = $form.find(".pprice").val();
  var pimage = $form.find(".pimage").val();
  var pcode = $form.find(".pcode").val();
  var pqty = $form.find(".pqty").val();
  
  if (pqty > 0) {
    $.ajax({
      url: 'items.php',
      method: 'post',
      data: {
        pid: pid,
        pname: pname,
        pprice: pprice,
        pqty: pqty,
        pimage: pimage,
        pcode: pcode,
      },
      success: function(response) {
        $("#message").html(response);
        window.scrollTo(0, 0);
        load_cart_item_number();
        updateStock(pid, pqty);
      }
    });
  } else {
    alert("Please enter a valid quantity.");
  }
}

function updateStock(productId, quantity) {
  $.ajax({
    url: 'update_stock.php',
    method: 'post',
    data: {
      productId: productId,
      quantity: quantity
    },
  });
}

function load_cart_item_number() {
  $.ajax({
    url: 'items.php',
    method: 'get',
    data: {
      cartItem: "cart_item"
    },
    success: function(response) {
      $("#cart-item").html(response);
    }
  });
}
</script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {
  load_cart_item_number();
});
</script>
</body>

</html>
