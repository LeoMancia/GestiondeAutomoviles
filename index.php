<?php
include('Librerias/session.php');
verificarSesion();
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
                    <select name="marca" id="" class="form-control"></select>
                </div>
                <div class="input-group form-group">
                    <span class="input-group-addon">Modelo</span>
                    <select name="modelo" id="" class="form-control"></select>
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
            </tbody>
          </table>
        </fieldset>

  