<?php
include_once( "op_sesion.php" );
include_once("../class/plantas.php");

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();

$pAreas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "14" );
//$pCanales = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "15" );
$pEstaciones = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "16" );
//$pFases = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "17" );
$pMaesPRo = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "18" );
$pMaquinas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "19" );
$pParametros = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "20" );
$pPermisos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "21" );
$pSAPProgramaP = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "22" );
$pPlantas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "23" );
$pTurnos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "24" );
$pUsuarios = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "25" );
$pFormatos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "26" );
$pSubmarcas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "27" );
$pTipoMercado = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "28" );
$pTipoParametrosV = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "29" );
$pUnidadesE = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "30" );
$pConfigFT = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "31" );
$pFormatosHornos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "32" );
$pFichaTecnica = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "33" );
$pAnalisisPP = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "34" );
$pProgramaP = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "35" );
$pAgrupaciones = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "36" );
$pFormatosAreas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "37" );
$pFormulasM = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "38" );
$pAgrupacionesConfFt = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "39" );
$pAgrupacionesMaq = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "40" );
$pVariables = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "41" );
$pPProdSupervisor = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "42" );
$pSemanas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "43" );
$pReferenciasEmergencias = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "44" );
$pvariablesCriticas = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "45" );
$pPanelSupervisor = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "46" );
$pVariablesCriticasDiasProductivos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "47" );
$pCalidad = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "48" );
$pBitacora = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "49" );
$pHealthCheck = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "50" );
$pPuestaPunto = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "51" );

$pInformeEjecucionCumpEstandar = $usuPerUsu->Permisos($_SESSION['CP_Usuario'], "57");
$pInformeEjecucionCumpCriticidad = $usuPerUsu->Permisos($_SESSION['CP_Usuario'], "58");
$pDescuentosTurnosOperaciones = $usuPerUsu->Permisos($_SESSION['CP_Usuario'], "59");
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="f_index.php"><img src="../imagenes/logo_blancolamosa.png" width="200px"></a></div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav navbar-right">
        <!--        <li><a href="f_index.php" class="letra18">Inicio</a></li>-->
        <?php if($pAgrupaciones[ 3 ] == 1 || $pPlantas[3] == 1 || $pAgrupacionesConfFt[3] == 1 || 
                $pAgrupacionesMaq[3] == 1 || $pAreas[3] == 1 || $pParametros[3] == 1 || $pMaquinas[3] == 1) { ?>
        <li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Distribución planta<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php if($pPlantas[3] == 1){?>
            <li class="disabled1"><a href="fm_plantas.php">Plantas</a></li>
            <?php
            }
            //if($pFases[3] == 1){?>
            <!--            <li class="disabled1"><a href="fm_fases.php">Fases</a></li>-->
            <?php // } if($pCanales[3] == 1){?>
            <!--            <li class="disabled1"><a href="fm_canales.php">Canales</a></li>-->
            <?php // }    ?>
            <?php // } 			  
            if ( $pAgrupaciones[ 3 ] == 1 ) {
              ?>
            <li class="disabled1"><a href="fm_agrupaciones.php">Configuración de reportes</a></li>
            <?php } if($pAgrupacionesConfFt[3] == 1){ ?>
            <li class="disabled1"><a href="fm_agrupacionesConfigft.php">Variables de control</a></li>
			  <?php } if($pAgrupacionesMaq[3] == 1){ ?>
            <li class="disabled1"><a href="fm_agrupacionesMaquinas.php">Operaciones de control</a></li>
            <?php } if($pAreas[3] == 1){ ?>
            <li class="disabled1"><a href="fm_areas.php">Equipos</a></li>
            <?php } if($pParametros[3] == 1){ ?>
            <li class="disabled1"><a href="fm_parametros.php">Parámetros</a></li>
            <?php } if($pSemanas[3] == 1) { ?>
            <li class="disabled1"><a href="fm_semanas.php">Semanas</a></li>
            <?php } if($pMaquinas[3] == 1){?>
            <li class="disabled1"><a href="fm_maquinas.php">Máquinas</a></li>
            <?php } if($pCalidad[3] == 1){ ?>
            <li class="disabled1"><a href="fm_calidad.php">Calidad</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } if($pMaesPRo[3] == 1 || $pFormatos[3] == 1 || $pFormatosAreas[3] == 1 || $pFormatosHornos[3] == 1 || $pFormulasM[3] == 1 || $pUnidadesE[3] == 1 || $pSubmarcas[3] == 1 || $pTipoMercado[3] == 1){?>
        <li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Atributos<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php if($pMaesPRo[3] == 1){?>
            <li class="disabled1"><a href="fm_referencias.php">Maestro de atributos</a></li>
            <?php } if($pFormatos[3] == 1){?>
            <li class="disabled1"><a href="fm_formatos.php">Formatos</a></li>
            <?php } if($pFormatosAreas[3] == 1){ ?>
            <li class="disabled1"><a href="fm_formatosAreas.php">Formatos Equipos</a></li>
            <?php } if($pFormatosHornos[3] == 1){ ?>
            <li class="disabled1"><a href="fm_formatosHornos.php">Formatos Prensas</a></li>
            <?php } if($pFormulasM[3] == 1){ ?>
            <li class="disabled1"><a href="fm_formulasMoliendas.php">Formulas Moliendas</a></li>
            <?php } if($pUnidadesE[3] == 1){?>
            <li class="disabled1"><a href="fm_unidadesEmpaque.php">Unidades de Empaque</a></li>
            <?php } if($pSubmarcas[3] == 1) {?>
              <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
                <li class="disabled1"><a href="fm_submarcas.php">Submarcas</a></li>
              <?php } ?>
            <?php } if($pTipoMercado[3] == 1) {?>
              <?php if($pla->getPla_VerMarcaSubMarca() == "1"){ ?>
                <li class="disabled1"><a href="fm_tipoMercado.php">Tipo de Mercado</a></li>
              <?php } ?>
            <?php } ?>
          </ul>
        </li>
        <?php } if($pVariables[3] == 1 || $pTipoParametrosV[3] == 1 || $pConfigFT[3] == 1 || $pFichaTecnica[3] == 1) { ?>
        <li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">FT-Variables<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php if($pVariables[3] == 1){ ?>
              <li class="disabled1"><a href="fm_variables.php">Variables</a></li>
            <?php } ?>
            <?php if($pTipoParametrosV[3] == 1){ ?>
            <li class="disabled1"><a href="fm_parametrosVariables.php">Parámetros Variables</a></li>
            <?php } if($pFichaTecnica[3] == 1){?>
            <?php /*?><li class="disabled1"><a href="fm_fichaTecnica.php">Ficha Técnica</a></li><?php */?>
            <li class="disabled1"><a href="fm_fichaTecnicaN.php">Ficha Técnica</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } if($pTurnos[3] == 1 || $pUsuarios[3] == 1 || $pEstaciones[3] == 1) { ?>
        <li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Estaciones y usuarios<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php if($pTurnos[3] == 1){?>
            <li class="disabled1"><a href="fm_turnos.php">Turnos</a></li>
            <?php } if($pUsuarios[3] == 1){?>
            <li class="disabled1"><a href="fm_usuarios.php">Usuarios</a></li>
            <?php } if($pEstaciones[3] == 1){?>
            <li class="disabled1"><a href="fm_estaciones.php">Estaciones</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } if($pSAPProgramaP[3] == 1 || $pAnalisisPP[3] == 1 || $pProgramaP[3] == 1 || $pPProdSupervisor[3] == 1 || $pPanelSupervisor[3] == 1 || $pvariablesCriticas[3] == 1 || $pBitacora[3] == 1 || $pHealthCheck[3] == 1){ ?>
        <li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Programa Producción<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php if($pSAPProgramaP[3] == 1){?>
            <li class="disabled1"><a href="fm_programaProduccion.php">SAP Programa Producción</a></li>
            <?php } if($pAnalisisPP[3] == 1){ ?>
            <li class="disabled1"><a href="fm_analisisProgramaProduccion.php">Análisis Programa Producción</a></li>
            <?php } if($pReferenciasEmergencias[3]==1){ ?>
            <li class="disabled1"><a href="fm_referenciasEmergencia.php">Producto no programados</a></li>
            <?php } if($pProgramaP[3] == 1){ ?>
            <li class="disabled1"><a href="fm_programaProduccionReal.php">Programa Producción</a></li>
            <?php } ?>
            <?php if($pPProdSupervisor[3] == 1){ ?>
              <li class="disabled1"><a href="fm_programaProduccionRealSupervisor.php">Programa Producción Supervisor</a></li> 
            <?php } if($pPuestaPunto[3] == 1){ ?>
              <li class="disabled1"><a href="fm_puestaPunto.php">Puesta punto</a></li>
            <?php } if($pvariablesCriticas[3] == 1){ ?>
               <li class="disabled1"><a href="fm_variablesCriticasPrincipal.php">Reporte listado de variables</a></li>
            <?php } if($pVariablesCriticasDiasProductivos[3] == 1){ ?>
             <li class="disabled1"><a href="fm_variablesCriticasDiasPPrincipal.php">Variables críticas días productivos</a></li>
            <?php } if($pPanelSupervisor[3] == 1){ ?>
              <li class="disabled1"><a href="fm_panelSupervisor.php">Tablero Supervisor</a></li>
            <?php } if($pBitacora[3] == 1){ ?>
              <li class="disabled1"><a href="fm_bitacoras.php">Bitácora</a></li>
            <?php } if($pHealthCheck[3] == 1){ ?>
              <li class="disabled1"><a href="fm_healthCheck.php">Health Check</a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
          <li class="dropdown letra18"><a href="#" class="dropdown-toggle letra18" data-toggle="dropdown" role="button" aria-expanded="false">Informes<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
				<?php if($_SESSION['CP_Usuario'] == "1" || $_SESSION['CP_Usuario'] == "5" || $_SESSION['CP_Usuario'] == "177" || $_SESSION['CP_Usuario'] == "168") { ?>
              		<li class="disabled1"><a href="fm_cierresAdmin.php">Cierre calidad</a></li>
				<?php } ?>
              <li class="disabled1"><a href="fm_estadistica.php">Gestión control proceso</a></li>
              <li class="disabled1"><a href="fm_estadisticaCalidad.php">Porcentaje de calidad</a></li>
              <?php if($pInformeEjecucionCumpEstandar[3] == 1){ ?>
                <li class="disabled1"><a href="fm_ejecucionCumplimiento.php">Ejecución y Cumplimiento Estándar</a></li>
              <?php } ?>
              <?php if($pInformeEjecucionCumpCriticidad[3] == 1){ ?>
                <li class="disabled1"><a href="fm_ejecucionCumplimientoCriticidad.php">Ejecución y Cumplimiento Criticidad</a></li>
              <?php } ?>
              <?php if($pDescuentosTurnosOperaciones[3] == 1){ ?>
                <li class="disabled1"><a href="fm_descuentosTurnosOperaciones.php">Descuentos Turnos Operación</a></li>
              <?php } ?>
            </ul>
          </li>
        
        <li class="dropdown letra18"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $usu->getUsu_Nombres()." ".$usu->getUsu_Apellidos(); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="fm_usuariosCambiarClave.php">Cambiar mi clave</a></li>
            <li class="divider"></li>
            <li><a href="op_cerrarSesion.php">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
