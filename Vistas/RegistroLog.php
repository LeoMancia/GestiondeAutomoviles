<?php
include('../Modelo/session.php');
//verificarSesion();
$colection = new MongoDB\Client();
$usuarios = $colection->selectCollection('gestionautos','usuarios');
$mensaje ="";
$usuario = array('_id'=>'','nombreUser'=>'','email'=>'','nombre'=>'','apellido'=>'','contasena'=>'');

//Validaciones
  // Arrays para guardar mensajes y errores:
  $aErrores = array();
  $aMensajes = array();
  // Patrón para usar en expresiones regulares (admite letras acentuadas y espacios):
  $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
  $patron_correo = "/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/";
  $patron_contra = "/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/";

  if ($_POST) {
     //Update 
     $id = $_POST['_id'];

     unset($_POST['_id']);

    if( isset($_POST['nombreUser']) && isset($_POST['email']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['contasena']))
  {
       // nombreUser:
       if( empty($_POST['nombreUser']) ){
        $mensaje = "Debe especificar el Nombre de usuario";
      }
      else
      {
          // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
           if( preg_match($patron_texto, $_POST['nombreUser']) ){
                   // Email:
                  if( empty($_POST['email']) ){
                    $mensaje = "Debe especificar el Correo";
                  }
                  else
                  {
                      // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                      if( preg_match($patron_correo, $_POST['email']) ){
                           // Nombre:
                          if( empty($_POST['nombre']) ){
                            $mensaje = "Debe especificar el Nombre";
                          }
                          else
                          {
                              // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                              if( preg_match($patron_texto, $_POST['nombre']) ){
                                    // Apellido:
                              if( empty($_POST['apellido']) ){
                                $mensaje = "Debe especificar el Apellido";
                                  }
                              else
                              {
                                  // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
                                  if( preg_match($patron_texto, $_POST['apellido']) ){
                                      // Contraseña:
                                      if( empty($_POST['contasena']) ){
                                        $mensaje = "La contraseña debe de tener 8-16 caracteres, una letra mayuscula y una minuscula,a demas de un simbolo especial";
                                      }
                                      else
                                      {
                                          // Comprobar mediante una expresión regular
                                          if( preg_match($patron_contra, $_POST['contasena']) ){
                                           //////////////////////AGREGAR AQUI LO QUE QUIERE QUE SE VERIFIQUE///////////////////

                                           if (strlen($id) > 2) {

        
                                            $query = array('_id'=> new MongoDB\BSON\ObjectId($id));
                                            $usuarios->updateMany($query,['$set' => $_POST]);
                                            
                                          }else{
                                              if( !empty($_POST) )
                                              {
                                                  $usuarios->insertOne($_POST); 
                                              }
                                          }
                                                                                    
                                          }
                                          else{
                                            $mensaje = "La contraseña debe de tener 8-16 caracteres, una letra mayuscula y una minuscula,a demas de un simbolo especial";
                                          }
                                      }
                                          /////////
                                  }
                                  else{
                                    $mensaje = "El Apellido sólo puede contener letras y espacios";
                                  }
                                  //////////////
                              }
                              }
                              else{
                                $mensaje = "El Nombre sólo puede contener letras y espacios";
                              }
                              //////////
                          }
                      }
                      else{
                        $mensaje = "Formáto de correo inválido";
                      }
                      ////////
                  }
          }
          else{
            $mensaje = "El usuario sólo puede contener letras y espacios";
          }
      }
  }
  else
  {
      echo "<p>No se han especificado todos los datos requeridos.</p>";
  }
}else if (isset($_GET['usr'])) {
    //Metodo Get
    $id = $_GET['usr'];
    //var_dump($id);
    $query = array('_id'=> new MongoDB\BSON\ObjectId($id));
    $usr = $usuarios->findOne($query);
    if ($usr) {
        $usuario = $usr;
      
    }
}

 //Eliminar
 if (isset($_GET['del'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['del']);
    $usuarios->deleteOne(array('_id'=>$id));
}    


    // Si han habido errores se muestran, sino se mostrán los mensajes
    if( count($aErrores) > 0 )
    {
        echo "<p>ERRORES ENCONTRADOS:</p>";
        // Mostrar los errores:
        for( $contador=0; $contador < count($aErrores); $contador++ )
            echo $aErrores[$contador]."<br/>";
    }
    else
    {
        // Mostrar los mensajes:
        for( $contador=0; $contador < count($aMensajes); $contador++ )
            echo $aMensajes[$contador]."<br/>";
    }

include("Nav.php");
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestión de Usuarios</h1>
            </div>
            <div class="col-sm-6">
            <div class="error">
             <?php echo $mensaje; ?>
            </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->

<style>
    #playground-container {
        height: 500px;
        overflow: hidden !important;
        -webkit-overflow-scrolling: touch;
    }

    body,
    html {
        height: 100%;
        background-repeat: no-repeat;
        background: url(https://i.ytimg.com/vi/4kfXjatgeEU/maxresdefault.jpg);
        font-family: 'Oxygen', sans-serif;
        background-size: cover;
    }

    .main {
        margin: 50px 15px;
    }

    h1.title {
        font-size: 50px;
        font-family: 'Passion One', cursive;
        font-weight: 400;
    }

    hr {
        width: 10%;
        color: #fff;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        margin-bottom: 15px;
    }

    input,
    input::-webkit-input-placeholder {
        font-size: 11px;
        padding-top: 3px;
    }

    .main-login {
        background-color: #fff;
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;
        -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

    }

    .form-control {
        height: auto !important;
        padding: 8px 12px !important;
    }

    .input-group {
        -webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.21) !important;
        -moz-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.21) !important;
        box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.21) !important;
    }

    #button {
        border: 1px solid #ccc;
        margin-top: 28px;
        padding: 6px 12px;
        color: #666;
        text-shadow: 0 1px #fff;
        cursor: pointer;
        -moz-border-radius: 3px 3px;
        -webkit-border-radius: 3px 3px;
        border-radius: 3px 3px;
        -moz-box-shadow: 0 1px #fff inset, 0 1px #ddd;
        -webkit-box-shadow: 0 1px #fff inset, 0 1px #ddd;
        box-shadow: 0 1px #fff inset, 0 1px #ddd;
        background: #f5f5f5;
        background: -moz-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f5f5f5), color-stop(100%, #eeeeee));
        background: -webkit-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
        background: -o-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
        background: -ms-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
        background: linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5f5f5', endColorstr='#eeeeee', GradientType=0);
    }

    .main-center {
        margin-top: 30px;
        margin-right: 30px;
        margin: 0 auto;
        max-width: 400px;
        padding: 10px 40px;
        background: #009edf;
        color: #FFF;
        text-shadow: none;
        -webkit-box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.31);
        -moz-box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.31);
        box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, 0.31);

    }

    span.input-group-addon i {
        color: #009edf;
        font-size: 17px;
    }

    .login-button {
        margin-top: 5px;
    }

    .login-register {
        font-size: 11px;
        text-align: center;
    }
</style>
<section>
    <div class="content">
        <div class="container-fluid">
            <div class="text-align:center">
                <form method="post" action="">
                    <div class="col-md-12">
                    <form method="post" action="">            
                        <input type="hidden" name='_id' value="<?php echo $usuario['_id']; ?>" />
                        <div class="input-group form-group">

                            <div class="main-login main-center" style="text-align:center;">
                                <h5>Registrar Usuario</h5>
                                <form>

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Usuario</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['nombreUser']?>" name="nombreUser" class="form-control" placeholder="ExampleUser"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['email']?>" name="email" class="form-control" placeholder="example@example.com"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Nombre</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['nombre']?>" name="nombre" class="form-control" placeholder="Juan Perez"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Apellido</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['apellido']?>" name="apellido" class="form-control" placeholder="Aguilar Martinez"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label"> Contraseña </label>
                                        <div class="form-row">
                                            <div class="col-md-10">
                                                 <input class="form-control" type="password" value="<?php echo $usuario['contasena']?>" name="contasena" id="password" placeholder="8-16 crts A-z +%&/"/>
                                            </div>
                                            <div class="col-md-2">
                                               <button class="btn btn-primary" type="button" onclick="mostrarContrasena()">show</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div >
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                    <a class="btn login_btn" href="login.php">Cancelar</a>
                                    </div>
                                </form>
                                </form>
                            </div>
                        </div>
                    </div>
                 
                </form>
            </div>
        </div>
    </div>
</section>
<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>