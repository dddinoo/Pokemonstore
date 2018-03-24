<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="mycss.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   </head>

<body class = "cat">

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
<div class="container">
  <?php

      include('DBhelper.php');
      $db_handle = new DBhelper();
      $db_handle->Catalog();
 ?>

</div>
</body>
</html>
