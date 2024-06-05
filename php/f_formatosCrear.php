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
        <strong>Crear Formatos</strong>
      </div>

      <div class="panel-body">
       <form id="f_formatosCrear" role="form">
		  <div class="form-group">
              <label class="control-label">Planta:<span class="rojo">*</span></label>
              <select id="For_Pla_Codigo" class="form-control" multiple>
              <?php foreach($resPla as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
            </div>
		        <div class="form-group">
              <label class="control-label">Formato:<span class="rojo">*</span></label>
              <input type="text" id="For_Nombre" class="form-control" maxlength="30">
            </div>		        
            <div class="form-group">
              <label class="control-label">Factor de conversión:<span class="rojo">*</span></label>
              <input type="text" id="For_FactorConversion" class="form-control inputDecimales" maxlength="30">
            </div>
		  </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">inputDecimales();</script>