<?php
function PasarAMPMaMilitar($hora){
	$nuevahora = strtotime($hora);
	$nuevahora = date("H:i:s", $nuevahora);
	return $nuevahora;
}

function PasarMilitaraAMPM($hora){
	$nuevahora = strtotime($hora);
	$nuevahora = date("g:i a", $nuevahora);
	return $nuevahora;
}
?>