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
        <div class="row">
            <div class="col col-sm-6">
            <form method="post" action="">
                <div class="input-group form-group">
                    <span class="input-group-addon">Placa: </span>
                    <input types="text" name="placa" class="form-control"/>
                </div>
                <div class="input-group form-group">
                    <span class="input-group-addon">Marca</span>
                    <select onchange="buscarModelos(this.value);" name="marca" id="cmbMarca" class="form-control">
                     
                    </select>
                </div>
                <div class="input-group form-group">
                    <span class="input-group-addon">Modelo</span>
                    <select name="modelo" id="cmbModelo" class="form-control"></select>
                </div>
                
                <div class="input-group form-group">
                    <span class="input-group-addon">Transmision</span>
                    <div class="form-control">
                    <label><input type="radio" name="transmision" value="AT"/>Automatica</label>
                    <label><input type="radio" name="transmision" value="MC"/>Manual</label>
                    </div>
                </div>

                <div class="input-group form-group">
                  <span class="input-group-addon">Comentario</span>
                  <textarea name="comentario" class="form-control"></textarea>
                </div>
                <div>
                  <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
                </form>
            </div>
        </div>
        <fieldset>
          <legend>Vehiculos Agregados</legend>
          <table class="table">
            <thead>
              <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Transmision</th>
                <th>Comentario</th>
                <td></td>
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
        </fieldset>

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

  