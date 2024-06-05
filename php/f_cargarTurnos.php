<?php
include( "op_sesion.php" );
include( "../class/turnos.php" );

$tur = new turnos();
$resTur = $tur->listarTurnosPrincipalPlanta( $_POST[ 'planta' ], "1", $_SESSION[ 'CP_Usuario' ] );
?>
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
              Seleccionar Todos&nbsp;&nbsp;<input type="checkbox" class="Int_SeleccionTodos">&nbsp;&nbsp;
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
                      <td align="center" class="text-center"><input type="checkbox" id="Inp_ValCrear<?php echo $a; ?>" value="1" class="Inp_TurnosSel" data-num="<?php echo $a; ?>" data-tur="<?php echo $registro2[0]; ?>" data-hor="<?php echo date("H:i:s", strtotime($i)); ?>"></td>
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
