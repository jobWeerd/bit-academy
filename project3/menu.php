<?php

$autRol = isset($_SESSION['rol']) ? strtolower($_SESSION['rol']) : '';
$inlognaam = isset($_SESSION['inlognaam']) ? strtolower($_SESSION['inlognaam']) : '';


$menu = '';


switch ($autRol) {
    case 'beheerder':
        $menu = '<nav class="navbar navbar-expand-md bg-info navbar-dark">
        <a class="navbar-brand" href="kassa.php"></i>&nbsp;&nbsp;Kassa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="kassa.php"><i class="fas fa-mobile-alt mr-2"></i>Producten</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="voorraad.php"><i class="fas fa-box mr-2"></i>Voorraad</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="uitchecken.php"><i class="fas fa-money-check-alt mr-2"></i>Uitchecken</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="admin.php"><i class="fas fa-lock mr-2"></i>admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="uitloggen.php"><i class="fas fa-solid fa-door-open"></i> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="winkelmand.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
            </li>
          </ul>
        </div>
      </nav>';
        break;
    case 'administratie' :
        $menu = '<nav class="navbar navbar-expand-md bg-info navbar-dark">
        <a class="navbar-brand" href="kassa.php"></i>&nbsp;&nbsp;Kassa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="kassa.php"><i class="fas fa-mobile-alt mr-2"></i>Producten</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Uitchecken</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="admin.php"><i class="fas fa-lock mr-2"></i>admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="uitloggen.php"><i class="fas fa-solid fa-door-open"></i> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="winkelmand.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
            </li>
          </ul>
        </div>
      </nav>';
        break;
    case 'magazijnchef' :
        $menu = '<nav class="navbar navbar-expand-md bg-info navbar-dark">
        <a class="navbar-brand" href="kassa.php"></i>&nbsp;&nbsp;Kassa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="kassa.php"><i class="fas fa-mobile-alt mr-2"></i>Producten</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="voorraad.php"><i class="fas fa-box mr-2"></i>Voorraad</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="uitloggen.php"><i class="fas fa-solid fa-door-open"></i> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="winkelmand.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
            </li>
          </ul>
        </div>
      </nav>';
        break;
    case 'klant' :
        $menu = '<nav class="navbar navbar-expand-md bg-info navbar-dark">
        <a class="navbar-brand" href="kassa.php"></i>&nbsp;&nbsp;Kassa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="kassa.php"><i class="fas fa-mobile-alt mr-2"></i>Producten</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Uitchecken</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="uitloggen.php"><i class="fas fa-solid fa-door-open"></i> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="winkelmand.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
            </li>
          </ul>
        </div>
      </nav>';
        break;
    default :
        $menu = '
        <nav class="navbar navbar-expand-md bg-info navbar-dark">
        <a class="navbar-brand" href="kassa.php"></i>&nbsp;&nbsp;Kassa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="fas fa-solid fa-user"></i> <span id="login"</span>log in</a>
        </li>
        </ul>
        </div>
        </nav>';
}

echo $menu;
?>