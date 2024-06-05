<?php include("op_sesion.php");
include("../class/formulas_moliendas_archivo.php");

$forArchivo = new formulas_moliendas_archivo();
$versionConsulta = $forArchivo->buscarUltimaVersion($_POST['formulaMolienda']);
$resForArchivo = $forArchivo->buscarArchivoVersion($_POST['formulaMolienda'],$versionConsulta[0]);

?>
<?php if($resForArchivo[1] != ""){ ?>
  <br>
  <a href="http://192.168.1.170/files/formulas_molienda/<?php echo $resForArchivo[1]; ?>" target="_blank"><img src="../imagenes/pdf.png" width="32px" class="manito" title="ver receta"></a>
<?php }else{ ?>
  <br>
  <div class="alert alert-danger"> Sin receta </div>
<?php } ?>
