<?php
include('Librerias/session.php');
verificarSesion();
$colection = new MongoDB\Client();
$usuarios = $colection->selectCollection('gestionautos','usuarios');

$usuario = array('_id'=>'','nombreUser'=>'','email'=>'','nombre'=>'','apellido'=>'','contrasena'=>'');

if ($_POST) {

   // $id = $_POST['_id'];

    //unset($_POST['_id']);
    //if (strlen($id) > 2) {
      //  $condicion = array('_id'=> new MongoDB\BSON\ObjectId($id));
        //$usuarios->updateOne($condicion,$_POST);
    
    //}else{
       
        //$usuarios->insertOne($_POST); 
    //}

       
}else if (isset($_GET['usr'])) {
    $id = $_GET['usr'];
//    var_dump($id);
    $query = array('_id'=> new MongoDB\BSON\ObjectId($id));
    $usr = $usuarios->findOne($query);
    if ($usr) {
        $usuario = $usr;
    }
}
    


include("Nav.php");
?>
<div class="row">
            <div class="col col-sm-6">            
            <form method="post" action="">            
            <input type="hidden" name='_id' value="<?php echo $usuario['_id'];?>"/>
            <div class="input-group form-group">
                    <span class="input-group-addon">Usuario: </span>
                    <input type="text" value="<?php echo $usuario['nombreUser']?>" name="nombreUser" class="form-control"/>
                </div>
                <div class="input-group form-group">
                    <span class="input-group-addon">Email: </span>
                    <input type="text" value="<?php echo $usuario['email']?>" name="email" class="form-control"/>
                </div>
                <div class="input-group form-group">
                    <span class="input-group-addon">Nombre: </span>
                    <input type="text" value="<?php echo $usuario['nombre']?>" name="nombre" class="form-control"/>
                </div> 
                <div class="input-group form-group">
                    <span class="input-group-addon">Apellidos: </span>
                    <input type="text" value="<?php echo $usuario['apellido']?>" name="apellido" class="form-control"/>
                </div>
                              
                <div class="input-group form-group">
                    <span class="input-group-addon">Contraseña: </span>
                    <input type="text" value="<?php echo $usuario['contasena']?>" name="contasena" class="form-control"/>
                </div>
                <div>
                  <button class="btn btn-primary" type="submit">Guardar</button>
                </div>                
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>UserName</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody> 
                <?php 

                    $datos = $usuarios->find();
                    foreach($datos as $usr){
                        echo "<tr>
                            <td>{$usr['nombreUser']}</td>
                            <td>{$usr['nombre']}</td> 
                            <td>{$usr['apellido']}</td>
                            <td>{$usr['email']}</td> 
                            <td>
                                <a class='btn btn-success' href='Usuarios.php?usr={$usr['_id']}'>Editar</button>
                            </td>
                        </tr>";
                    }           

                ?>
            </tbody>
        </table>