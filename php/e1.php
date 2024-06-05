<?php
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=variablesCriticas.csv");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php $tiempo_inicial = microtime(true); ?>
<?php
include("../class/respuestas.php");
include("../class/turnos.php");
include("../class/vacios_respuestas.php");
include("c_hora.php");
include("funciones_especiales.php");
 
$fechaHoraInicial = $_GET['fechaInicial']." ".PasarAMPMaMilitar($_GET['horaInicial']);
$fechaHoraFinal = $_GET['fechaFinal']." ".PasarAMPMaMilitar($_GET['horaFinal']);
 
$vac = new vacios_respuestas();
$resVac = $vac->buscarComentariosVacios($_GET['fechaInicial'], $_GET['fechaFinal'], $fechaHoraInicial, $fechaHoraFinal);
 
foreach($resVac as $registro2){
  //maquina, PP, estU, fecha, hora
  $observacionVacios[$registro2[0]][$registro2[1]][$registro2[2]][$registro2[3]][$registro2[4]] = $registro2[5];
}
 
if ($_GET['turno'] != "") {
    $tur = new turnos();
    $tur->setTur_Codigo($_GET['turno']);
    $tur->consultar();
}
 
$areafiltro = base64_decode($_REQUEST['area']);
 
if($areafiltro != ""){
  $cadenaArea = $areafiltro; 
  $separadorArea = ","; 
  $separadaArea = explode($separadorArea, $cadenaArea); 
}else{
  $separadaArea = "";
}
 
if ($_GET['operario'] != "null") {
    $cadenaOperario = $_GET['operario'];
    $separadorOperario = ",";
    $separadaOperario = explode($separadorOperario, $cadenaOperario);
} else {
    $separadaOperario = "";
}
 
$res = new respuestas();
 
// Establecer el tamaño del lote
$tamanoLote = 150000; // Puedes ajustar este valor según sea necesario
 
// Generar el contenido CSV
$output = fopen('php://output', 'w');
 
// Encabezados
fputcsv($output, array('PRIORIDAD','ALERTA','FORMATO','FAMILIA','COLOR','FECHA DE TOMA','HORA MEDICION','HORA TOMA','MAQUINA','VARIABLE','VALOR ESPECIFICACION','VALOR OPERADOR','VALOR TOLERANCIA','MEDIDA','OBSERVACION PARO','USUARIO OPERADOR','OBSERVACION OPERADOR','USUARIO SUPERVISOR','OBSERVACION SUPERVISOR'), ';');
 
 
// Iterar sobre las páginas
$pagina = 1;
while ($registros = $res->listarVariablesCriticasPaginado($_GET['fechaInicial'], $_GET['fechaFinal'], $separadaArea, $separadaOperario, $_GET['alerta'], $_GET['planta'], $_GET['turno'], $tur->getTur_HoraInicio(), $tur->getTur_HoraFin(), $_GET['siNo'], $fechaHoraInicial, $fechaHoraFinal, $pagina)) {
    // Procesar y escribir en lotes
    foreach ($registros as $registro) {
        $obser = $observacionVacios[$registro[20]][$registro[21]][$registro[22]][$registro[8]][$registro[9]];
        if($registro[3] == 1){
          $val = "SI";
        }else{
          $val = "NO";
        }
        if($registro[20]==4){
          if($registro[15] == "1"){
            $valorMedida = "SI";
          }else{
            if($registro[15] == "2"){
              $ColValCenterLine = "";
              $valorMedida = "SIN USO";
            }else{
              if($registro[15] == "3"){
                $ColValCenterLine = "";
                $valorMedida = "PARO";
              }else{
                $valorMedida = "NO";
              }
            }
          }
        }else{
          $valorMedida2 = "";
          if($registro[21] == "1"){
            $ColValCenterLine = "";
            $valorMedida2 = "PARO";
          }
        }
        if($registro[20]==4){
          $valMedida1 = $valorMedida;
        }else {
          if($valorMedida2 != ""){
            $valMedida1 = $valorMedida2;
          }else{
            $valMedida1 = $registro[15];
          }
        }
        $data = array(
            $registro[2], $val, $registro[4], $registro[5], $registro[6], $registro[7], $registro[8], $registro[9], eliminar_caracteres($registro[10]), eliminar_caracteres($registro[11]), $registro[12], $registro[13], $registro[14], $valMedida1, eliminar_caracteres($obser), $registro[17], eliminar_caracteres($registro[16]), $registro[19], eliminar_caracteres($registro[18])
        );
 
        // Añadir datos al archivo CSV
        fputcsv($output, $data, ';');
    }
 
    // Flush y ob_flush después de cada lote para liberar memoria
//    flush();
//    ob_flush();
 
    // Incrementar la página para la siguiente iteración
    $pagina++;
}
 
fclose($output);
exit;
?>
<?php
$tiempo_final = microtime(true);
$tiempo_ejecucion = $tiempo_final - $tiempo_inicial;
?>
<input type="hidden" id="tiempo_ejecucion" value="<?php echo $tiempo_ejecucion; ?>">