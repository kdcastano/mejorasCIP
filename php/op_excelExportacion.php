<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$_POST['nombre'].".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style type="text/css">
  .RojoCenterLine{
    background-color: #E86868 !important;
    color: black !important;
    font-weight: bold;
  }
  .AmarilloCenterLine{
    background-color: #E8E868 !important;
    color: black !important;
    font-weight: bold;
  }
  .VerdeCenterLine{
    background-color: #68C090 !important;
    color: black !important;
    font-weight: bold;
  }
   .Col_PorEje_Verde{
    background-color: green !important;
    font-weight: bold;
  }
  .Col_PorEje_Amarillo{
    background-color: yellow !important;
    font-weight: bold;
  }
  .Col_PorEje_Rojo{
    background-color: brown !important;
    font-weight: bold;
  }
  .encabezadoTab{
    font-weight: bold;
    background-color: #646464 !important;
    color: #FFFFFF !important;
  }
</style>
</head>
<body>
<h1 align="center"><?php echo $_POST['nombre']; ?></h1>

<?php echo str_replace('\\"', '"', $_POST['resultado']); ?>
<?php if($_POST['resultado1']){ ?> <h1 align="center"><?php echo $_POST['nombre1']; ?></h1> <?php echo str_replace('\\"', '"', $_POST['resultado1']);} ?>
<?php if($_POST['resultado2']){ ?> <h1 align="center"><?php echo $_POST['nombre2']; ?></h1> <?php echo str_replace('\\"', '"', $_POST['resultado2']);} ?>
</body>