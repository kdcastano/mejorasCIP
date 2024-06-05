<?php
if($_POST['exp_tipo'] == '1'){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_POST['exp_nombre']).".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style type="text/css">
	table td, table, table th {
		border: solid 1px #000000;
		padding: 0px;
		margin: 0px;
	}
	.amarillo{
		background-color: rgba(161,166,0,0.5);
	}
	.azul{
		background-color: rgba(12,0,166,0.5);
	}
	.rojo{
		background-color: rgba(166,0,0,0.5);
	}
	.cafe{
		background-color: rgba(117,92,72,1.5);
	}
	.blanco{
		background-color: rgba(233,231,229,1.5);
	}
	.verde{
		background-color: rgba(49,127,67,1.5);
	}
	.gris{
		background-color: rgba(130,137,143,1.5);
	}
	.naranja{
		background-color: rgba(216,75,32,1.5);
	}
	.AzulClaro{
		background-color: rgba(59,131,189,1.5);
	}
	.violeta{
			background-color: rgba(140,86,138,1.5)
	}
</style>
</head>
<body>
<h1 align="center"><?php echo $_POST['exp_nombre']; ?></h1>
<?php
if($_POST['exp_parametros'] != ""){
	$lparametros = explode (";", $_POST['exp_parametros']);
	?>
<table border="1" cellspacing="0" cellpadding="0">
  <?php for($i=0; $i<count($lparametros); $i+=2){	?>
  <tr>
    <th align="left"><?php echo $lparametros[$i]; ?>:</th>
    <td><?php echo $lparametros[$i+1]; ?></td>
  </tr>
<?php } ?>
</table><br>
<?php } ?>
<?php echo str_replace('\\"', '"', $_POST['exp_informacion']); ?>
<?php if($_POST['exp_tipo'] == '2'){ ?>
<script>window.print();</script>
<?php } ?>
</body>
</html>