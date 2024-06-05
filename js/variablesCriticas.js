$(document).ready(function(e) {
  
  d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
  d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
  d_area = $("#filtroVariablesCriticas_Area").val();
  d_operario = $("#filtroVariablesCriticas_Operario").val();
  d_alerta = $("#filtroVariablesCriticas_Alerta").val();
  d_planta = $("#filtroVariablesCriticas_Planta").val();
  d_turnos = $("#filtroVariablesCriticas_Turnos").val();
  d_sino = $("#filtroVariablesCriticas_SiNo").val();

  $.ajax({
    type:"POST",
    url:"f_variablesCriticasListar.php",
    beforeSend: function() {
      $(".info_cargarVariablesCriticas").html(loader());
    },
    data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
    success: function(data) {
      $(".info_cargarVariablesCriticas").html(data);
      $("#tbl_VariablesCriticas").tablesorter(); 
      $('#tbl_VariablesCriticas').DataTable();
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
 
   $("body").on("click", ".Btn_OpcionesPuestosVariablesCriticas", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $(".Btn_OpcionesPuestosVariablesCriticas").removeClass("ColSelOptOpeUni");
    
    $.ajax({
      type:"POST",
      url:"fm_variablesCriticas.php",
      beforeSend: function() {
        $(".info_PanelVariableCriticasP").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".OpcPanUnicoSelSup"+d_codigo).addClass("ColSelOptOpeUni");
        $(".info_PanelVariableCriticasP").html(data);
        
        $('#filtroVariablesCriticas_Area').multiselect({ 
            includeSelectAllOption: true, 
            enableFiltering: true, 
            selectAllText: 'Seleccionar Todos', 
            nonSelectedText: 'Seleccione...', 
            nSelectedText: ' Todos', 
            buttonWidth: '100%', 
            enableCaseInsensitiveFiltering: true, 
            maxHeight: 300, 
            dropUp: true 
        });

        $('#filtroVariablesCriticas_Operario').multiselect({ 
            includeSelectAllOption: true, 
            enableFiltering: true, 
            selectAllText: 'Seleccionar Todos', 
            nonSelectedText: 'Seleccione...', 
            nSelectedText: ' Todos', 
            buttonWidth: '100%', 
            enableCaseInsensitiveFiltering: true, 
            maxHeight: 300, 
            dropUp: true 
        });

        $('#filtroVariablesCriticas_Planta').multiselect({ 
            includeSelectAllOption: true, 
            enableFiltering: true, 
            selectAllText: 'Seleccionar Todos', 
            nonSelectedText: 'Seleccione...', 
            nSelectedText: ' Todos', 
            buttonWidth: '100%', 
            enableCaseInsensitiveFiltering: true, 
            maxHeight: 300, 
            dropUp: true 
        }); 
        
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_VariablesCriticasBuscar", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
    d_horaInicial = $("#filtroVariablesCriticas_HoraInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
    d_horaFinal = $("#filtroVariablesCriticas_HoraFinal").val();
    d_area = $("#filtroVariablesCriticas_Area").val();
    d_operario = $("#filtroVariablesCriticas_Operario").val();
    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
    d_planta = $("#filtroVariablesCriticas_Planta").val();
    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
    d_sino = $("#filtroVariablesCriticas_SiNo").val();
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasListar.php",
      beforeSend: function() {
        $(".info_cargarVariablesCriticas").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino, horaInicial: d_horaInicial, horaFinal: d_horaFinal },
      success: function(data) {
        $(".info_cargarVariablesCriticas").html(data);
        $("#tbl_VariablesCriticas").tablesorter(); 
        $('#tbl_VariablesCriticas').DataTable();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
//  $("body").on("change", "#filtroVariablesCriticas_FechaInicial", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  });
  
//  $("body").on("change", "#filtroVariablesCriticas_Planta", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//        $.ajax({
//          type:"POST",
//          url:"f_cargarTurnosVariablesCriticas.php",
//          beforeSend: function() {
//            $(".e_cargarTurnos").html(loader());
//          },
//          data:{ planta: d_planta },
//          success: function(data) {
//            $(".e_cargarTurnos").html(data);
//          },
//          error: function(er1, er2, er3) {
//            console.log(er2+"-"+er3);
//          }
//        });
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  }); 
  
//  $("body").on("change", "#filtroVariablesCriticas_Turnos", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, sino: d_sino },
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  });
  
//  $("body").on("change", "#filtroVariablesCriticas_FechaFinal", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  }); 
  
//  $("body").on("change", "#filtroVariablesCriticas_Area", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino},
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  });  
  
//  $("body").on("change", "#filtroVariablesCriticas_Operario", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  });
  
//  $("body").on("change", "#filtroVariablesCriticas_Alerta", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  });
  
//  $("body").on("change", "#filtroVariablesCriticas_SiNo", function(e){
//    e.preventDefault();
//    
//    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
//    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
//    d_area = $("#filtroVariablesCriticas_Area").val();
//    d_operario = $("#filtroVariablesCriticas_Operario").val();
//    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
//    d_planta = $("#filtroVariablesCriticas_Planta").val();
//    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
//    d_sino = $("#filtroVariablesCriticas_SiNo").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesCriticasListar.php",
//      beforeSend: function() {
//        $(".info_cargarVariablesCriticas").html(loader());
//      },
//      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
//      success: function(data) {
//        $(".info_cargarVariablesCriticas").html(data);
//		$("#tbl_VariablesCriticas").tablesorter(); 
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  });
  
  
  $("body").on("click", ".e_cargarPAC", function(e){
    e.preventDefault();
    
    d_codigoPlaA = $(this).attr("data-cod");
     $("#vtn_VariablesCriticasCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasPAC.php",
      beforeSend: function() {
        $(".info_VariablesCriticasCrear").html(loader());
      },
      data:{ codigoPlaA: d_codigoPlaA },
      success: function(data) {
        $(".info_VariablesCriticasCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_variablescriticasPACCrear", function(e){
    e.preventDefault();
    
    d_observacion = $("#f_variablescriticasPACCrear #PlaA_ObservacionesSupervisor"). val();
    d_prioridad = $("#f_variablescriticasPACCrear #PlaA_Prioridad"). val();
    d_codigo = $("#f_variablescriticasPACCrear #PlaA_CodigoVC"). val();
    d_supervisor = $("#f_variablescriticasPACCrear #PlaA_Supervisor"). val();
    
    $.ajax({
      type:"POST",
      url:"op_variablesCriticasPACCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_variablescriticasPACCrear");
        $("#Btn_VariablesCriticasCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_variablescriticasPACCrear");
        $("#Btn_VariablesCriticasCrearForm").show();
      },
      data: { observacion: d_observacion, prioridad: d_prioridad, codigo: d_codigo, supervisor: d_supervisor },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_VariablesCriticasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_VariablesCriticasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_VariablesCriticasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_VariablesCriticasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_VariablesCriticasNotificacionesActualizar", function(e){
    e.preventDefault();
    
    $("#vtn_VariablesCriticasNotificacionesActualizar").modal('hide');
    $("#vtn_VariablesCriticasCrear").modal('hide');
    
    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
    d_area = $("#filtroVariablesCriticas_Area").val();
    d_operario = $("#filtroVariablesCriticas_Operario").val();
    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
    d_planta = $("#filtroVariablesCriticas_Planta").val();
    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
    d_sino = $("#filtroVariablesCriticas_SiNo").val();
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasListar.php",
      beforeSend: function() {
        $(".info_cargarVariablesCriticas").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, operario: d_operario, alerta: d_alerta, planta: d_planta, turno: d_turnos, siNo: d_sino },
      success: function(data) {
        $(".info_cargarVariablesCriticas").html(data);
		$("#tbl_VariablesCriticas").tablesorter(); 
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  
//  $("#b_excelVariablesCriticasBoton").click(function (event) {
//    $("#input_resultadoVariablesCriticas").val($("<div>").append($("#tbl_VariablesCriticas").eq(0).clone()).html());
//    $("#f_consultaVariablesCriticas").submit();
//  });
  
    $("body").on("click", "#b_excelVariablesCriticasBoton", function(e){
    
    d_fechaInicial = $("#filtroVariablesCriticas_FechaInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticas_FechaFinal").val();
    d_area = $("#filtroVariablesCriticas_Area").val();
    d_operario = $("#filtroVariablesCriticas_Operario").val();
    d_alerta = $("#filtroVariablesCriticas_Alerta").val();
    d_planta = $("#filtroVariablesCriticas_Planta").val();
    d_turnos = $("#filtroVariablesCriticas_Turnos").val();
    d_sino = $("#filtroVariablesCriticas_SiNo").val();
    d_horaInicial = $("#filtroVariablesCriticas_HoraInicial").val();
    d_horaFinal = $("#filtroVariablesCriticas_HoraFinal").val();
      
    $("#vtn_DescargaExcel").modal({
      backdrop: 'static'
    });
      
    $(".info_DescargaExcel").html(loader()+'<br><h3>Iniciando descarga de Excel</h3><br><div class="alert alert-danger"> <strong><span class="letra14">Advertencia:</span> La descarga continuará incluso si se cierra esta ventana emergente. Por favor, evitar recargar la página hasta asegurar que se ha completado la descarga..</strong> </div>');
      
    window.location.href = "e1.php?fechaInicial="+d_fechaInicial+"&fechaFinal="+d_fechaFinal+"&operario="+d_operario+"&alerta="+d_alerta+"&planta="+d_planta+"&turno="+d_turnos+"&siNo="+d_sino+"&horaInicial="+d_horaInicial+"&horaFinal="+d_horaFinal+"&area="+base64_encode(d_area);
    
    d_tiempo = $("#tiempo_ejecucion").val();
    if(d_tiempo!=0 && d_tiempo!=''){
       $(".info_DescargaExcel").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>El excel se está descargando, <br> validar el progreso <br> en el navegador</h3><br><div class="alert alert-danger"> <strong><span class="letra14">Advertencia:</span> La descarga continuará incluso si se cierra esta ventana emergente. Por favor, evitar recargar la página hasta asegurar que se ha completado la descarga..</strong> </div>');   
    }
  });
  
  $("body").on("click", "#b_excelVariablesCriticasFrecuencias", function(e){
    e.preventDefault();
    d_codigo = $(this).attr('data-cod');
    
//    $.ajax({
//      type:"POST",
//      url:"excel_exportarVariablesFrecuencia.php",
//      beforeSend: function() {
//        $(".e_cargarVariablesExcel").html(loader());
//      },
//      data:{ codigoPlanta: d_codigo },
//      success: function(data) {
//        $(".e_cargarVariablesExcel").html(data);   
//        $(".e_cargarVariablesExcel").hide(); 
//        
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
    
    window.location.href = "excel_exportarVariablesFrecuencia.php?codigoPlanta=" + d_codigo;
  });
  
  $("body").on("click", "#b_excelParametrosVariablesCriticasFrecuencias", function(e){
    e.preventDefault();
    d_codigo = $(this).attr('data-cod');
    window.location.href = "excel_exportarParametrosVariablesFrecuencia.php?codigoPlanta=" + d_codigo;
  });   
  
  $("body").on("click", "#b_excelVariablesControlCriticasFrecuencias", function(e){
    e.preventDefault();
    d_codigo = $(this).attr('data-cod');
    window.location.href = "excel_exportarVariablesControlFrecuencia.php?codigoPlanta=" + d_codigo;
  });   
  
  $("body").on("click", "#b_excelVariablesCalidadCriticasFrecuencias", function(e){
    e.preventDefault();
    d_codigo = $(this).attr('data-cod');
    window.location.href = "excel_exportarVariablesCalidadFrecuencia.php?codigoPlanta=" + d_codigo;
  }); 
  
  $("body").on("click", "#Btn_frecuenciaVariables", function(e){
    e.preventDefault();
    
      $("#vtn_FrecuenciasVariables").modal({
        backdrop: 'static'
      });
    
      $.ajax({
        type:"POST",
        url:"f_frecuenciasVariblesExcel.php",
        beforeSend: function() {
          $(".info_FrecuenciasVariables").html(loader());
        },
        data:{  },
        success: function(data) {
          $(".info_FrecuenciasVariables").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
  
  });
  
});

function base64_encode (stringToEncode) { 
    if (typeof window !== 'undefined') {
      if (typeof window.btoa !== 'undefined') {
        return window.btoa(unescape(encodeURIComponent(stringToEncode)))
      }
    } else {
      return new Buffer(stringToEncode).toString('base64')
    }
    var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/='
    var o1
    var o2
    var o3
    var h1
    var h2
    var h3
    var h4
    var bits
    var i = 0
    var ac = 0
    var enc = ''
    var tmpArr = []
    if (!stringToEncode) {
      return stringToEncode
    }
    stringToEncode = unescape(encodeURIComponent(stringToEncode))
    do {
      // pack three octets into four hexets
      o1 = stringToEncode.charCodeAt(i++)
      o2 = stringToEncode.charCodeAt(i++)
      o3 = stringToEncode.charCodeAt(i++)
      bits = o1 << 16 | o2 << 8 | o3
      h1 = bits >> 18 & 0x3f
      h2 = bits >> 12 & 0x3f
      h3 = bits >> 6 & 0x3f
      h4 = bits & 0x3f
      // use hexets to index into b64, and append result to encoded string
      tmpArr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4)
    } while (i < stringToEncode.length)
    enc = tmpArr.join('')
    var r = stringToEncode.length % 3
    return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3)
  }