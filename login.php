<html>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="mycss.css">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body class="log">
  <ul class="nav">
    <li><a href="index.html">Home</a></li>
    <li><a href="registrati.html">Registrati</a></li>
    <li><a href="login.html">Login</a></li>
    <li><a href="catalogo.php">Catalogo</a></li>
    <form method="post" action="Cerca.php" class="form-inline">
      <input class="form-control mr-sm-2" name="identifier" type="search" placeholder="Cerca" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </ul>
<?php

  $username = $_POST['username'];
  $password = $_POST['password'];


    require_once('DBhelper.php');
    $db_login = new DBhelper();
    $db_login->Login($username, $password);

?>
</body>
</html>
