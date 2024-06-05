<?php
include("op_sesion.php");
include("../class/plantas.php");
include_once("../class/usuarios.php");
include("../class/puestos_trabajos.php");
include("../class/estaciones_usuarios.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$usu10 = new usuarios();
$usu10->setUsu_Codigo($_SESSION['CP_Usuario']);
$usu10->consultar();
$resUsu10 = $usu10->listarUsuariosBitacora($usu10->getPla_Codigo());

$pueT = new puestos_trabajos();
$resPueT = $pueT->listarPuestosTrabajoFiltros($_SESSION['CP_Usuario']);

$est = new estaciones_usuarios();
$resEst = $est->hallarEstacionUsuarioLogueoOperador($fecha,$_SESSION['CP_Usuario']);
$est->setEstU_Codigo($resEst[0]);
$est->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Crear Bitácora</strong>
      </div>
      <div class="panel-body">        
        <form id="f_bitacorasCrear" role="form">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-group">
                <label class="control-label">Planta:<span class="rojo">*</span></label>
                <select id="Pla_Codigo" class="form-control" required>
                  <option value=""></option>
                  <?php foreach($resPla as $registro){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Requerimiento:<span class="rojo">*</span></label>
                <select id="Bit_Requerimiento" class="form-control" required>
                  <option value=""></option>
                  <option value="3">No aplica</option>
                  <option value="2">Mantenimiento</option>
                  <option value="1">Producción</option>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">Puesto de Trabajo:<span class="rojo">*</span></label>
                <select id="PueT_Codigo" class="form-control" required <?php if($usu10->getUsu_Rol() == "1"){echo "disabled";} ?>>
                    <option value="">Seleccione</option>
                  <?php foreach($resPueT as $registro4){ ?>
                    <option value="<?php echo $registro4[0]; ?>" <?php echo $est->getPueT_Codigo() == $registro4[0] ? "selected":""; ?>><?php echo $registro4[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">SAP/SAM:<span class="rojo">*</span></label>
                <select id="Bit_SAP" class="form-control" required>
                  <option value="">Seleccione</option>
                  <option value="-1">No aplica</option>
                  <?php foreach($resUsu10 as $registro2){ ?>
                    <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>
              </div>
           <?php /*?>   <div class="form-group">
                <label class="control-label">SAM:<span class="rojo">*</span></label>
                <select id="Bit_SAM" class="form-control">
                  <option value="">Seleccione</option>
                  <option value="NULL">No aplica</option>
                  <?php foreach($resUsu10 as $registro3){ ?>
                    <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[1]; ?></option>
                  <?php } ?>
                </select>
              </div><?php */?> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="form-group">
                <label class="control-label">Descripción:<span class="rojo">*</span></label>
                <textarea id="Bit_Descripcion" class="form-control" cols="20" rows="4" required autocomplete="off"></textarea>
              </div>
              <div class="form-group">
                <label class="control-label">Acción (sí aplica):</label>
                <textarea id="Bit_Accion" class="form-control" cols="10" rows="3" autocomplete="off"></textarea>
              </div>
            </div>
          </div>
        </form>        
      </div>
    </div>
  </div>
</div>