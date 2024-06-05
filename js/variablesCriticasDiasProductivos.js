$(document).ready(function(e) {
  
    $('#filtroVariablesCriticasDP_Area').multiselect({ 
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

    $('#filtroVariablesCriticasDP_Familia').multiselect({ 
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
  

  $('#filtroVariablesCriticasDP_Operario').multiselect({ 
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
  
  $('#filtroVariablesCriticasDP_Planta').multiselect({ 
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
 
  d_fechaInicial = $("#filtroVariablesCriticasDP_FechaInicial").val();
  d_fechaFinal = $("#filtroVariablesCriticasDP_FechaFinal").val();
  d_area = $("#filtroVariablesCriticasDP_Area").val();
  d_planta = $("#filtroVariablesCriticasDP_Planta").val();
  d_familia = $("#filtroVariablesCriticasDP_Familia").val();
  d_codigoAgrupacion = $("#codigoAgrupacionVCP").val();
  $.ajax({
    type:"POST",
    url:"f_variablesCriticasDiasPListar.php",
    beforeSend: function() {
      $(".info_cargarListarVariablesDP").html(loader());
    },
    data:{fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, planta: d_planta, familia: d_familia, codigo: d_codigoAgrupacion},
    success: function(data) {
      $(".info_cargarListarVariablesDP").html(data);
      $.ajax({
        type:"POST",
        url:"f_cargarTurnosVariablesCriticas.php",
        beforeSend: function() {
          $(".e_cargarTurnosVariablesCriticasDP").html(loader());
        },
        data:{ planta: d_planta },
        success: function(data) {
          $(".e_cargarTurnosVariablesCriticasDP").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  $("body").on("change", "#filtroVariablesCriticasDP_FechaInicial", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroVariablesCriticasDP_FechaInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticasDP_FechaFinal").val();
    d_area = $("#filtroVariablesCriticasDP_Area").val();
    d_planta = $("#filtroVariablesCriticasDP_Planta").val();
    d_familia = $("#filtroVariablesCriticasDP_Familia").val();
    d_codigoAgrupacion = $("#codigoAgrupacionVCP").val();
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasDiasPListar.php",
      beforeSend: function() {
        $(".info_cargarListarVariablesDP").html(loader());
      },
      data:{fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, planta: d_planta, familia: d_familia, codigo: d_codigoAgrupacion},
      success: function(data) {
        $(".info_cargarListarVariablesDP").html(data);
        $.ajax({
          type:"POST",
          url:"f_cargarTurnosVariablesCriticas.php",
          beforeSend: function() {
            $(".e_cargarTurnosVariablesCriticasDP").html(loader());
          },
          data:{ planta: d_planta },
          success: function(data) {
            $(".e_cargarTurnosVariablesCriticasDP").html(data);
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#filtroVariablesCriticasDP_FechaFinal", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroVariablesCriticasDP_FechaInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticasDP_FechaFinal").val();
    d_area = $("#filtroVariablesCriticasDP_Area").val();
    d_planta = $("#filtroVariablesCriticasDP_Planta").val();
    d_familia = $("#filtroVariablesCriticasDP_Familia").val();
    d_codigoAgrupacion = $("#codigoAgrupacionVCP").val();
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasDiasPListar.php",
      beforeSend: function() {
        $(".info_cargarListarVariablesDP").html(loader());
      },
      data:{fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, planta: d_planta, familia: d_familia, codigo: d_codigoAgrupacion},
      success: function(data) {
        $(".info_cargarListarVariablesDP").html(data);
        $.ajax({
          type:"POST",
          url:"f_cargarTurnosVariablesCriticas.php",
          beforeSend: function() {
            $(".e_cargarTurnosVariablesCriticasDP").html(loader());
          },
          data:{ planta: d_planta },
          success: function(data) {
            $(".e_cargarTurnosVariablesCriticasDP").html(data);
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#filtroVariablesCriticasDP_Area", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroVariablesCriticasDP_FechaInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticasDP_FechaFinal").val();
    d_area = $("#filtroVariablesCriticasDP_Area").val();
    d_planta = $("#filtroVariablesCriticasDP_Planta").val();
    d_familia = $("#filtroVariablesCriticasDP_Familia").val();
    d_codigoAgrupacion = $("#codigoAgrupacionVCP").val();
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasDiasPListar.php",
      beforeSend: function() {
        $(".info_cargarListarVariablesDP").html(loader());
      },
      data:{fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, planta: d_planta, familia: d_familia, codigo: d_codigoAgrupacion},
      success: function(data) {
        $(".info_cargarListarVariablesDP").html(data);
        $.ajax({
          type:"POST",
          url:"f_cargarTurnosVariablesCriticas.php",
          beforeSend: function() {
            $(".e_cargarTurnosVariablesCriticasDP").html(loader());
          },
          data:{ planta: d_planta },
          success: function(data) {
            $(".e_cargarTurnosVariablesCriticasDP").html(data);
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#filtroVariablesCriticasDP_Planta", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroVariablesCriticasDP_FechaInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticasDP_FechaFinal").val();
    d_area = $("#filtroVariablesCriticasDP_Area").val();
    d_planta = $("#filtroVariablesCriticasDP_Planta").val();
    d_familia = $("#filtroVariablesCriticasDP_Familia").val();
    d_codigoAgrupacion = $("#codigoAgrupacionVCP").val();
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasDiasPListar.php",
      beforeSend: function() {
        $(".info_cargarListarVariablesDP").html(loader());
      },
      data:{fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, planta: d_planta, familia: d_familia, codigo: d_codigoAgrupacion},
      success: function(data) {
        $(".info_cargarListarVariablesDP").html(data);
        $.ajax({
          type:"POST",
          url:"f_cargarTurnosVariablesCriticas.php",
          beforeSend: function() {
            $(".e_cargarTurnosVariablesCriticasDP").html(loader());
          },
          data:{ planta: d_planta },
          success: function(data) {
            $(".e_cargarTurnosVariablesCriticasDP").html(data);
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#filtroVariablesCriticasDP_Familia", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroVariablesCriticasDP_FechaInicial").val();
    d_fechaFinal = $("#filtroVariablesCriticasDP_FechaFinal").val();
    d_area = $("#filtroVariablesCriticasDP_Area").val();
    d_planta = $("#filtroVariablesCriticasDP_Planta").val();
    d_familia = $("#filtroVariablesCriticasDP_Familia").val();
    d_codigoAgrupacion = $("#codigoAgrupacionVCP").val();
    
    $.ajax({
      type:"POST",
      url:"f_variablesCriticasDiasPListar.php",
      beforeSend: function() {
        $(".info_cargarListarVariablesDP").html(loader());
      },
      data:{fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, area: d_area, planta: d_planta, familia: d_familia, codigo: d_codigoAgrupacion},
      success: function(data) {
        $(".info_cargarListarVariablesDP").html(data);
        $.ajax({
          type:"POST",
          url:"f_cargarTurnosVariablesCriticas.php",
          beforeSend: function() {
            $(".e_cargarTurnosVariablesCriticasDP").html(loader());
          },
          data:{ planta: d_planta },
          success: function(data) {
            $(".e_cargarTurnosVariablesCriticasDP").html(data);
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("#b_excelVariablesCriticasDiasPBoton").click(function (event) {
    $("#input_resultadoVariablesCriticasDiasP").val($("<div>").append($("#tbl_variablesCriticasDiasP").eq(0).clone()).html());
    $("#f_consultaVariablesCriticasDiasP").submit();
  });
  
   $("body").on("click", ".Btn_OpcionesPuestosVariablesCriticas", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $(".Btn_OpcionesPuestosVariablesCriticas").removeClass("ColSelOptOpeUni");
    
    $.ajax({
      type:"POST",
      url:"fm_variablesCriticasDiasP.php",
      beforeSend: function() {
        $(".info_PanelVariableCriticasDPP").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".OpcPanUnicoSelSup"+d_codigo).addClass("ColSelOptOpeUni");
        $(".info_PanelVariableCriticasDPP").html(data);
        $('#filtroVariablesCriticasDP_Area').multiselect({ 
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
  
        $('#filtroVariablesCriticasDP_Familia').multiselect({ 
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


});