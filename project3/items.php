<?php
	session_start();
	require 'database.php';
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice;

	  $stmt = $dbconn->prepare('SELECT code FROM winkelmand WHERE code=?');
	  $stmt->bind_param('s',$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['code'] ?? '';

	  if (!$code) {
	    $query = $dbconn->prepare('INSERT INTO winkelmand (artikelnaam,prijs,foto,hoeveel,total_price,code) VALUES (?,?,?,?,?,?)');
	    $query->bind_param('ssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Product toegevoegd!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Artikel al toegevoegd aan uw winkelwagen</strong>
						</div>';
	  }
	}
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $dbconn->prepare('SELECT * FROM winkelmand');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $dbconn->prepare('DELETE FROM winkelmand WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Artikel verwijderd uit winkelwagen!';
	  header('location:winkelmand.php');
	}
	if (isset($_GET['clear'])) {
	  $stmt = $dbconn->prepare('DELETE FROM winkelmand');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:winkelmand.php');
	}
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;
	  $stmt = $dbconn->prepare('UPDATE winkelmand SET hoeveel=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $phone = $_POST['phone'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $address = $_POST['address'];
	  $pmode = $_POST['pmode'];

	  $data = '';

	  $stmt = $dbconn->prepare('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
	  $stmt->execute();
	  $stmt2 = $dbconn->prepare('DELETE FROM winkelmand');
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Bedankt!</h1>
								<h2 class="text-success">Uw bestelling is succesvol geplaatst!</h2>
								<h4 class="bg-danger text-light rounded p-2">Gekochte artikelen : ' . $products . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
						  </div>';
	  echo $data;
	}
?>