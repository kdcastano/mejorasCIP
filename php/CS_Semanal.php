<?php
date_default_timezone_set('America/Bogota');
set_time_limit(0);

$fecha = date('YmdHis');
$ruta = "../files/Copias_Seguridad/";


date_default_timezone_set('America/Bogota');
set_time_limit(0);

$nombrearchivo = $ruta.$fecha.".sql";
shell_exec(sprintf('mysqldump --host=localhost --user=root --password=gZ3CvVvos4Es7vIQ bd_controlproceso > %s', $nombrearchivo));
?>