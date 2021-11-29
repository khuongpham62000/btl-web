<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/user-page.css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js" integrity="sha256-0H3Nuz3aug3afVbUlsu12Puxva3CP4EhJtPExqs54Vg=" crossorigin="anonymous"></script>
  <script src="assets/js/field-verify.js"></script>
  <title><?= $page ?></title>
</head>

<body>
  <nav>
    <div class="nav_sidebar">
      <ul>
        <li><a href="/index.php?controller=UserProduct">Nut Milks</a></li>
        <li><a href="/index.php?controller=UserAbout">About Us</a></li>
        <li><a href="/index.php?controller=UserCart">Cart</a></li>
        <li><a href="/index.php?controller=UserProfile">User</a></li>
      </ul>
    </div>
    <ul>
      <li class="nav_menu"><span>&#9776;</span></li>
      <li><a href="/index.php?controller=UserProduct">Nut Milks</a></li>
      <li class="nav_about_us"><a href="/index.php?controller=UserAbout">About Us</a></li>
      <li class="nav_home"><a href="/index.php?controller=UserFronks">Fronks</a></li>
      <li><a href="/index.php?controller=UserCart">Cart</a></li>
      <li><a href="/index.php?controller=UserProfile">User</a></li>
    </ul>
  </nav>

  <!-- The Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <div id="modal-content"></div>
    </div>
  </div>

  <script>
    var user_id = <?= isset($_SESSION["user"]) ? $_SESSION["user"]->id : -1 ?>
  </script>

  <?= @$content ?>

  <script src="assets/js/user-page.js"></script>
</body>

</html>