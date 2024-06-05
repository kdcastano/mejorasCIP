<?php include("op_sesion.php");
include("../class/parametros.php");

$par = new parametros();
if($_POST['tipoParametro'] == "2"){
  $defectosPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"11");
}

if($_POST['tipoParametro'] == "8"){
  $defectosPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"12");
}

$ladosPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"13");
$estamposPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"14");

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong><?php echo $_POST['tipoParametro'] == "2" ? "Segunda":"Rotura/Desperdicio cocido"; ?> - <?php echo $_POST['hora']; ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_variablesMasivasCalidadFormulario" role="form">
          <input type="hidden" id="Cal_Codigo" value="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="ForD_Hora" value="<?php echo $_POST['hora']; ?>">
          <input type="hidden" id="For_Codigo" value="<?php echo $_POST['formato']; ?>">
          <input type="hidden" id="ForD_Familia" value="<?php echo $_POST['familia']; ?>">
          <input type="hidden" id="ForD_Color" value="<?php echo $_POST['color']; ?>">
          <input type="hidden" id="ForD_codigoEstU" value="<?php echo $_POST['codigoEstU']; ?>">
          <div class="form-group">
            <label class="control-label">Defecto:<span class="rojo">*</span></label>
              <select id="ForD_Defecto" class="form-control" required>
                <?php foreach($defectosPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label class="control-label">Punzón:<span class="rojo">*</span></label>
              <select id="ForD_Estampo" class="form-control" required>
                <option></option>
                <?php foreach($estamposPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label class="control-label">Lado:<span class="rojo">*</span></label>
              <select id="ForD_Lado" class="form-control" required>
                <option></option>
                <?php foreach($ladosPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label class="control-label">Número de piezas:<span class="rojo">*</span></label>
            <input type="text" id="ForD_NumeroPiezas" class="form-control inputEntero" autocomplete="off" required>
          </div><br>
          <div class="mensajeErrorDefectoCrear"></div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">inputEntero();</script>