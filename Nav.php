<?php

 $Instancia = new plantilla();

class plantilla {
    function __construct(){
      $user = usuarioActivo();
    ?>
    <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    
    <title>Gestion de Autos</title>
    <LINK REL=StyleSheet HREF="./css/Global.css" TYPE="text/css" MEDIA=screen>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  </head>
  <body>
    <div id="divPagina" class="container" >
      <?php
          if (usuarioActivo()):         
      ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Vehiculos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Marcas.php">Marcas/Modelos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Usuarios.php">Usuarios</a>
        </li>
      </ul>
      <form class="d-flex">
      <li>
      <?php echo $user['nombre'];
      ?>
      </li>
        <a href="salir.php">Salir</a>
      </form>
    </div>
  </div>
</nav>
<?php endif; ?>

    <?php        
    }
    function __destruct(){
    ?>
    </div>
   <!-- <div class="container">
        <hr/>
        Derechos Reservados @2021
    </div>
    -->
    <?php
    }
    
}


