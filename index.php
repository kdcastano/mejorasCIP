<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CONTROL PROCESO</title>
<!-- jQuery -->
<script src="ext/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="ext/bootstrap/bootstrap.min.js"></script>
<link href="ext/bootstrap/bootstrap.min.css" rel="stylesheet">
<!-- propios -->
<link rel="stylesheet" type="text/css" href="css/estilo_admin.css?v=5">
  <!--Icono-->
<link rel="shortcut icon" type="image/x-icon" href="./imagenes/icon.png" />
  
<style>
.input-group-addon{
  font-size: 35px;
}
</style>
</head>
  
</head>
<body class="fondoPrinpal">
  <?php /*?><img src="imagenes/fondoPrincipal2.jpg" width="100%"><?php */?>

  <div class="container-fluid">
    <div class="fondo2">
      <form role="form" method="post" action="https://cipmejoras.qualiticsolution.com/php/op_usuarioValidarSesion.php" name="formu">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="usuario" type="text" class="form-control inicio" name="usuario" placeholder="Usuario" autocomplete="off" autofocus>
        </div>
        <br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input id="clave" type="password" class="form-control inicio" name="clave" placeholder="Contraseña" autocomplete="off">
        </div>
        <br>
        <div align="center">
          <button type="submit" class="btn sesion">Iniciar</button>
        </div>
        <br>
      </form>
			<br>
			<div align="center">
        <a href="http://aplicaciones.sanlorenzo.com.co/">
          <button class="btn sesion">Volver</button>
        </a>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">
  </div>
  <div class="limpiar"></div>
  <br>
  <br>
  <?php if(isset($_GET['mot']) && $_GET['mot'] == "2"){ ?>
    <div class="rojo letra18">Usuario no válido</div>
  <?php } ?>
  <?php if(isset($_GET['mot']) && $_GET['mot'] == "1"){ ?>
    <div class="rojo letra18">Se encuentra fuera del horario de acceso o no se encuentra Activo</div>
  <?php } ?>
  <?php if(isset($_GET['mot']) && $_GET['mot'] == "3"){ ?>
    <div class="rojo letra18">Debe inciar sesión</div>
  <?php } ?>
  <div class="limpiar"></div>
</div>
</body>
</html>