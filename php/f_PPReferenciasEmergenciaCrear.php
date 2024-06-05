<?php
include( "op_sesion.php" );
include( "../class/referencias_emergencias.php" );

date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$ref = new referencias_emergencias();
$ref->setRefE_Codigo( $_POST[ 'codigo' ] );
$ref->consultar();
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear nuevo Programa de producción</strong> </div>
      <div class="panel-body">
        <form id="f_PPReferenciasEmergenciasCrear" role="form">
          <input type="hidden" id="Pla_Codigo" value="<?php echo $ref->getPla_Codigo(); ?>">
          <input type="hidden" id="For_Codigo" value="<?php echo $ref->getFor_Codigo(); ?>">
          <input type="hidden" id="Are_Codigo" value="<?php echo $ref->getAre_Codigo(); ?>">
          <input type="hidden" id="ProP_Tipo" value="1">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Tipo: <span class="rojo">*</span></label>
              <?php
                if ( $ref->getRefE_Tipo() == 1 ) {
                  $tipo = "Paradas programadas de mantenimiento";
                }
                if ( $ref->getRefE_Tipo() == 2 ) {
                  $tipo = "Pruebas programadas";
                }
                if ( $ref->getRefE_Tipo() == 3 ) {
                  $tipo = "Referencias manuales";
                }
              ?>
              <input type="text" id="RefE_Tipo" class="form-control" value="<?php echo $tipo; ?>" required disabled>
            </div>
            <div class="form-group">
              <label class="control-label">Centro de costos:<span class="rojo">*</span></label>
              <input type="text" id="RefE_CentroCostos" class="form-control" value="<?php echo $ref->getRefE_CentroCostos(); ?>" required disabled>
            </div>
            <div class="form-group">
              <label class="control-label">Planta: <span class="rojo">*</span></label>
              <input type="text" id="Pla_CodigoVer" class="form-control" value="<?php echo $_POST['planta']; ?>" required disabled>
            </div>
            <div class="form-group e_cargarAreaCrear">
              <label class="control-label">Equipo: <span class="rojo">*</span></label>
              <input type="text" id="Are_CodigoVer" class="form-control" value="<?php echo $_POST['area']; ?>" required disabled>
            </div>
            <div class="form-group e_cargarFormatoReferenciaEmergencia">
              <label class="control-label">Formatos: <span class="rojo">*</span></label>
              <input type="text" id="For_CodigoVer" class="form-control" value="<?php echo $_POST['formato']; ?>" required disabled>
            </div>
            
            <?php if($ref->getRefE_Tipo() == 3){ ?>
              <div class="form-group e_cargarFamiliaReferenciaEmergencia" >
                <label class="control-label"> Familia: <span class="rojo">*</span></label>
                <input type="text" id="RefE_Familia" class="form-control" value="<?php echo $ref->getRefE_Familia();  ?>" required disabled>
              </div>
              <div class="form-group e_cargarColorCrear">
                <label class="control-label">Color: <span class="rojo">*</span></label>
                <input type="text" id="RefE_Color" class="form-control" value="<?php echo $ref->getRefE_Color();  ?>" required disabled>
              </div>
               <div class="form-group" >
                <label class="control-label"><?php if($usu->getPla_Codigo() == "22"){ echo "Producto:";}else{echo "Descripción:";} ?> Descripción:<span class="rojo">*</span></label>
                <input type="text" id="RefE_Descripcion" autocomplete="off" class="form-control" value="<?php if($usu->getPla_Codigo() == "22"){ echo $_POST['formato']." ".$ref->getRefE_Familia()." ".$ref->getRefE_Color();}else{echo $ref->getRefE_Descripcion();}   ?>" required disabled>
              </div>
            <?php } ?>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <?php if($ref->getRefE_Tipo() == 3){ ?>
              <div class="form-group">
                <label class="control-label">Secuencia:<span class="rojo">*</span></label>
                <input type="text" id="ProP_Prioridad" class="form-control" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label class="control-label">Fecha: <span class="rojo">*</span></label>
                <input type="text" id="ProP_Fecha" class="form-control fecha" value="<?php echo $fecha; ?>" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label class="control-label">Hora inicio:</label>
                <input type="text" id="ProP_HoraInicio" class="form-control hora" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">Cantidad ordenada:<span class="rojo">*</span></label>
                <input type="text" id="ProP_Cantidad" class="form-control" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label class="control-label">Cantidad Europalet:</label>
                <input type="hidden" id="promedioEP" value="<?php echo $_POST['europalet']; ?>">
                <input type="text" id="ProP_CantEP" autocomplete="off" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label">Cantidad Europalet ㎡:</label>
                <input type="text" id="ProP_MetrosEP" autocomplete="off" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label">Cantidad Exportación:</label>
                <input type="hidden" id="promedioEXPO" value="<?php echo $_POST['exportacion']; ?>">
                <input type="text" id="ProP_CantEXPO" autocomplete="off" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label">Cantidad Exportación ㎡:</label>
                <input type="text" id="ProP_MetrosEXPO" autocomplete="off" class="form-control">
              </div>
            <?php } ?>
            <?php if($ref->getRefE_Tipo() == 1){ ?>
              <div class="form-group" >
                <label class="control-label"> Parada:<span class="rojo">*</span></label>
                <input type="text" id="RefE_Descripcion" autocomplete="off" class="form-control" value="<?php echo $ref->getRefE_Descripcion();  ?>" required disabled>
              </div>
              <div class="form-group">
                <label class="control-label">Fecha: <span class="rojo">*</span></label>
                <input type="text" id="ProP_Fecha" class="form-control fecha" value="<?php echo $fecha; ?>" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label class="control-label">Hora inicio:</label>
                <input type="text" id="ProP_HoraInicio" class="form-control hora" autocomplete="off">
              </div>
            <?php } ?>
            <?php if($ref->getRefE_Tipo() == 2){ ?>
             <div class="form-group" >
                <label class="control-label"> Nombre:<span class="rojo">*</span></label>
                <input type="text" id="RefE_Descripcion" autocomplete="off" class="form-control" value="<?php echo $ref->getRefE_Descripcion();  ?>" required disabled>
              </div>
              <div class="form-group">
                <label class="control-label">Fecha: <span class="rojo">*</span></label>
                <input type="text" id="ProP_Fecha" class="form-control fecha" value="<?php echo $fecha; ?>" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label class="control-label">Hora inicio:</label>
                <input type="text" id="ProP_HoraInicio" class="form-control hora" autocomplete="off">
              </div>
              <div class="form-group">
                <label class="control-label">Cantidad ordenada:<span class="rojo">*</span></label>
                <input type="text" id="ProP_Cantidad" autocomplete="off" class="form-control" required>
              </div>
            <?php } ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarfecha();</script> 
<script type="text/javascript">cargarhora();</script> 
