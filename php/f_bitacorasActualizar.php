<?php
include("op_sesion.php");
include("../class/plantas.php");
include_once("../class/usuarios.php");
include("../class/puestos_trabajos.php");
include("../class/bitacoras.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$usu10 = new usuarios();
$usu10->setUsu_Codigo($_SESSION['CP_Usuario']);
$usu10->consultar();
$resUsu10 = $usu10->listarUsuariosBitacora($usu10->getPla_Codigo());

$pueT = new puestos_trabajos();
$resPueT = $pueT->listarPuestosTrabajoFiltros($_SESSION['CP_Usuario']);

$bit1 = new bitacoras();
$bit1->setBit_Codigo($_POST['codigo']);
$bit1->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Actualizar Bitácora</strong>
      </div>
      <div class="panel-body">        
        <form id="f_bitacorasActualizar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-group">
                <label class="control-label">Planta:<span class="rojo">*</span></label>
                <select id="Pla_CodigoAct" class="form-control">
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $bit1->getPla_Codigo()){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Requerimiento:<span class="rojo">*</span></label>
                <select id="Bit_RequerimientoAct" class="form-control">
                  <option value="3" <?php echo $bit1->getBit_Requerimiento()=="3"?"selected":""; ?>>No aplica</option>
                  <option value="2" <?php echo $bit1->getBit_Requerimiento()=="2"?"selected":""; ?>>Mantenimiento</option>
                  <option value="1" <?php echo $bit1->getBit_Requerimiento()=="1"?"selected":""; ?>>Producción</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Puesto de Trabajo:<span class="rojo">*</span></label>
                <select id="PueT_CodigoAct" class="form-control">
                  <?php foreach($resPueT as $registro4){ ?>
                    <option value="<?php echo $registro4[0]; ?>" <?php if($registro4[0] == $bit1->getPueT_Codigo()){ echo "selected";} ?>><?php echo $registro4[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">SAP:<span class="rojo">*</span></label>
                <select id="Bit_SAPAct" class="form-control" >
                  <option value="NULL">No aplica</option>
                  <?php foreach($resUsu10 as $registro2){ ?>
                    <option value="<?php echo $registro2[0]; ?>" <?php if($registro2[0] == $bit1->getBit_SAP()){ echo "selected";} ?>><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">SAM:<span class="rojo">*</span></label>
                <select id="Bit_SAMAct" class="form-control">
                  <option value="NULL">No aplica</option>
                  <?php foreach($resUsu10 as $registro3){ ?>
                    <option value="<?php echo $registro3[0]; ?>" <?php if($registro3[0] == $bit1->getBit_SAM()){ echo "selected";} ?>><?php echo $registro3[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-group">
                <label class="control-label">Descripción:<span class="rojo">*</span></label>
                <textarea id="Bit_DescripcionAct" class="form-control" cols="20" rows="7" required autocomplete="off"><?php echo $bit1->getBit_Descripcion(); ?></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Acción (sí aplica):</label>
                <textarea id="Bit_AccionAct" class="form-control" cols="10" rows="4" autocomplete="off"><?php echo $bit1->getBit_Accion(); ?></textarea>
              </div>
            </div>
          </div>
        </form>        
      </div>
    </div>
  </div>
</div>