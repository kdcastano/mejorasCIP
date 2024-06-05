<?php include("op_sesion.php");
include("../class/historial_ficha_tecnica.php");

$his = new historial_ficha_tecnica();
$resHis = $his->buscarPDFVersion($_POST['familia'],$_POST['color'], $_POST['formato']);
?>
<div class="visible-lg visible-md">
  <embed src="../files/ficha_tecnicaPDF/<?php echo $resHis[1]; ?>" type="application/pdf" width="100%" height="600px" />
</div>
<div class="visible-sm visible-xs">
  <script>
    window.location.assign("https://cipmejoras.qualiticsolution.com/files/ficha_tecnicaPDF/<?php echo $resHis[1]; ?>")
  </script>
</div>