<?php
include( "op_sesion.php" );
include( "../class/agrupaciones_maquinas.php" );
include( "../class/detalle_ficha_tecnica.php" );
include_once("../class/usuarios.php");
include( "../class/historial_ficha_tecnica.php" );
include( "../class/ft_pdf_observaciones.php" );

$his = new historial_ficha_tecnica();
$resHis = $his->listarHistorialFTN($_POST['codigo']);

foreach($resHis as $registro2){
  $vecHistorial[$registro2[1]] = $registro2[1]; 
}

$agrM = new agrupaciones_maquinas();
$resAgrM = $agrM->listarAgrupacionesMaquinasTipo($_POST['tipo'],$_POST['planta']);

$det = new detalle_ficha_tecnica();
$resDet = $det->buscarAgrMCreados($_POST['codigo'], $_POST['tipo']);

foreach($resDet as $registro2){
  $vecAgrupaciones[$registro2[0]] = $registro2[0];
}

$pFichaTecnica = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "33" );

$ftp = new ft_pdf_observaciones();
$resFtp = $ftp->listarObservacionTipo($_POST['codigo']);
foreach($resFtp as $registro3){
  $observacion[$registro3[1]][$registro3[2]] = $registro3[3];
  $CodObservacion[$registro3[1]][$registro3[2]] = $registro3[0];
}

?>

<br>
<?php if($pFichaTecnica[4] == "1"){ ?>
  <div class="col-lg-12 col-md-12 col-sm-12">
    <div class="col-lg-4 col-md-4 col-sm-4">
      <div class="form-group">
        <label class="control-label">Agrupación:</label>
        <select id="<?php echo "fichaTecnica_Agrupacion".$_POST['tipo']; ?>" class="form-control" multiple>
          <?php foreach($resAgrM as $registro){ ?>
            <option value="<?php echo $registro[0]; ?>" <?php if($vecAgrupaciones[$registro[0]] == $registro[0]){ echo "selected";}else{ if($vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} } ?><?php  ?>><?php echo $registro[1]; ?></option>
          <?php } ?>
        </select>
      </div>         
    </div>
    <div class="col-lg-1 col-md-1"> <br>
      <button id="Btn_FichaTecnicaNCrearAgrupacion<?php echo $_POST['tipo']; ?>" class="btn btn-info" data-tip = "<?php echo $_POST['tipo']; ?>" data-cod = "<?php echo $_POST['codigo']; ?>" data-pla = "<?php echo $_POST['planta']; ?>" data-for = "<?php echo $_POST['formato']; ?>">Crear / Refrescar</button>
    </div>            
  </div>
<div class=" col-lg-12 col-md-12 col-sm-12 cargar_AgrupacionTipo<?php echo $_POST['tipo'];?>"></div>
<div class="col-lg-6 col-md-6 col-sm-6">
  <div class="form-group">
      <label class="control-label">Observación:</label>
      <textarea id="ft_pdf_Observaciones<?php echo $_POST['tipo'];?>" class="form-control" autocomplete="off" style="resize:none;" ><?php if($observacion[$_POST['codigo']][$_POST['tipo']]  != ""){ echo $observacion[$_POST['codigo']][$_POST['tipo']]; } ?></textarea><br>
  </div>
</div>
<div class="col-lg-2 col-md-2 col-sm-2"><br><br>
  <button class="btn btn-success btn-xs e_guardarObservacion<?php echo $_POST['tipo'];?>" data-cod="<?php echo $_POST['codigo']; ?>" data-tip = "<?php echo $_POST['tipo']; ?>" data-codObs="<?php echo $CodObservacion[$_POST['codigo']][$_POST['tipo']]; ?>" <?php if($vecHistorial[$_POST['codigo']] == $_POST['codigo']){ echo "disabled";} ?>>Guardar Obs.</button>
</div>


<?php } ?>
<script>
  $(document).ready(function(e) {
    $('#Btn_FichaTecnicaNCrearAgrupacion<?php echo $_POST['tipo']; ?>').click();
  });
</script>