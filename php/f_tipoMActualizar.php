<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/tipo_mercado.php" );
include( "../class/submarcas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$tip = new tipo_mercado();
$tip->setTipM_Codigo( $_POST[ 'codigo' ] );
$tip->consultar();

$sub = new submarcas();
$resSub= $sub->buscarPlanta( $tip->getSub_Codigo() );
$codPlanta = $resSub[ 0 ];

$resSubmarcas = $sub->listarSubmarcasUsuario( $codPlanta, $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Tipo de mercado</strong> </div>
      <div class="panel-body">
        <form id="f_tipoMercadosActualizar" role="form">
          <input type="hidden" id="codigotipoMercadoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Pla_Codigo_tipoMercadosAct" class="form-control" required>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] ==  $codPlanta){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarSubmarcasActualizar">
            <label class="control-label">Submarca: <span class="rojo">*</span></label>
            <select id="Sub_CodigoAct" class="form-control" required>
              <?php foreach($resSubmarcas as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $tip->getSub_Codigo()){ echo "selected"; } ?>><?php echo $registro[1]; ?></option>
              <?php } ?>				
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Tipo: <span class="rojo">*</span></label>
			  <select id="TipoM_TipoAct" class="form-control" required>
                <option value="1" <?php echo $tip->getTipM_Tipo() == "1" ? "selected" : ""; ?> >EUROPALLET</option>
                <option value="2" <?php echo $tip->getTipM_Tipo() == "2" ? "selected" : ""; ?> >EXPORTACIÓN</option>
                <option value="3" <?php echo $tip->getTipM_Tipo() == "3" ? "selected" : ""; ?>>NACIONAL</option>
              </select>
          </div>
			<div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="TipoM_EstadoAct" class="form-control">
              <option value="1" <?php echo $tip->getTipM_Estado()=="1"?"selected":""; ?>>Activo</option>
			<option value="0" <?php echo $tip->getTipM_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
