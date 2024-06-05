<?php include("op.sesion.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/usuarios.js"></script>
</head>
<body>
<?php include("s_menu.php"); ?>
<div id="d_contenedor" class="container">
	<br><br>
	<div class="row">
		<div class="col-lg-3 col-md-3">
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong class="letra16">Cambiar mi clave</strong>
				</div>

				<div class="panel-body">
				  <form id="f_cambiarClave" role="form">
						<div class="form-group">
							<label for="clave_actual" class="control-label">Clave Actual</label>
							<input type="password" class="form-control" id="clave_actual" maxlength="100" required>
						</div>
						<div class="form-group">
							<label for="clave" class="control-label">Clave</label>
							<input type="password" class="form-control" id="clave" maxlength="100" required>
						</div>
						<div id="c_clave" class="form-group">
							<label for="clave2" class="control-label">Repetir Clave</label>
							<input type="password" class="form-control" id="clave2" maxlength="100" required>
							<span id="m_clave2"></span>
						</div>
						<br>
						<div align="center">
							<button type="submit" class="btn btn-success">Cambiar Clave</button>
						</div>
					</form>
					<div id="d_mensajeCambioClave"></div>
				</div>
			</div>
		</div>
	</div>
  
  <!-- Notificaciones -->
  <div id="vtn_CambiarClaveNotificaciones" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body info_CambiarClaveNotificaciones" align="center">
        </div>
        <div class="modal-footer">
          <button type="button" id="Btn_CambiarClaveNotificaciones" class="btn btn-success">Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  
</div>
</body>
</html>