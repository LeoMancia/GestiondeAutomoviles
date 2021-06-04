<?php
include('../Modelo/session.php');
verificarSesion();
$colection = new MongoDB\Client();
$M_M = $colection->selectCollection('gestionautos','marcas_modelos');
if ($_POST) {
    
    $marcas = $_POST['marca'];
    $modelos = $_POST['modelos'];
    foreach ($marcas as $k => $marca) {
        $modelo = $modelos[$k];
        $obj = new stdClass();
        $obj->marca = $marca;
        $obj->modelo = $modelo;
        if (strlen($k) > 2 ) {
            $query = array('_id'=> new MongoDB\BSON\ObjectId($k));
            $M_M->updateMany($query,['$set' => $obj]);
        }else{
            $M_M->insertOne($obj);
        }
        
    }

}
include("Nav.php");
?>
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Marcas / Modelos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <style>
.table-sortable tbody tr {
    cursor: move;
}
</style>
<section class="content">
<div class="container">
    <div class="row clearfix">
    	<div class="col-md-12 table-responsive">
        <form method="post" action="">
			<table class="table table-bordered table-hover table-sortable" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							Marca
						</th>
						<th class="text-center">
							Modelo
						</th>
                        <td><button type="button" onclick="addMarca('','','');">Añadir</button></td>
        				<th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
						</th>
					</tr>
				</thead>
				<tbody id="tbMarcas">
    				
				</tbody>
			</table>
            <button type="submimt">Guardar</button>
        </form>
        
		</div>
	</div>
	
</div>
<script>
    function addMarca(_id, marca, modelo){
        destino =document.getElementById('tbMarcas');
        tr =document.createElement('tr');
        td =document.createElement('td');
        txt = document.createElement('input');
        txt.setAttribute('name', 'marca['+_id+']');
        txt.type = 'text';
        txt.value= marca;
        txt.setAttribute('required','required');
        txt.setAttribute('class','form-control');
        txt.setAttribute('placeholder','Modelos separados por comas');
        td.appendChild(txt);
        tr.appendChild(td);

        
        td =document.createElement('td');
        txt = document.createElement('textarea');
        txt.setAttribute('name', 'modelos['+_id+']');
        txt.value = modelo;
        txt.setAttribute('required','required');
        txt.setAttribute('class','form-control');
        td.appendChild(txt);
        tr.appendChild(td);

        
        
        destino.appendChild(tr);

    }
</script>
<script>
    <?php 

        $datos = $M_M->find();
        foreach ($datos as $fila ) {
            echo "addMarca('{$fila['_id']}','{$fila['marca']}','{$fila['modelo']}'); ";
        }
    ?>
</script>