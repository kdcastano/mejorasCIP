<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );
include( "../class/maquinas.php" );
include( "../class/detalle_ficha_tecnica.php" );
include( "../class/configuracion_ficha_tecnica.php" );

$det = new detalle_ficha_tecnica();
$det->setDetFT_Codigo( $_POST[ 'codDFT' ] );
$det->consultar();

$conf = new configuracion_ficha_tecnica();
$conf->setConFT_Codigo( $det->getConFT_Codigo() );
$conf->consultar();

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuario( $_SESSION[ 'CP_Usuario' ], '1' );

$maq = new maquinas();
$resMaq = $maq->filtroMaquinasArea( $_POST[ 'codArea' ], $_SESSION[ 'CP_Usuario' ] );

$cont = 0;
foreach ( $resMaq as $registro2 ) {
  $vectMaquina[ $cont ] = $registro2[ 0 ];
  $cont++;
}

?>
<!--CREAR-->
<?php if($_POST['codDFT'] == '-1'){ ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Área: <?php echo $_POST['area']."<br>"."Variable: ".$_POST['variable']; ?></strong> </div>
      <div class="panel-body">
        <form id="f_InfoDetalleFichaTecnicaCrear" role="form">
          <input type="hidden" id="DFT_Codigo" value="<?php echo $_POST['codDFT']; ?>">
          <input type="hidden" id="FicT_Codigo" value="<?php echo $_POST['codigoFT']; ?>">
          <input type="hidden" id="ConFT_Codigo" value="<?php echo $_POST['codigoConfigFT']; ?>">
          <?php if(isset($_POST['maquina'])){ ?>
            <input type="hidden" id="Maq_Codigo" value="<?php echo $_POST['maquina']; ?>">
          <?php }else{ ?>
            <input type="hidden" id="Maq_Codigo" value="<?php echo $vectMaquina[0]; ?>">
          <?php } ?>
          <input type="hidden" id="Pla_Codigo" value="<?php echo $_POST['planta']; ?>">
          <input type="hidden" id="For_Codigo" value="<?php echo $_POST['formato']; ?>">
          <input type="hidden" id="tipo" value="<?php echo $_POST['tipo']; ?>">
          <div class="form-group">
            <label class="control-label">Tipo: <span class="rojo">*</span></label>
            <select id="DFT_Tipo" class="form-control" required>
              <option></option>
              <option value="1">Texto</option>
              <option value="2">Numérico Entero</option>
              <option value="3">Numérico Decimal</option>
              <option value="4">Si/No</option>
            </select>
          </div>
          <div class="e_cargarTipoFTD"></div>
          <br>
          <div align="center" class="text-center">
            <button type="submit" class="btn btn-primary" id="Btn_InfoDetalleFichaTecnicaCrearForm">Crear</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } else{ ?>
<!--ACTUALIZAR-->
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Área: <?php echo $_POST['area']."<br>"."Variable: ".$_POST['variable']; ?></strong> </div>
      <div class="panel-body">
        <form id="f_InfoDetalleFichaTecnicaActualizar" role="form">
          <input type="hidden" id="DFT_CodigoAct" value="<?php echo $_POST['codDFT']; ?>">
          <input type="hidden" id="codDFT" value="<?php echo $_POST['codDFT']; ?>">
          <input type="hidden" id="FicT_CodigoAct" value="<?php echo $_POST['codigoFT']; ?>">
          <input type="hidden" id="Pla_CodigoAct" value="<?php echo $_POST['planta']; ?>">
          <input type="hidden" id="For_CodigoAct" value="<?php echo $_POST['formato']; ?>">
          <input type="hidden" id="tipoAct" value="<?php echo $_POST['tipo']; ?>">
          <div class="form-group">
            <label class="control-label">Tipo: <span class="rojo">*</span></label>
            <select id="DFT_TipoAct" class="form-control" required>
              <option value="1" <?php echo $det->getDetFT_Tipo() == '1' ? "selected":""; ?>>Texto</option>
              <option value="2" <?php echo $det->getDetFT_Tipo() == '2' ? "selected":""; ?>>Numérico Entero</option>
              <option value="3" <?php echo $det->getDetFT_Tipo() == '3' ? "selected":""; ?>>Numérico Decimal</option>
              <option value="4" <?php echo $det->getDetFT_Tipo() == '4' ? "selected":""; ?>>Si/No</option>
            </select>
          </div>
          <div class="e_cargarTipoFTDActualizar">
            <?php if($det->getDetFT_Tipo() == 1){
              $valorControl = "";
              if($det->getDetFT_Tipo() == 1){
                $valorControl = $det->getDetFT_ValorControlTexto();
              }else{
                $valorControl = $det->getDetFT_ValorControl();
              }
            ?>
            <div class="form-group">
              <label class="control-label">Valor control: <span class="rojo">*</span></label>
              <input type="text" id="DFT_ValorControlAct" class="form-control" value="<?php echo $valorControl; ?>"  required>
            </div>
            <?php } ?>
            <?php if($det->getDetFT_Tipo() == 2 || $det->getDetFT_Tipo() == 3){ ?>
            <div class="form-group">
              <label class="control-label">Unidad medida: <span class="rojo">*</span></label>
              <select id="DFT_UnidadMedidaAct" class="form-control" required>
                <?php foreach($resPar as $registro){ ?>
                <option value="<?php echo $registro[0]; ?>" <?php echo $det->getDetFT_UnidadMedida() == $registro[0] ? "selected":""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
              </select>
            </div>
            <?php 
            $valorControl = "";
            if($det->getDetFT_Tipo() == 1){
              $valorControl = $det->getDetFT_ValorControlTexto();
            }else{
              $valorControl = $det->getDetFT_ValorControl();
            }
          ?>
            <div class="form-group">
              <label class="control-label">Valor control: <span class="rojo">*</span></label>
              <input type="text" id="DFT_ValorControlAct" class="form-control" value="<?php echo $valorControl; ?>"  required>
            </div>
            <div class="form-group">
              <label class="control-label">Valor operador: <span class="rojo">*</span></label>
              <select id="DFT_OperadorAct" class="form-control"  required>
                <option value="1" <?php echo $det->getDetFT_Operador() == 1 ? "selected":""; ?>> >= </option>
                <option value="2" <?php echo $det->getDetFT_Operador() == 2 ? "selected":""; ?>> <= </option>
                <option value="3" <?php echo $det->getDetFT_Operador() == 3 ? "selected":""; ?>> +- </option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Valor tolerancia: <span class="rojo">*</span></label>
              <input type="text" id="DFT_ValorToleranciaAct" class="form-control" value="<?php echo $det->getDetFT_ValorTolerancia(); ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Toma de variables: <span class="rojo">*</span></label>
              <select id="DFT_TomaVariableAct" class="form-control" disabled required>
                <option value="1" <?php echo $det->getDetFT_TomaVariable() == 1 ? "selected":""; ?>>Si</option>
                <option value="0" <?php echo $det->getDetFT_TomaVariable() == 0 ? "selected":""; ?>>No</option>
              </select>
            </div>
            <?php } ?>
          </div>
          <br>
          <div align="center" class="text-center">
            <button type="submit" class="btn btn-warning" id="Btn_InfoDetalleFichaTecnicaActualizarForm">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>
