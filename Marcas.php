<?php
include('Librerias/session.php');
verificarSesion();
include("Nav.php");
?>
<form method="post" action="">
<table class="table">
    <thead>
        <tr>
            <th>Marca</th>
            <th>Modelo</th>
            <td><button type="button" onclick="addMarca();">+</button></td>
        </tr>
    </thead>
    <tbody id="tbMarcas">

    </tbody>
    <button type="submimt">Guardar</button>
</table>
</form>
<script>
    function addMarca(){
        destino =document.getElementById('tbMarcas');
        tr =document.createElement('tr');
        td =document.createElement('td');
        txt = document.createElement('input');
        txt.setAttribute('name', 'marca[]');
        txt.type = 'text';
        txt.setAttribute('required','required');
        txt.setAttribute('class','form-control');
        txt.setAttribute('placeholder','Modelos separados por comas');
        td.appendChild(txt);
        tr.appendChild(td);

        
        td =document.createElement('td');
        txt = document.createElement('textarea');
        txt.setAttribute('name', 'modelos[]');
        txt.setAttribute('required','required');
        txt.setAttribute('class','form-control');
        td.appendChild(txt);
        tr.appendChild(td);
        
        destino.appendChild(tr);

    }
</script>