<?php include("template/header.php"); ?>
<?php include("administrator/setting/bd.php"); 
  $sentencia = $conexion->prepare("SELECT * FROM `societies`");
  $sentencia->execute();
  $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
  
?>


<div class="row row-cols-1 row-cols-md-3 g-4">
<?php foreach($usuarios as $usuario){?>

  <div class="col">
    <div class="card h-100">
      
      <div class="card-body bg-dark text-light">
        <h5 class="card-title"><?php echo $usuario['REASON']; ?></h5>
        <p class="card-text"><?php echo $usuario['NIT']; ?></p>
        <p class="card-text"><?php echo $usuario['NAME']; ?></p>
      </div>
    </div>
  </div>

<?php }?>
</div>
<?php include("template/footer.php"); ?>