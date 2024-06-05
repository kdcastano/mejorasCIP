$(document).ready(function(e) {
  $('#filtroEstadistica_Area').multiselect({ 
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
  
  $('#filtroEstadistica_Maquina').multiselect({ 
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
  
  $('#filtroEstadistica_Producto').multiselect({ 
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
  
  $('#filtroEstadistica_Usuarios').multiselect({ 
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
  
    $('#filtroEstadistica_PuestoTrabajo').multiselect({ 
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
  
  $('#filtroREjecucionCumplimiento_Turno').multiselect({ 
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
  
   $("body").on("click", "#Btn_EstadisticaBuscar", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroEstadistica_FechaInicial").val();
    d_fechaFinal = $("#filtroEstadistica_FechaFinal").val();
    d_turnos = $("#filtroEstadistica_Turnos").val();
    d_area = $("#filtroEstadistica_Area").val();
    d_maquina = $("#filtroEstadistica_Maquina").val();
    d_producto = $("#filtroEstadistica_Producto").val();
    d_puestoTrabajo = $("#filtroEstadistica_PuestoTrabajo").val();
    d_usuarios = $("#filtroEstadistica_Usuarios").val();
    d_agrupacion = $("#filtroEstadistica_Agrupación").val();
	  
    if(d_producto != null){
      $.ajax({
        type:"POST",
        url:"f_estadistica.php",
        beforeSend: function() {
          $(".info_estadisticaListar").html(loader());
        },
        data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, turnos: d_turnos, area: d_area, maquina: d_maquina, producto: d_producto, puestoTrabajo: d_puestoTrabajo, usuario: d_usuarios, agrupacion: d_agrupacion },
        success: function(data) {
          $(".info_estadisticaListar").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".info_estadisticaListar").html('<div class="alert alert-danger"> <strong>Por favor seleccione un producto</strong> </div>');
    }
  });
  
  $("body").on("change", "#filtroEstadistica_FechaInicial", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroEstadistica_FechaInicial").val();
    d_fechaFinal = $("#filtroEstadistica_FechaFinal").val();
    d_planta = $("#codPlanta").val();
    
    $.ajax({
      type:"POST",
      url:"f_estadisticaFiltroRefenciasFechas.php",
      beforeSend: function() {
        $(".fm_ProductoFiltroFecha").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal:d_fechaFinal, planta: d_planta },
      success: function(data) {
        $(".fm_ProductoFiltroFecha").html(data);
        $('#filtroEstadistica_Producto').multiselect({ 
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
  
  $("body").on("change", "#filtroEstadistica_FechaFinal", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroEstadistica_FechaInicial").val();
    d_fechaFinal = $("#filtroEstadistica_FechaFinal").val();
    d_planta = $("#codPlanta").val();
    
    $.ajax({
      type:"POST",
      url:"f_estadisticaFiltroRefenciasFechas.php",
      beforeSend: function() {
        $(".fm_ProductoFiltroFecha").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal:d_fechaFinal, planta: d_planta },
      success: function(data) {
        $(".fm_ProductoFiltroFecha").html(data);
        $('#filtroEstadistica_Producto').multiselect({ 
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
  
  //Defectologia
  
  $('#filtroDefectologia_Area').multiselect({ 
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
  
  $('#filtroDefectologia_Producto').multiselect({ 
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
  
  $('#filtroDefectologia_Usuarios').multiselect({ 
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
  
  $("body").on("click", "#Btn_DefectologiaBuscar", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroDefectologia_FechaInicial").val();
    d_fechaFinal = $("#filtroDefectologia_FechaFinal").val();
    d_area = $("#filtroDefectologia_Area").val();
    d_producto = $("#filtroDefectologia_Producto").val();
    d_usuarios = $("#filtroDefectologia_Usuarios").val();
    d_turnos = $("#filtroDefectologia_Turnos").val();
    
    $.ajax({
      type:"POST",
      url:"f_estadisticaDefectologiaListar.php",
      beforeSend: function() {
        $(".info_DefectologiaListar").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, producto: d_producto, usuario: d_usuarios, turnos: d_turnos},
      success: function(data) {
        $(".info_DefectologiaListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("#b_excelGestionControlProcesoBoton").click(function (event) {
    $("#input_resultadoGestionControlProceso").val($("<div>").append($("#tbl_estadisticaGestionCP").eq(0).clone()).html());
    $("#f_consultaGestionControlProceso").submit();
  });
  
  $('#filtroREjecucionCumplimiento_Area').multiselect({ 
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
  
  $('#filtroREjecucionCumplimiento_PuestosTrabajo').multiselect({ 
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
  
  $("body").on("change", "#filtroREjecucionCumplimiento_Planta", function(e){
    $("#filtroREjecucionCumplimiento_TipoArea").val("-1");
    
    d_planta = $("#filtroREjecucionCumplimiento_Planta").val();
    d_tipo = $("#filtroREjecucionCumplimiento_TipoArea").val();
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoAreas.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosAreas").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosAreas").html(data);
        $('#filtroREjecucionCumplimiento_Area').multiselect({ 
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
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoPuestosTrabajo.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosPuestosTrabajo").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosPuestosTrabajo").html(data);
        $('#filtroREjecucionCumplimiento_PuestosTrabajo').multiselect({ 
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
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoTurnos.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosPuestosTrabajo").html(loader());
      },
      data:{ planta: d_planta },
      success: function(data) {
        $(".infoEjeCumpEst_datosTurnos").html(data);
        $('#filtroREjecucionCumplimiento_Turno').multiselect({ 
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
  
  $("body").on("change", "#filtroREjecucionCumplimiento_TipoArea", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroREjecucionCumplimiento_Planta").val();
    d_tipo = $("#filtroREjecucionCumplimiento_TipoArea").val();
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoAreas.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosAreas").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosAreas").html(data);
        $('#filtroREjecucionCumplimiento_Area').multiselect({ 
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
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoPuestosTrabajo.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosPuestosTrabajo").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosPuestosTrabajo").html(data);
        $('#filtroREjecucionCumplimiento_PuestosTrabajo').multiselect({ 
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
  
  $("body").on("click", ".Btn_CargarDatosEjecucionCumplimiento", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroREjecucionCumplimiento_FechaInicial").val();
    d_horaInicial = $("#filtroREjecucionCumplimiento_HoraInicial").val();
    d_fechaFinal = $("#filtroREjecucionCumplimiento_FechaFinal").val();
    d_horaFinal = $("#filtroREjecucionCumplimiento_HoraFinal").val();
    d_tipoArea = $("#filtroREjecucionCumplimiento_TipoArea").val();
    d_nombreArea = $("#filtroREjecucionCumplimiento_TipoArea :selected").attr("data-tipnom");
    d_areas = $("#filtroREjecucionCumplimiento_Area").val();
    d_puestosTrabajo = $("#filtroREjecucionCumplimiento_PuestosTrabajo").val();
    d_planta = $("#filtroREjecucionCumplimiento_Planta").val();
    
    d_turnos = $("#filtroREjecucionCumplimiento_Turno").val();
    
    if(d_planta != "-1"){
      $.ajax({
        type:"POST",
        url:"f_ejecucionCumplimientoListar.php",
        beforeSend: function() {
          $(".info_EjecucionCumplimientoListar").html(loader());
        },
        data:{ fechaInicial: d_fechaInicial, horaInicial: d_horaInicial, fechaFinal: d_fechaFinal, horaFinal: d_horaFinal, tipoArea: d_tipoArea, nombreArea: d_nombreArea, areas: d_areas, puestosTrabajo: d_puestosTrabajo, turnos: d_turnos },
        success: function(data) {
          $(".info_EjecucionCumplimientoListar").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });   
    }else{
      $(".info_EjecucionCumplimientoListar").html('<div class="limpiar"></div><div class="alert alert-danger"> <strong>Por favor seleccione una Planta</strong> </div>');
    }
  
  });
  
  $("#b_excelEjeCumBoton").click(function (event) {
    $("#input_resultadoEjeCum").val($("<div>").append($("#imp_tablaEjeCum").eq(0).clone()).html());
    $("#f_consultaEjeCum").submit();
  });


});