<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the required parameters are set
  if (isset($_POST['productId'], $_POST['quantity'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    // Get the current stock quantity
    $stmt = $dbconn->prepare('SELECT voorraad FROM artikel WHERE id = ?');
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $currentStock = $row['voorraad'];

    // Check if there is sufficient stock
    if ($quantity <= $currentStock) {
      // Update the stock quantity in the database
      $newStock = $currentStock - $quantity;
      $stmt = $dbconn->prepare('UPDATE artikel SET voorraad = ? WHERE id = ?');
      $stmt->bind_param('ii', $newStock, $productId);

      if ($stmt->execute()) {
        // Stock update successful
        echo "success";
      } else {
        // Stock update failed
        echo "error";
      }
    } else {
      // Insufficient stock
      echo "insufficient";
    }
  } else {
    // Required parameters not set
    echo "missing";
  }
} else {
  // Invalid request method
  echo "invalid";
}
?>
