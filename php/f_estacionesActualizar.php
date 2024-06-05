<?php
include( "op_sesion.php" );
include( "../class/estaciones.php" );
include( "../class/estaciones_maquinas.php" );
include( "../class/estaciones_areas.php" );

$pEstaciones = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "16" );

$est = new estaciones();
$est->setEst_Codigo( $_POST[ 'codigo' ] );
$est->consultar();

$estMaq = new estaciones_maquinas();
$resEstMaq = $estMaq->listarMaquinasEstacionesMaquinas( $_POST[ 'codigo' ], $_SESSION[ 'CP_Usuario' ] );

$estA = new estaciones_areas();
$resAreEst = $estA->listarAreasEstacionesAreasEstaciones( $_POST[ 'codigo' ], $_SESSION[ 'CP_Usuario' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Estación: <?php echo $est->getEst_Nombre(); ?></strong> </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-3 col-md-3">
            <div class="panel panel-primary">
              <div class="panel-heading"> <strong>Cambiar Nombre</strong> </div>
              <div class="panel-body">
                <form id="f_estacionesActualizar" role="form">
                  <input type="hidden" id="Est_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
                  <div class="form-group">
                    <label class="control-label">Estaciones de captura de datos:<span class="rojo">*</span></label>
                    <input type="text" id="Est_NombreAct" value="<?php echo $est->getEst_Nombre(); ?>" class="form-control" maxlength="50" required autocomplete="off">
                  </div>
                  <br>
                  <?php if($pEstaciones[5] == 1){ ?>
                  <div align="center">
                    <button type="submit" id="Btn_EstacionesActualizarForm" class="btn btn-warning">Actualizar</button>
                  </div>
                  <?php } ?>
                </form>
              </div>
            </div>
            <br>
            <div align="center">
              <button id="Btn_EstacionesMaquinasCrear" class="btn btn-success Btn_Notificaciones" data-cod="<?php echo $_POST['codigo']; ?>">Agregar Máquina</button>
            </div>
          </div>
          <div class="col-lg-5 col-md-5">
            <div class="panel panel-primary">
              <div class="panel-heading"> <strong>Máquinas de la Estación</strong> </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table id="tbl_EstacionesMaquinas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <thead>
                      <tr class="encabezadoTab">
                        <th align="center" class="text-center">PLANTA</th>
                        <th align="center" class="text-center">EQUIPO</th>
                        <th align="center" class="text-center">MÁQUINA</th>
                        <th align="center" class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody class="buscar">
                      <?php foreach($resEstMaq as $registro){ ?>
                      <tr>
                        <td><?php echo $registro[1]; ?></td>
                        <td><?php echo $registro[2]; ?></td>
                        <td><?php echo $registro[3]; ?></td>
                        <td><span class="glyphicon glyphicon-remove rojo manito e_estacionesMaquinasEliminar" title="Eliminar" data-cod="<?php echo $registro[0]; ?>"></span></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="panel panel-primary">
              <div class="panel-heading"> <strong>Equipos</strong> </div>
              <div class="panel-body">
                <div align="center">
                  <button class="btn btn-danger Btn_Notificaciones Bnt_AgregarEstacionesAreasCrear" data-cod="<?php echo $_POST['codigo']; ?>">Agregar Equipo</button>
                </div>
                <div class="limpiar"></div>
                <br>
                <div class="table-responsive">
                  <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <thead>
                      <tr class="encabezadoTab">
                        <th align="center" class="text-center">PLANTA</th>
                        <th align="center" class="text-center">EQUIPO</th>
                        <th align="center" class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody class="buscar">
                      <?php foreach($resAreEst as $registro2){ ?>
                      <tr>
                        <td><?php echo $registro2[1]; ?></td>
                        <td><?php echo $registro2[2]; ?></td>                
                        <td  align="center" class="text-center"><span class="glyphicon glyphicon-remove rojo manito e_estacionesAreasEliminar" title="Eliminar" data-cod="<?php echo $registro2[0]; ?>"></span></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
