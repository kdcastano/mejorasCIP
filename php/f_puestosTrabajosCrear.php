<?php
include( "op_sesion.php" );
include( "../class/estaciones.php" );
include( "../class/puestos_trabajos.php" );
include( "../class/estaciones_maquinas.php" );
include( "../class/estaciones_areas.php" );
include( "../class/puestos_trabajos_estaciones_maquinas.php" );

$est = new estaciones();
$est->setEst_Codigo( $_POST[ 'codigo' ] );
$est->consultar();

$pueT = new puestos_trabajos();
$resPueT = $pueT->listarEstacionesPuestosTrabajo( $_POST[ 'codigo' ], $_SESSION[ 'CP_Usuario' ] );

$estM = new estaciones_maquinas();
$resEstMaq = $estM->listarMaquinasEstacionesMaquinas( $_POST[ 'codigo' ], $_SESSION[ 'CP_Usuario' ] );

$pueTEM = new puestos_trabajos_estaciones_maquinas();

$areA = new estaciones_areas();
$resAreE = $areA->listarAreasEstacionesPuestosTrabajo( $_POST[ 'codigo' ] );
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Estación: <?php echo $est->getEst_Nombre(); ?></strong> </div>
      <div class="panel-body">
        <div class="col-lg-4 col-md-4">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading"> <strong>Crear Puesto</strong> </div>
                <div class="panel-body">
                  <form id="f_puestosTrabajosCrear" role="form">
                    <input type="hidden" id="PueT_Est_Codigo" value="<?php echo $_POST['codigo']; ?>">
                    <div class="form-group">
                      <label class="control-label">Equipo:<span class="rojo">*</span></label>
                      <select id="PueT_EstA_Codigo" class="form-control" required>
                        <option></option>
                        <?php foreach($resAreE as $registro5){ ?>
                        <option value="<?php echo $registro5[0]; ?>"><?php echo $registro5[1]; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Estaciones de captura de datos:<span class="rojo">*</span></label>
                      <input type="text" id="PueT_Nombre" class="form-control" maxlength="50" required autocomplete="off">
                    </div>
                    <div align="center"> <br>
                      <button type="submit" id="Btn_PuestosTrabajosCrearForm" class="btn btn-warning Btn_Notificaciones">Crear</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading"> <strong>Asignar Máquinas</strong> </div>
                <div class="panel-body">
                  <form id="f_puestosTrabajosMaquinasCrear" role="form">
                    <div class="form-group">
                      <label class="control-label">Puesto:<span class="rojo">*</span></label>
                      <select id="PueTEM_PueT_Codigo" class="form-control" required>
                        <option></option>
                        <?php foreach($resPueT as $registro2){ ?>
                        <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Máquina:<span class="rojo">*</span></label>
                      <select id="PueTEM_EstM_Codigo" class="form-control" multiple required>
                        <?php foreach($resEstMaq as $registro3){ ?>
                        <option value="<?php echo $registro3[0]; ?>"><?php echo $registro3[3]; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div align="center"> <br>
                      <button type="submit" id="Btn_PuestosTrabajosMaquinasCrearForm" class="btn btn-warning Btn_Notificaciones">Asignar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-8">
          <?php
          foreach ( $resPueT as $registro ) {
            $resPueTEM = $pueTEM->listarPuestrosTrabajosEstacionesMaquinasAsignadas( $_POST[ 'codigo' ], $_SESSION[ 'CP_Usuario' ], $registro[ 0 ] );
            ?>
          <div class="col-lg-12 col-md-12">
            <div class="panel panel-primary">
              <div class="panel-heading"> <strong>Puesto de Trabajo: <?php echo $registro[1]; ?></strong> </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <thead>
                      <tr class="encabezadoTab">
                        <th align="center" class="text-center">PLANTA</th>
                        <th align="center" class="text-center">EQUIPO</th>
                        <th align="center" class="text-center">MÁQUINA</th>
                        <th align="center" class="text-center"></th>
                      </tr>
                    </thead>
                    <tbody class="buscar">
                      <?php foreach($resPueTEM as $registro4){ ?>
                      <tr>
                        <td><?php echo $registro4[2]; ?></td>
                        <td><?php echo $registro4[3]; ?></td>
                        <td><?php echo $registro4[4]; ?></td>
                        <td align="center" class="vertical"><span class="glyphicon glyphicon-remove rojo manito e_puestrosTrabajosMaquinasAsignadasEliminar" title="Eliminar" data-cod="<?php echo $registro4[0]; ?>"></span></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <div align="right">
                  <button class="btn btn-warning  e_puestoTrabajosEditar" data-cod="<?php echo $registro[0]; ?>">Editar Puesto Trabajo</button>
                  <button class="btn btn-danger Btn_Notificaciones e_puestoTrabajosEliminar" data-cod="<?php echo $registro[0]; ?>">Eliminar Puesto Trabajo</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
