<?php
include( "op_sesion.php" );
include( "../class/plantas.php" );
include( "../class/calidad.php" );
include( "../class/areas.php" );
include("../class/frecuencias_calidad.php");
include( "../class/turnos.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$cal = new calidad();
$cal->setCal_Codigo($_POST['codigo']);
$cal->consultar();

$are = new areas();
$are->setAre_Codigo($cal->getAre_Codigo());
$are->consultar();

$resArea = $are->listarAreasPlantaTipo($are->getPla_Codigo(),"1",$_SESSION[ 'CP_Usuario' ], "6"); 

$fre = new frecuencias_calidad();
$resFre = $fre->listarFrecuencias($_POST['codigo']);
$resFre2 = $fre->listarFrecuenciasEstadoActivoInactivo($_POST['codigo']);

foreach($resFre as $registro3){
  $vecFrecuencia[$registro3[2]][$registro3[3]] = $registro3[3];
}

foreach($resFre2 as $registro4){
  $vecCodigo[$registro4[2]][$registro4[3]] = $registro4[0];
  $vecFrecuenciaActualiza[$registro4[2]][$registro4[3]] = $registro4[3];
}

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $are->getPla_Codigo(), "1", $_SESSION[ 'CP_Usuario' ] );

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Calidad - Actualizar</strong> </div>
      <div class="panel-body">
        <form id="f_calidadActualizar" role="form" data-cod="<?php echo $_POST['codigo']; ?>">
          <input type="hidden" id="Cal_CodigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta: <span class="rojo">*</span></label>
            <select id="Cal_PlantaAct" class="form-control" required>
              <option value=""></option>
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $are->getPla_Codigo() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group e_cargarAreaActualizar">
            <label class="control-label">Maquina de clasificación: <span class="rojo">*</span></label>
            <select id="Are_CodigoAct" class="form-control" required>
              <?php foreach($resArea as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php echo $cal->getAre_Codigo() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Cal_NombreAct" class="form-control" maxlength="60" value="<?php echo $cal->getCal_Nombre(); ?>">
          </div>
          <div class="form-group">
            <label class="control-label">Calidad objetivo:<span class="rojo">*</span></label>
            <input type="text" id="Cal_ValorCriticoAct" class="form-control" value="<?php echo $cal->getCal_ValorCritico(); ?>" required>
          </div>
          <div class="form-group">
            <label class="control-label">Tolerancia:<span class="rojo">*</span></label>
            <input type="text" id="Cal_ToleranciaAct" class="form-control" value="<?php echo $cal->getCal_Tolerancia(); ?>" required>
          </div>
          <div class="form-group">
              <label class="control-label">Operador:</label>
              <select id="Cal_OperadorAct" class="form-control" required>
                <option value="1"  <?php echo $cal->getCal_Operador()=="1"?"selected":""; ?>> >= </option>
                <option value="2" <?php echo $cal->getCal_Operador()=="2"?"selected":""; ?>> <= </option>
                <option value="3" <?php echo $cal->getCal_Operador()=="3"?"selected":""; ?>> +- </option>
              </select>
            </div>
          <div class="form-group">
            <label class="control-label">Toma de defectos:<span class="rojo">*</span></label>
            <select id="Cal_TomaDefectosAct" class="form-control" required>              
              <option value="1" <?php echo $cal->getCal_TomaDefectos() == "1" ? "selected":""; ?>>Primera</option>
              <option value="2" <?php echo $cal->getCal_TomaDefectos() == "2" ? "selected":""; ?>>Segunda</option>
              <option value="3" <?php echo $cal->getCal_TomaDefectos() == "3" ? "selected":""; ?>>Rotura</option>
              <option value="5" <?php echo $cal->getCal_TomaDefectos() == "5" ? "selected":""; ?>>Segunda Planar</option>
              <option value="6" <?php echo $cal->getCal_TomaDefectos() == "6" ? "selected":""; ?>>Segunda Liner</option>
              <option value="7" <?php echo $cal->getCal_TomaDefectos() == "7" ? "selected":""; ?>>Retal Planar</option>
              <option value="8" <?php echo $cal->getCal_TomaDefectos() == "8" ? "selected":""; ?>>Retal liner</option>
              <option value="4" <?php echo $cal->getCal_TomaDefectos() == "4" ? "selected":""; ?>>No aplica</option>
            </select>
          </div>
          <div class="form-group">
              <label class="control-label">Ordenamiento:<span class="rojo">*</span></label>
              <input type="text" id="Cal_OrdenamientoAct" class="form-control" maxlength="" value="<?php echo $cal->getCal_Ordenamiento(); ?>">
          </div>
          <div class="form-group">
            <label class="control-label">Agrupador suma:<span class="rojo">*</span></label>
            <select id="Cal_AgrupadorSumaAct" class="form-control" required>
              <option value=""></option>
              <option value="3" <?php echo $cal->getCal_AgrupadorSuma() == "3" ? "selected":""; ?>>Primera</option>
              <option value="2" <?php echo $cal->getCal_AgrupadorSuma() == "2" ? "selected":""; ?>>Rotura Clasificada</option>
              <option value="1" <?php echo $cal->getCal_AgrupadorSuma() == "1" ? "selected":""; ?>>Segunda Global</option>              
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> 
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-2 col-md-2 col-sm-2">
              <strong>Turnos</strong> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6"> </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
              <div align="right">
                Seleccionar Todos&nbsp;&nbsp;<input type="checkbox" class="Int_SeleccionTodosCalidadAct">&nbsp;&nbsp;
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="table-responsive" id="imp_tabla">
          <?php
          $a = 0;
          foreach ( $resTur as $registro2 ) {
            ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading text-center"> <strong><?php echo $registro2[2]; ?></strong> </div>
                <div class="panel-body">
                  <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <tbody class="buscar">
                      <tr>
                        <?php
                        $HoraInicial = date( "Y-m-d H:i", strtotime( $registro2[ 3 ] ) );
                        $HoraFinal = date( "Y-m-d H:i", strtotime( $registro2[ 4 ] . " - 1 hour" ) );
                        if ( $HoraInicial > $HoraFinal ) {
                          $HoraFinal = date( "Y-m-d H:i", strtotime( $registro2[ 4 ] . " + 1 days". " - 1 hour" ) );
                        }
                        ?>
                        <?php
                        $T = 0;
                        for ( $i = $HoraInicial; $i <= $HoraFinal; $i = date( "Y-m-d H:i", strtotime( $i . " + 1 hour" ) ) ) {
                          ?>
                        <td align="center" class="text-center"><?php echo date("H:i", strtotime($i)); ?></td>
                        <?php if($T >= 14){ exit(); } $T++; } ?>
                      </tr>
                      <tr>
                        <?php for($i = $HoraInicial; $i <= $HoraFinal; $i = date("Y-m-d H:i", strtotime($i ." + 1 hour"))){ ?>
                          <td align="center" class="text-center"><input type="checkbox" id="Inp_ValAct<?php echo $a; ?>" value="1" class="Inp_TurnosSelAct" data-num="<?php echo $a; ?>" data-tur="<?php echo $registro2[0]; ?>" data-hor="<?php echo date("H:i:s", strtotime($i)); ?>" data-acc="<?php if($vecFrecuenciaActualiza[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo "Act"; }else{ echo "Crear"; } ?>" data-codfre="<?php if($vecFrecuenciaActualiza[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo $vecCodigo[$registro2[0]][date("H:i:s", strtotime($i))]; }else{ echo "-1"; } ?>" <?php if($vecFrecuencia[$registro2[0]][date("H:i:s", strtotime($i))] == date("H:i:s", strtotime($i))){ echo "checked"; } ?>></td>
                        <?php $a++; } ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
