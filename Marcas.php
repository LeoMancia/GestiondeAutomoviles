<?php
include('Librerias/session.php');
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
<form method="post" action="">
<table class="table">
    <thead>
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <td><button type="button" onclick="addMarca('','','');">+</button></td>
        </tr>
    </thead>
    <tbody id="tbMarcas">

    </tbody>
    <button type="submimt">Guardar</button>
</table>
</form>
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