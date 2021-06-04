<?php
include('Librerias/session.php');
verificarSesion();
$m = new MongoDB\Client();
$vehiculo = $m->selectCollection('gestionautos','vehiculos');
if ($_POST) {
  $vehiculo->insertOne($_POST);
}
include("Nav.php");
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Vehiculos</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
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
<!-- Main content -->
<section>
  <div class="conainer">
  
      <div class="container-fluid">
        <div class="row">
          <form method="post" action="">
            <div class="col-md-12">
              <input type="hidden" name='_id' value="<?php //echo $usuario['_id']; ?>" />
              <div class="input-group form-group">

                <div class="main-login main-center">
                  <h5>Registrar Automovil</h5>
                  <form class="" method="post" action="#">

                    <div class="form-group">
                      <label for="name" class="cols-sm-2 control-label">Placa</label>
                      <div class="cols-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                          <input type="text" class="form-control" name="placa" placeholder="Coloque el numero de placa" />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                       <span class="input-group-addon">Marca</span>
                       <select onchange="buscarModelos(this.value);" name="marca" id="cmbMarca" class="form-control"></select>
                    </div>

                    <div class="form-group">
                      <span class="input-group-addon">Modelo</span>
                      <select name="modelo" id="cmbModelo" class="form-control"></select>
                    </div>
                    
                    <div class="form-group">
                      <span class="input-group-addon">Transmision</span>
                      <div class="form-control">
                      <label><input type="radio" name="transmision" value="AT"/>Automatica</label>
                      <label><input type="radio" name="transmision" value="MC"/>Manual</label>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="cols-sm-10">
                      <span class="input-group-addon">Comentario</span>
                      <textarea name="comentario" class="form-control"></textarea>
                      </div>
                    </div>
                    

                    <div class="form-group ">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-8">
                <div class="panel-heading">
                    <div class="pull-right">
                        <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                           
                        </span>
                    </div>
                </div>
                <div class="panel-body">
                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Buscar" />
                </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Transmision</th>
                                    <th>Comentario</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $datos = $vehiculo->find();
                                
                                
                                foreach ($datos as $fila ) {
                                  echo "<tr>
                                  <td>{$fila['placa']}</td>
                                  <td>{$fila['marca']}</td>
                                  <td>{$fila['modelo']}</td>
                                  <td>{$fila['transmision']}</td>
                                  <td>{$fila['comentario']}</td>                  
                                  </tr>";
                                }
                              ?>
                            </tbody>
                        </table>
                       
                    </div>

          </form>
        </div>
      </div>
   
  </div>
</section>
<script>
var marcas = [];
var modelos = [];
  <?php
  $m_m = $m -> selectCollection('gestionautos','marcas_modelos');
  $todo = $m_m -> find();
  $modelos = array();
  foreach ($todo as $fila ) {
    echo "marcas.push('{$fila['marca']}');"; 
    $modelos[$fila['marca']] = $fila['modelo'];    
  }
    $modelos = json_encode($modelos);
  echo "modelos = {$modelos}";
  ?>
  
    cmb = document.getElementById('cmbMarca');
    for (let x = 0; x < marcas.length; x++) {
       opt = document.createElement('option');
       opt.value = marcas[x];
       opt.text = marcas[x];
       cmb.appendChild(opt);
    }
    cmb.selectedIndex = -1;
/////////////////Apartado de llenado de ambos combobox//////////////////////////

function buscarModelos(marca) {
          cmb = document.getElementById('cmbModelo');
          cmb.innerHTML = '';
          mismodelos = modelos[marca].split(',');
          for (let x = 0; x < mismodelos.length; x++) {
            opt = document.createElement('option');
            opt.value = mismodelos[x];
            opt.text = mismodelos[x];
            cmb.appendChild(opt);
                  
          }
          cmb.selectedIndex = -1;
        }
</script>
