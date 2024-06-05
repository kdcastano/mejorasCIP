<?php
include("op_sesion.php");
include("../class/historial_ficha_tecnica.php");

$his = new historial_ficha_tecnica();
$resHis = $his->buscarPDFVersion($_POST['familia'],$_POST['color'], $_POST['formato']);
?>
    <script>
	  window.open("https://cipmejoras.qualiticsolution.com/files/ficha_tecnicaPDF/<?php echo $resHis[1]; ?>");
	</script>
<div align="center">
	<a href="https://cipmejoras.qualiticsolution.com/files/ficha_tecnicaPDF/<?php echo $resHis[1]; ?>" target="_blank"><button class="btn btn-danger Btn_Notificaciones">Ver Ficha Técnica</button>
</div>