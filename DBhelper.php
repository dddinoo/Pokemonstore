<?php
Class DBhelper
{
  private $servername = 'localhost';
  private $port = 3306;
  private $username = 'root';
  private $password = 'mysql';
  private $dbName= 'pokemon';
  public function __construct()
  {
    try
    {
      $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbName", $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
  }

  function Catalog()
  {
    $x_pag = 10;

    if (isset($_GET['pag']))
    {
        $pag = $_GET['pag'];
    }
    else
    {
       $pag  = 1;
    }

    if (!$pag || !is_numeric($pag)){
        $pag = 1;
    }

    $sql = "SELECT count(*) FROM pokemon";
    $result = $this->conn->prepare($sql);
    $result->execute();
    $all_rows = $result->fetchColumn();
    $all_pages = ceil($all_rows / $x_pag);
    $first = ($pag-1) * $x_pag;

    $printsql = "SELECT * FROM pokemon LIMIT $first, $x_pag";
    $sth = $this->conn->prepare($printsql);
    $sth->execute();


    echo "<table class='table table-striped table-dark' style='color:black'>
    <thead>
      <tr>
        <th scope='col'>Immagine</th>
        <th scope='col'>Nome</th>
        <th scope='col'>Altezza</th>
        <th scope='col'>Peso</th>
      </tr>
      </thead>
      <tbody>";

      while($row = $sth->fetch(PDO::FETCH_ASSOC))
      {
          echo "<tr>";
          echo "<td>";
          echo "<img src='sprites/" . $row['id'] . ".png " . "'>";
          echo "</td>";
          echo"<td>".$row['identifier']."</td>";
          echo "<td>".$row['height']."</td>";
          echo "<td>".$row['weight']. "</td>";
          echo "</tr>";
      }

      echo "</tbody> </table>";
echo "<nav>
      <ul class='pagination'>";
    if ($all_pages > 1){
        if ($pag > 1){

            echo "<li class='page-item'><a class='page-link' href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag - 1) . "\"> ";
            echo "<<</a>&nbsp; </li>";
        }

        if ($p = $pag){
            echo "<li class='page-item'><a class='page-link' href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . $p . "\">";
            echo $p ."</a> </li>";
        }
        echo "<br>";
        for ($p=$pag+1; $p<$pag+5; $p++) {
            echo "<li class='page-item'> <a class='page-link' href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . $p . "\">";
            echo $p . "</a>&nbsp; </li>";
        }
        if ($all_pages > $pag){
            echo "<li class='page-item'><a class='page-link' href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($pag + 1) . "\">";
            echo ">></a> </li>";
        }
    }
    echo "</ul>
          </nav>";
  }


  function Register($username, $password, $email)
  {
        $queryclienti = "INSERT INTO clienti (username, password, email) VALUES (:username, :password, :email)";
        $sqlclienti = $this->conn->prepare($queryclienti);
        $sqlclienti->execute(array(':username'=>$username, ':password'=>$password, ':email'=>$email));
        echo "Connessione avvenuta";
  }

  function login($username, $password)
  {
       $query="SELECT * FROM clienti WHERE username = :username AND password = :password";
       $result = $this->conn->prepare($query);
       $result->execute(array(':username'=>$username, ':password'=>$password));
       $conta = $result->rowCount();
       if($conta == 0)
       {
          echo "Error";
       }
       else{
         echo "Login eseguito";
       }
  }
  function Cerca($identi){


    $x_pag = 10;

    if (isset($_GET['pag']))
    {
        $pag = $_GET['pag'];
    }
    else
    {
       $pag  = 1;
    }

    if (!$pag || !is_numeric($pag)){
        $pag = 1;
    }

    $sql = "SELECT count(*) FROM pokemon";
    $result = $this->conn->prepare($sql);
    $result->execute();
    $all_rows = $result->fetchColumn();
    $all_pages = ceil($all_rows / $x_pag);
    $first = ($pag-1) * $x_pag;

    $sql="select * from pokemon where identifier LIKE '%$identi%'";
    $sth=$this->conn->prepare($sql);
    $sth->execute(array(':identi'=>$identi));


    echo "<table class='table table-striped table-dark' style='color:black'>
    <thead>
      <tr>
        <th scope='col'>Immagine</th>
        <th scope='col'>Nome</th>
        <th scope='col'>Altezza</th>
        <th scope='col'>Peso</th>
      </tr>
      </thead>
      <tbody>";

      while($row = $sth->fetch(PDO::FETCH_ASSOC))
      {
          echo "<tr>";
          echo "<td>";
          echo "<img src='sprites/" . $row['id'] . ".png " . "'>";
          echo "</td>";
          echo"<td>".$row['identifier']."</td>";
          echo "<td>".$row['height']."</td>";
          echo "<td>".$row['weight']. "</td>";
          echo "</tr>";
      }

      echo "</tbody> </table>";
}
}
?>
