$(document).ready(function(e) {
  
    $('#filtroPuestaPunto_Referencia').multiselect({
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
  
   $('#filtroPuestaPunto_Canal').multiselect({
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
  
    $('#filtroPuestaPunto_Area').multiselect({
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
  
    d_fechaInicial = $("#filtroPuestaPunto_FechaI").val();
    d_fechaFinal = $("#filtroPuestaPunto_FechaF").val();
    d_estado = $("#filtroPuestaPunto_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_puestaPuntoListar.php",
      beforeSend: function() {
        $(".e_cargarPuestaPunto").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, estado: d_estado },
      success: function(data) {
        $(".e_cargarPuestaPunto").html(data);
        $("#tbl_PuestaPunto").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  $("body").on("click", "#Btn_PuestaPuntoBuscar", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroPuestaPunto_FechaI").val();
    d_fechaFinal = $("#filtroPuestaPunto_FechaF").val();
    d_estado = $("#filtroPuestaPunto_Estado").val();
    d_canal = $("#filtroPuestaPunto_Canal").val();
    d_area = $("#filtroPuestaPunto_Area").val();
    d_referencia = $("#filtroPuestaPunto_Referencia").val();
    
    $.ajax({
      type:"POST",
      url:"f_puestaPuntoListar.php",
      beforeSend: function() {
        $(".e_cargarPuestaPunto").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, estado: d_estado, canal: d_canal, area: d_area, referencia: d_referencia },
      success: function(data) {
        $(".e_cargarPuestaPunto").html(data);
        $("#tbl_PuestaPunto").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("change", "#filtroPuestaPunto_FechaI", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroPuestaPunto_FechaI").val();
    d_fechaFinal = $("#filtroPuestaPunto_FechaF").val();
    d_planta = $("#filtroPuestaPunto_Planta").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarPuestaPuntoCanal.php",
      beforeSend: function() {
        $(".e_cargarPPFiltroCanal").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, planta: d_planta },
      success: function(data) {
        $(".e_cargarPPFiltroCanal").html(data);
        
        $('#filtroPuestaPunto_Canal').multiselect({
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
        
        //Filtro Área
        $.ajax({
          type:"POST",
          url:"f_cargarPuestaPuntoArea.php",
          beforeSend: function() {
            $(".e_cargarPPFiltroArea").html(loader());
          },
          data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, planta: d_planta },
          success: function(data) {
            $(".e_cargarPPFiltroArea").html(data);
             $('#filtroPuestaPunto_Area').multiselect({
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
        
                
        //Filtro Referencia
        $.ajax({
          type:"POST",
          url:"f_cargarPuestaPuntoReferencia.php",
          beforeSend: function() {
            $(".e_cargarPPFiltroreferencia").html(loader());
          },
          data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, planta: d_planta },
          success: function(data) {
            $(".e_cargarPPFiltroreferencia").html(data);
              $('#filtroPuestaPunto_Referencia').multiselect({
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
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });  
  
  $("body").on("change", "#filtroPuestaPunto_FechaF", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroPuestaPunto_FechaI").val();
    d_fechaFinal = $("#filtroPuestaPunto_FechaF").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarPuestaPuntoCanal.php",
      beforeSend: function() {
        $(".e_cargarPPFiltroCanal").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, planta: d_planta },
      success: function(data) {
        $(".e_cargarPPFiltroCanal").html(data);
        
        $('#filtroPuestaPunto_Canal').multiselect({
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
        
        //Filtro Área
        $.ajax({
          type:"POST",
          url:"f_cargarPuestaPuntoArea.php",
          beforeSend: function() {
            $(".e_cargarPPFiltroArea").html(loader());
          },
          data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, planta: d_planta },
          success: function(data) {
            $(".e_cargarPPFiltroArea").html(data);
            $('#filtroPuestaPunto_Area').multiselect({
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
        
        //Filtro Referencia
        $.ajax({
          type:"POST",
          url:"f_cargarPuestaPuntoReferencia.php",
          beforeSend: function() {
            $(".e_cargarPPFiltroreferencia").html(loader());
          },
          data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, planta: d_planta },
          success: function(data) {
            $(".e_cargarPPFiltroreferencia").html(data);
             $('#filtroPuestaPunto_Referencia').multiselect({
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
        
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("#b_excelPuestaPuntoBoton").click(function (event) {
    $("#input_resultadoPuestaPunto").val($("<div>").append($("#tbl_PuestaPunto").eq(0).clone()).html());
    $("#f_consultaPuestaPunto").submit();
  });


});