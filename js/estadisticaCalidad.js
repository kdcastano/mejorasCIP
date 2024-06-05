$(document).ready(function(e) {
  $('#filtroEstadisticaCalidad_Area').multiselect({ 
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
  
  $('#filtroEstadisticaCalidad_Producto').multiselect({ 
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
  
  $('#filtroEstadisticaCalidad_Usuarios').multiselect({ 
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
  
  $('#filtroEstadisticaCalidad_Producto').multiselect({ 
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
  
  
 $("body").on("click", "#Btn_EstadisticaCalidadBuscar", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroEstadisticaCalidad_FechaInicial").val();
    d_fechaFinal = $("#filtroEstadisticaCalidad_FechaFinal").val();
    d_turnos = $("#filtroEstadisticaCalidad_Turnos").val();
    d_area = $("#filtroEstadisticaCalidad_Area").val();
    d_producto = $("#filtroEstadisticaCalidad_Producto").val();
    d_usuarios = $("#filtroEstadisticaCalidad_Usuarios").val();
    d_agrupacion = $("#filtroEstadisticaCalidad_Agrupación").val();
    d_horaI = $("#filtroEstadisticaCalidad_HoraInicial").val();
    d_horaF = $("#filtroEstadisticaCalidad_HoraFinal").val();
   
    if(d_producto != null){
      $.ajax({
        type:"POST",
        url:"f_estadisticaCalidadListar.php",
        beforeSend: function() {
          $(".info_estadisticaCalidadListar").html(loader());
        },
        data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, turnos: d_turnos, area: d_area, producto: d_producto, usuario: d_usuarios, agrupacion: d_agrupacion, horaI: d_horaI, horaF: d_horaF },
        success: function(data) {
          $(".info_estadisticaCalidadListar").html(data);
          $("#tbl_porcentajeCalidadPrincipal").tablesorter();
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".info_estadisticaCalidadListar").html('<div class="alert alert-danger"> <strong>Por favor seleccione un producto</strong> </div>');
    }    
  });
  
  $("body").on("change", "#filtroEstadisticaCalidad_FechaInicial", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroEstadisticaCalidad_FechaInicial").val();
    d_fechaFinal = $("#filtroEstadisticaCalidad_FechaFinal").val();
    d_area = $("#filtroEstadisticaCalidad_Area").val();    
    d_horaI = $("#filtroEstadisticaCalidad_HoraInicial").val();
    d_horaF = $("#filtroEstadisticaCalidad_HoraFinal").val();
    
    $.ajax({
      type:"POST",
      url:"f_estadisticaCalidadFiltroRefenciasFechas.php",
      beforeSend: function() {
        $(".fm_ProductoCalidadFiltroFecha").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, horaI: d_horaI, horaF: d_horaF  },
      success: function(data) {
        $(".fm_ProductoCalidadFiltroFecha").html(data);
        $('#filtroEstadisticaCalidad_Producto').multiselect({ 
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
    
  $("body").on("change", "#filtroEstadisticaCalidad_FechaFinal", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroEstadisticaCalidad_FechaInicial").val();
    d_fechaFinal = $("#filtroEstadisticaCalidad_FechaFinal").val();        
    d_horaI = $("#filtroEstadisticaCalidad_HoraInicial").val();
    d_horaF = $("#filtroEstadisticaCalidad_HoraFinal").val();
    
    $.ajax({
      type:"POST",
      url:"f_estadisticaCalidadFiltroRefenciasFechas.php",
      beforeSend: function() {
        $(".fm_ProductoCalidadFiltroFecha").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, horaI: d_horaI, horaF: d_horaF },
      success: function(data) {
        $(".fm_ProductoCalidadFiltroFecha").html(data);
        $('#filtroEstadisticaCalidad_Producto').multiselect({ 
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
  
  $("body").on("click", ".e_cargarDetalleGraficogeneral", function(e){
    e.preventDefault();
    
    d_encabezado = $(this).attr("data-enc");
    d_contador = $(this).attr("data-cont");
    
    d_agrupacion = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-agr");
    d_formato = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-for");
    d_formatoNombre = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-forNom");
    d_familia = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-fam");
    d_color = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-col");
    d_area = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-are");
    d_fechaIniT3 = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-fecI");
    d_fechaFinT3 = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-fecF");
    d_HoraInicialRespT = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-horI");
    d_HoraFinalRespT = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-horF");
    d_HoraInicialRespT2 = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-horI2");
    d_HoraFinalRespT2 = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-horF2");
    d_valEspTurnoR = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-tur");
    d_HoraInicial = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-horI3");
    d_HoraFinal = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-horF3");
    d_usuario = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-usu");
    d_turnoR = $(".e_cargarDetalleGrafico"+d_encabezado+d_contador).attr("data-turR");
    
    $("#vtn_EstadisticaDetallesGrafico").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_estadisticaCalidadDetalle.php",
      beforeSend: function() {
        $(".info_EstadisticaDetallesGrafico").html(loader());
      },
      data:{ 
        encabezado: d_encabezado,
        agrupacion: d_agrupacion,
        formato: d_formato,
        formatoNombre: d_formatoNombre,
        familia: d_familia,
        color: d_color,
        area: d_area,
        fechaIniT3 : d_fechaIniT3,
        fechaFinT3:d_fechaFinT3 ,
        HoraInicialRespT:d_HoraInicialRespT ,
        HoraFinalRespT:d_HoraFinalRespT ,
        HoraInicialRespT2: d_HoraInicialRespT2,
        HoraFinalRespT2: d_HoraFinalRespT2 ,
        valEspTurnoR: d_valEspTurnoR,
        HoraInicial: d_HoraInicial,
        HoraFinal: d_HoraFinal,
        usuario: d_usuario,
        turnoR: d_turnoR
      },
      success: function(data) {
        $(".info_EstadisticaDetallesGrafico").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("#b_excelPorcentajeCalidadBoton").click(function (event) {
    $("#input_resultadoPorcentajeCalidad").val($("<div>").append($("#tbl_porcentajeCalidadPrincipal").eq(0).clone()).html());
    $("#input_resultadoPorcentajeCalidadSegunda").val($("<div>").append($("#tbl_porcentajeCalidadSegunda").eq(0).clone()).html());
    $("#input_resultadoPorcentajeCalidadRotura").val($("<div>").append($("#tbl_porcentajeCalidadRotura").eq(0).clone()).html());
    $("#f_consultaPorcentajeCalidad").submit();
  });


});