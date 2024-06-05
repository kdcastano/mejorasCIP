<?php 
include( "op_sesion.php" );
include("../class/plantas.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Configuración de reportes</strong>
      </div>
      <div class="panel-body">
       <form id="f_agrupacionesCrear" role="form">
        <div class="form-group">
          <label class="control-label">Planta:<span class="rojo">*</span></label>
          <select id="Agr_Pla_Codigo" class="form-control">
            <option value="">Seleccionar</option>
            <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
            <?php } ?>
          </select>
        </div>
         <div class="form-group">
          <label class="control-label">Nombre:<span class="rojo">*</span></label>
          <input type="text" id="Agr_Nombre" class="form-control" maxlength="30" autocomplete="off">
        </div>
        <div class="form-group">
          <label class="control-label">Secuencia:<span class="rojo">*</span></label>
          <input type="text" id="Agr_Secuencia" class="form-control" maxlength="10" autocomplete="off">
        </div>
        <div class="form-group">
          <label class="control-label">Tipo:<span class="rojo">*</span></label>
          <select id="Agr_Tipo" class="form-control">
            <option value=""></option>
            <option value="2">Fórmula</option>
            <option value="1">Programa de Producción</option>            
          </select>
        </div>
		  </form>
      </div>
    </div>
  </div>
</div>