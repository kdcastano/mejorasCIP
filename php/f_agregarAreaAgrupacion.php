<?php
include( "op_sesion.php" );
include( "../class/areas.php" );
include( "../class/agrupaciones.php" );
include( "../class/agrupaciones_areas.php" );

$agr = new agrupaciones();
$agr->setAgr_Codigo( $_POST[ 'codigo' ] );
$agr->consultar();

$are = new areas();
$resAre = $are->listarAreasPlanta( $_POST['planta'] ,  "1", $_SESSION[ 'CP_Usuario' ] );

$agrA = new agrupaciones_areas();
$resAgrA = $agrA->areasAgrupacionListar( $_POST[ 'codigo' ] );

foreach ( $resAgrA as $registro ) {
  $vecArea[ $registro[ 2 ] ] = $registro[ 2 ];
}

?>


<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Agregar equipo - agrupación: <?php echo $agr->getAgr_Nombre() ?></strong> </div>
      <div class="panel-body">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading"> <strong>Asignar Equipo</strong> </div>
                  <div class="panel-body">
                    <input type="hidden" id="codigoAgrupacion" value="<?php echo $_POST['codigo']; ?>">
                    <div class="form-group">
                      <label class="control-label">Equipo: <span class="rojo">*</span></label>
                      <select id="agrupaciones_AreaAgregar" class="form-control" multiple="multiple">
						  <?php foreach($resAre as $registro){ ?>
                        <?php if(!isset($vecArea[$registro[0]])){ ?>
                        <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                    <br>
                    <div align="center">
                      <button class="btn btn-primary btn-md e_crearAreaAgrupacion text-center" data-cod="<?php echo $_POST['codigo']; ?>">Crear</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 info_ListarAreasAgregadasAgrupacion"> </div>
        </div>
      </div>
    </div>
  </div>
</div>
