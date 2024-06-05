<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear equipos</strong> </div>
      <div class="panel-body">
        <form id="f_AreasCrear"  role="form">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_Codigo" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group cargarAreaAnterior">
            <label class="control-label">Área anterior:</label>
            <select id="Are_Anterior" class="form-control">
              <option value=""></option>
            </select>
          </div>  
          <div class="form-group cargarAreaSiguiente">
            <label class="control-label">Área siguiente:</label>
            <select id="Are_Siguiente" class="form-control">
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre: <span class="rojo">*</span></label>
            <input type="text" id="Are_Nombre" class="form-control" maxlength="45" required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Secuencia: <span class="rojo">*</span></label>
            <input type="text" id="Are_Secuencia" class="form-control" maxlength="11" required autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Tipo: <span class="rojo">*</span></label>
            <select id="Are_Tipo" class="form-control" required>
               <option value=""></option>
              <option value="6"> Calidad</option>
              <option value="14"> Empaque</option>
              <option value="13"> Clasificación</option>
              <option value="10"> Cubierta</option>
              <option value="9"> Decorado</option>
              <option value="4"> Esmaltado</option>
              <option value="11"> Engobe reverso</option>
              <option value="5"> Horno</option>
              <option value="8"> Laboratorio</option>
              <option value="1"> Molienda y Atomizado</option>
              <option value="12"> Playa de MP</option>
              <option value="2"> Prensas</option>
              <option value="7"> Preparación Esmaltes</option>
              <option value="3"> Secadero</option>
            </select>
          </div>  
        </form>
      </div>
    </div>
  </div>
</div>
