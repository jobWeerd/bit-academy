<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Winkelmand</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
  <?php
  include("menu.php");
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
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
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Producten in je winkelwagen!</h4>
                </td>
              </tr>
              <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Product</th>
                <th>Prijs</th>
                <th>hoeveelheid</th>
                <th>Totaal prijs</th>
                <th>
                  <a href="items.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Weet u zeker dat u uw winkelwagentje wilt leegmaken?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Verwijder alles</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              require 'database.php';
              $stmt = $dbconn->prepare('SELECT * FROM winkelmand');
              $stmt->execute();
              $result = $stmt->get_result();
              $grand_total = 0;
              while ($row = $result->fetch_assoc()) :

                if (isset($_POST['update_update_btn'])) {
                  $update_value = $_POST['update_quantity'];
                  $update_id = $_POST['update_quantity_id'];

                  if ($quantity_difference >= 0) {
                    $update_quantity_query = mysqli_query($dbconn, "UPDATE `winkelmand` SET `hoeveel` = '$update_value' WHERE `id` = '$update_id'");

                    if ($update_quantity_query) {
                      $update_stock_query = mysqli_query($dbconn, "UPDATE `artikel` SET `voorraad` = '$quantity_difference' WHERE `id` = '$update_id'");

                      if ($update_stock_query) {
                        header('location:winkelmand.php');
                      } else {
                        echo "Failed to update stock.";
                      }
                    } else {
                      echo "Failed to update quantity in cart.";
                    }
                  } else {
                    echo "Insufficient stock.";
                  }
                }
              ?>
                <tr>
                  <td><?= $row['id'] ?></td>
                  <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                  <td><img src="<?= $row['foto'] ?>" width="50"></td>
                  <td><?= $row['artikelnaam'] ?></td>
                  <td>
                    <i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?= number_format($row['prijs'], 2); ?>
                  </td>
                  <input type="hidden" class="pprice" value="<?= $row['prijs'] ?>">
                  <td>
                    <form action="" method="post">
                      <input type="hidden" name="update_quantity_id" value="<?php echo $row['id']; ?>">
                      <input type="number" name="update_quantity" min="1" value="<?php echo $row['hoeveel']; ?>">
                      <input onclick="addToCart(event)" type="submit" value="update" name="update_update_btn">
                    </form>
                    <td><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?php echo $sub_total = number_format($row['total_price'], 2) * $row['hoeveel']; ?></td>
                </tr>
                <?php $grand_total += $sub_total ?>
              <?php endwhile; ?>
              <tr>
                <td colspan="3">
                  <a href="kassa.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Door
                    Winkelen</a>
                </td>
                <td colspan="2"><b>Totaal</b></td>
                <td><b><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total, 2); ?></b></td>
                <td>
                  <a href="uitchecken.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Uitchecken</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script type="text/javascript">
    load_cart_item_number();

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
</body>

</html>
