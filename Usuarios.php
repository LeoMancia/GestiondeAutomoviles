<?php
include('Librerias/session.php');
verificarSesion();
$colection = new MongoDB\Client();
$usuarios = $colection->selectCollection('gestionautos','usuarios');

$usuario = array('_id'=>'','nombreUser'=>'','email'=>'','nombre'=>'','apellido'=>'','contasena'=>'');

if ($_POST) {

    //Update 
    $id = $_POST['_id'];

    unset($_POST['_id']);
    if (strlen($id) > 2) {

        
      $query = array('_id'=> new MongoDB\BSON\ObjectId($id));
      $usuarios->updateMany($query,['$set' => $_POST]);
      
    }else{
       //Insert
      $usuarios->insertOne($_POST); 
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


include("Nav.php");
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestión de Usuarios</h1>
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
            <div class="row">
                <form method="post" action="">
                    <div class="col-md-3">
                    <form method="post" action="">            
                        <input type="hidden" name='_id' value="<?php echo $usuario['_id']; ?>" />
                        <div class="input-group form-group">

                            <div class="main-login main-center">
                                <h5>Registrar Usuario</h5>
                                <form>

                                    <div class="form-group">
                                        <label for="name" class="cols-sm-2 control-label">Usuario</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['nombreUser']?>" name="nombreUser" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="cols-sm-2 control-label">Email</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['email']?>" name="email" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="username" class="cols-sm-2 control-label">Nombre</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['nombre']?>" name="nombre" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="cols-sm-2 control-label">Apellido</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['apellido']?>" name="apellido" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm" class="cols-sm-2 control-label"> Contraseña </label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                            <input type="text" value="<?php echo $usuario['contasena']?>" name="contasena" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div >
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                    </div>
                                </form>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
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
                                <a onClick='return confirmarBorrar()' class='btn btn-danger' href='Usuarios.php?del={$usr['_id']}'>Eliminar</button>
                            </td>
                        </tr>";
                    }           

                ?>
            </tbody>
                           
                        </table>
                        <script>
                            function confirmarBorrar() {
                                return confirm("¿Seguro que desea borrar este usuario?")
                            }
                        </script>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>