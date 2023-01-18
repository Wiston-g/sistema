<?php 
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../index.php");
  }else{
    if($_SESSION['user']=="ok"){
      $nameUser = $_SESSION["nameUser"];
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Material icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>

    <?php $url = "http://".$_SERVER['HTTP_HOST']."/SystemOrder" ?>  
    
    <nav class="navbar navbar-expand justify-content-end navbar-light bg-danger text-light">
        <h1 class="justify-content-start">SYSTEM ORDER FULLFILLMENT</h1>
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#"><?php echo $nameUser;?>
              <img src="../../img/user.png" alt="icon-user">
            </a>
            
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrator/section/close.php">
              <img src="../../img/logout.png" alt="logout">
            </a>
            <div>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrator/section/products.php">Usuarios</a>
            </div>

        </div>
    </nav>

        <div class="container">
            <div class="row">