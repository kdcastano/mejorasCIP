<?php include("op_sesion.php");
include("../class/parametros.php");
include("../class/formularios_defectos.php");

$par = new parametros();
if($_POST['tipoParametro'] == "2"){
  $defectosPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"11");
}

if($_POST['tipoParametro'] == "8"){
  $defectosPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"12");
}

$ladosPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"13");
$estamposPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'],"14");

$for = new formularios_defectos();
$for->setForD_Codigo($_POST['codigo']);
$for->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong><?php echo $_POST['tipoParametro'] == "2" ? "Segunda":"retal"; ?> - <?php echo $_POST['hora']; ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_variablesMasivasCalidadFormularioActualizar" role="form">
          <input type="hidden" id="ForD_Codigo" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Defecto:<span class="rojo">*</span></label>
              <select id="ForD_DefectoAct" class="form-control">
                <?php foreach($defectosPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>" <?php echo $for->getForD_Defecto() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label class="control-label">Estampo:<span class="rojo">*</span></label>
              <select id="ForD_EstampoAct" class="form-control">
                <?php foreach($estamposPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>" <?php echo $for->getForD_Estampo() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label class="control-label">Lado:<span class="rojo">*</span></label>
              <select id="ForD_LadoAct" class="form-control">
                <?php foreach($ladosPar as $registro){ ?>
                  <option value="<?php echo $registro[0]; ?>" <?php echo $for->getForD_Lado() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label class="control-label">Número de piezas:<span class="rojo">*</span></label>
            <input type="text" id="ForD_NumeroPiezasAct" class="form-control inputEntero" value="<?php echo $for->getForD_NumeroPiezas(); ?>">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">inputEntero();</script>