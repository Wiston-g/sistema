<?php include("../template/header.php"); ?>

<?php 
    $id =       (isset($_POST['id']))?$_POST['id']:"" ;
    $reason =   (isset($_POST['reason']))?$_POST['reason']:"" ;
    $address =   (isset($_POST['address']))?$_POST['address']:"" ;
    $name =     (isset($_POST['name']))?$_POST['name']:"" ;
    $lastName = (isset($_POST['last_name']))?$_POST['last_name']:"" ;
    $email =    (isset($_POST['email']))?$_POST['email']:"" ;
    $phone =    (isset($_POST['phone']))?$_POST['phone']:"" ;
    
    $action =   (isset($_POST['accion']))?$_POST['accion']:"" ;

    include("../setting/bd.php");

    switch ($action) {
        case 'crear':
            $sentencia = $conexion->prepare("INSERT INTO `societies` (`ID`, `REASON`, `ADDRES`, `NAMES`, `LAST_NAME`, `EMAIL`, `PHONE`) VALUES (:ID, :REASON, :ADDRES, :NAMES, :LAST_NAME, :EMAIL, :PHONE );");
            
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':REASON', $reason);
            $sentencia->bindParam(':ADDRES', $address);
            $sentencia->bindParam(':NAMES', $name);
            $sentencia->bindParam(':LAST_NAME', $lastName);
            $sentencia->bindParam(':EMAIL', $email);
            $sentencia->bindParam(':PHONE', $phone);

            $sentencia->execute();
            header("Location:products.php");
            break;
        case 'editar':
            $sentencia = $conexion->prepare("UPDATE `societies` SET `REASON`=:REASON WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':REASON', $reason);
            $sentencia->execute();

            $sentencia = $conexion->prepare("UPDATE `societies` SET `ADDRES`=:ADDRES WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':ADDRES', $reason);
            $sentencia->execute();
            
            $sentencia = $conexion->prepare("UPDATE `societies` SET `NAMES`=:NAMES WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':NAMES', $name);
            $sentencia->execute();
            
            $sentencia = $conexion->prepare("UPDATE `societies` SET `LAST_NAME`=:LAST_NAME WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':LAST_NAME', $lastName);
            $sentencia->execute();

            $sentencia = $conexion->prepare("UPDATE `societies` SET `EMAIL`=:EMAIL WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':EMAIL', $email);
            $sentencia->execute();
            
            $sentencia = $conexion->prepare("UPDATE `societies` SET `PHONE`=:PHONE WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->bindParam(':PHONE', $phone);
            $sentencia->execute();

            header("Location:products.php");
            break;
        case 'cancelar':
            header("Location:products.php");
            break;
        case 'Seleccionar':
            $sentencia = $conexion->prepare("SELECT * FROM `societies` WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->execute();
            $selectProduct = $sentencia->fetch(PDO::FETCH_LAZY);

            $id = $selectProduct['ID'];
            $reason = $selectProduct['REASON'];
            $address = $selectProduct['ADDRES'];
            $name = $selectProduct['NAMES'];
            $lastName = $selectProduct['LAST_NAME'];
            $email = $selectProduct['EMAIL'];
            $phone = $selectProduct['PHONE'];

            $ver= true;
            
            break;
        case 'Eliminar':

            $sentencia = $conexion->prepare("DELETE FROM `societies` WHERE ID=:ID");
            $sentencia->bindParam(':ID', $id);
            $sentencia->execute();
            header("Location:products.php");
            break;
        
        default:
            
            break;
    };

    $sentencia = $conexion->prepare("SELECT * FROM `societies`");
    $sentencia->execute();
    $usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>



<div class="col-12 card mt-3 ">
    <div class="card m-2">
        <h2>Maestro de sociedades</h2>
    </div>
    <div class="card m-2">
        <div class="m-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Crear
            </button>
            
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>NIT</th>
                    <th>Razon social</th>
                    <th>Direccion</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
                
                <tr>
                    <td><?php echo $usuario['ID']; ?></td>
                    <td><?php echo $usuario['REASON']; ?></td>
                    <td><?php echo $usuario['ADDRES']; ?></td>
                    <td><?php echo $usuario['NAMES']; ?></td>
                    <td><?php echo $usuario['LAST_NAME']; ?></td>
                    <td><?php echo $usuario['EMAIL']; ?></td>
                    <td><?php echo $usuario['PHONE']; ?></td>
                    
                    <td>
                        <form method="POST">
                            
                            <input type="hidden" name="id" id="id" value="<?php echo $usuario['ID']; ?>">
                            
                            <button type="submit" name="accion"  class="btn btn btn-danger" value="Eliminar"> <img src="../../img/delete.png" alt="icon-delet"></button>
                            
                            <button type="submit" name="accion"  class="btn btn btn-warning" value="Seleccionar" data-bs-toggle="modal" data-bs-target="#EditModal"> <img src="../../img/edit.png" alt="icon-edit"></button>

                            <input type="hidden" id="mostrar" class="btn btn-warning" value="<?php echo $ver ?>">
                                
                                

                        </form>
                    </td>
                </tr>

            <?php } ?>    
            </tbody>
        </table>
    </div>
</div>




<!-- Modal crear -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle de sociedad</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
        

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="reason" class="form-label">Razon social:</label>
                    <input type="text" class="form-control" id="reason" name="reason" value="<?php echo $name; ?>" placeholder="Razon social" required>
                </div>

                <div class="row">

                    <div class="col-6 mb-3">
                        <label for="id" class="form-label">NIT:</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>" placeholder="Nit" required >
                    </div>

                    <div class="col-6 mb-3">
                        <label for="address" class="form-label">Direccion:</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" placeholder="Direccion" required>
                    </div>

                </div>

                <h5>Persona de contacto</h5>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Nombre" required>
                    </div>
                    
                    <div class="col-6 mb-3">
                        <label for="last_name" class="form-label">Apellido:</label>
                        <input type="Text" class="form-control" id="last_name" name="last_name" value="<?php echo $lastName; ?>" placeholder="Apellido" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"placeholder="Correo" required>
                    </div>
                    
                    <div class="col-6 mb-3">
                        <label for="phone" class="form-label">Telefono:</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>"placeholder="Telefono" required>
                    </div>
                </div>
                
        </div> 
    </div>
      </div>
      <div class="modal-footer">
      <div class="btn-group" role="group" aria-label="">
                
                    <button type="submit" name="accion" value="cancelar" class="m-1 btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    
                    <button type="submit" name="accion" value="crear" class="m-1 btn btn-secondary" data-bs-dismiss="modal">Crear</button>
                    
                </div>

            </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal editar -->
<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EditModalLabel">Detalle de sociedad editar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card">
        

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="reason" class="form-label">Razon social:</label>
                    <input type="text" class="form-control" id="reason" name="reason" value="<?php echo $name; ?>" placeholder="Razon social" required>
                </div>

                <div class="row">

                    <div class="col-6 mb-3">
                        <label for="id" class="form-label">NIT:</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>" placeholder="Nit" required >
                    </div>

                    <div class="col-6 mb-3">
                        <label for="address" class="form-label">Direccion:</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" placeholder="Direccion" required>
                    </div>

                </div>

                <h5>Persona de contacto</h5>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" placeholder="Nombre" required>
                    </div>
                    
                    <div class="col-6 mb-3">
                        <label for="last_name" class="form-label">Apellido:</label>
                        <input type="Text" class="form-control" id="last_name" name="last_name" value="<?php echo $lastName; ?>" placeholder="Apellido" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"placeholder="Correo" required>
                    </div>
                    
                    <div class="col-6 mb-3">
                        <label for="phone" class="form-label">Telefono:</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>"placeholder="Telefono" required>
                    </div>
                </div>
                
                
                

        </div> 
    </div>
      </div>
      <div class="modal-footer">
      <div class="btn-group" role="group" aria-label="">
                    
                    <button type="submit" name="accion" value="editar" class="m-1 btn btn-warning" data-bs-dismiss="modal">Editar</button>
                    <button type="submit" name="accion" value="cancelar" class="m-1 btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </form>
      </div>
    </div>
  </div>
</div>



<script>
    

    function showMessage(){
        var myModal = new bootstrap.Modal(document.getElementById('EditModal'), {
        keyboard: false
        })
        var modalToggle = document.getElementById('EditModal') // relatedTarget
        myModal.show(modalToggle)
    }
    
    const element = document.getElementById("mostrar");

    const interval = setInterval(myTimer, 1000);

    function myTimer() {
        if(element.value == 1){
            showMessage()
            clearInterval(interval)
        }
    }

    

</script>


<?php include("../template/footer.php"); ?>