<?php

include('Librerias/session.php');
$mensaje ="";
if ($_POST) {
   if ( verificarUsuario($_POST)) {
       echo "<script> window.location='./' </script>";
       exit();
   }else{
       $mensaje = "El usuario no existe";
   }
    
}

include("Nav.php");


?>
<form method="post">
<div id="divLogin">
    <div class="form-group input-group">
        <span class="input-group-addon">Usuario:</span>
        <input type="text" name="nombreUser" class="form-control"/>
    </div>
    <div class="form-group input-group">
        <span class="input-group-addon">Contraseña:</span>
        <input type="text" name="contasena" class="form-control"/>
    </div>
    <div class="error">
        <?php echo $mensaje; ?>
    </div>
    <div class="form-group input-group">
        <button class="btn btn-success" type="submit">Entrar</button>
    </div>
</div>