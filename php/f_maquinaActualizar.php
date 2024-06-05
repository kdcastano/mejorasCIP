<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/areas.php" );
include( "../class/maquinas.php" );
include( "../class/agrupaciones_maquinas.php" );
include( "../class/agrupaciones_maquinas_configft.php" );

$maq = new maquinas();
$maq->setMaq_Codigo($_POST['codigo']);
$maq->consultar();

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$are = new areas();
$are->setAre_Codigo($maq->getAre_Codigo());
$are->consultar();
$resArea = $are->listarAreasPlanta($are->getPla_Codigo(),"1",$_SESSION[ 'CP_Usuario' ]);

$agr = new agrupaciones_maquinas();
$resAgru = $agr->listarAgrupacionesMaquinas($are->getPla_Codigo(),$_SESSION['CP_Usuario']);

$agrMaqCFT = new agrupaciones_maquinas_configft();
$resAgrMaqCFT = $agrMaqCFT->buscarAgrupacionMaq($maq->getMaq_Codigo());

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Editar máquina</strong> </div>
      <div class="panel-body">
        <form id="f_MaquinasActualizar"  role="form">
          <input type="hidden" id="codigoMaquinaAct" value="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="agrupacionMaqCFTAct" value="<?php echo $_POST['agrupacion']; ?>">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_CodigoAct" class="form-control" required>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $are->getPla_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarAreaActualizar">
            <label class="control-label">Equipo: <span class="rojo">*</span></label>
            <select id="Are_CodigoAct" class="form-control" required>
                <?php foreach($resArea as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $maq->getAre_Codigo() ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarAgrupacionMaquinaActualizar">
            <label class="control-label">Operación de control: <span class="rojo">*</span></label>
            <select id="AgrM_CodigoAct" class="form-control" required>
                <?php foreach($resAgru as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $registro[0] == $resAgrMaqCFT[0] ? "selected" : ""; ?> ><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarNombreAgrupacionActualizar">
            <label class="control-label">Nombre: <span class="rojo">*</span></label>
            <input type="text" id="Maq_NombreAct" class="form-control" maxlength="50" value="<?php echo $maq->getMaq_Nombre(); ?>" required autocomplete="off">
          </div> 
          <div class="form-group">
            <label class="control-label">Orden ficha técnica:: <span class="rojo">*</span></label>
            <input type="text" id="Maq_OrdenAct" class="form-control" value="<?php echo $maq->getMaq_Orden(); ?>" required autocomplete="off">
          </div>
			<div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="Maq_EstadoAct" class="form-control">
              <option value="1" <?php echo $maq->getMaq_Estado()=="1"?"selected":""; ?>>Activo</option>
			<option value="0" <?php echo $maq->getMaq_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
