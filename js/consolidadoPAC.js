$(document).ready(function(e) {
  
  $('#filtroConsolidadoPAC_Supervisor').multiselect({
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
  
  $('#filtroConsolidadoPAC_Tipo').multiselect({
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
  
  $('#filtroConsolidadoPAC_Agrupacion').multiselect({
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
  
  d_fechaInicial = $("#filtroConsolidadoPAC_FechaInicial").val();
  d_fechaFinal = $("#filtroConsolidadoPAC_FechaFinal").val();

  $.ajax({
    type:"POST",
    url:"f_cargarReferenciaPAC.php",
    beforeSend: function() {
      $(".e_cargarProductoPAC").html(loader());
    },
    data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal },
    success: function(data) {
      $(".e_cargarProductoPAC").html(data);
       $('#filtroConsolidadoPAC_Producto').multiselect({
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
  
  $("body").on("change", "#filtroConsolidadoPAC_Agrupacion", function(e){
    e.preventDefault();
    
      d_producto = $("#filtroConsolidadoPAC_Producto").val();
      d_agrupacion = $("#filtroConsolidadoPAC_Agrupacion").val();
    
      if(d_producto != null){
        $.ajax({
          type:"POST",
          url:"f_cargarOrigenPAC.php",
          beforeSend: function() {
            $(".e_cargarOrigenPAC").html(loader());
          },
          data:{ producto: d_producto, agrupacion: d_agrupacion },
          success: function(data) {
            $(".e_cargarOrigenPAC").html(data);
            $(".e_cargarConsolidadoPAC").html('');
             $('#filtroConsolidadoPAC_Origen').multiselect({
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
      }else{
        $(".e_cargarConsolidadoPAC").html('<div class="alert alert-danger"> <strong>Por favor seleccione una referencia</strong> </div>');
        $(".e_cargarOrigenPAC").html('<div class="form-group e_cargarOrigenPAC"><label class="control-label">Origen:</label><select id="filtroConsolidadoPAC_Origen" class="form-control"><option value=""></option></select></div>');
      }
  }); 
  
  $("body").on("change", "#filtroConsolidadoPAC_Producto", function(e){
    e.preventDefault();
    
      d_producto = $("#filtroConsolidadoPAC_Producto").val();
    
      if(d_producto == null){
        $(".e_cargarConsolidadoPAC").html('<div class="alert alert-danger"> <strong>Por favor seleccione una referencia</strong> </div>');
        $(".e_cargarOrigenPAC").html('<div class="form-group e_cargarOrigenPAC"><label class="control-label">Origen:</label><select id="filtroConsolidadoPAC_Origen" class="form-control"><option value=""></option></select></div>');
      }
  });
  
  $("body").on("change", "#filtroConsolidadoPAC_Tipo", function(e){
    e.preventDefault();
    
    d_tipo = $("#filtroConsolidadoPAC_Tipo").val();
    
    
    $.ajax({
      type:"POST",
      url:"f_cargarDefectoPAC.php",
      beforeSend: function() {
        $(".e_cargarDefectoPAC").html(loader());
      },
      data:{ tipo: d_tipo },
      success: function(data) {
        $(".e_cargarDefectoPAC").html(data);
        $('#filtroConsolidadoPAC_defecto').multiselect({
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
        $("#filtroConsolidadoPAC_Agrupacion").change();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });

  });
  
  $("body").on("change", "#filtroConsolidadoPAC_FechaInicial", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroConsolidadoPAC_FechaInicial").val();
    d_fechaFinal = $("#filtroConsolidadoPAC_FechaFinal").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarReferenciaPAC.php",
      beforeSend: function() {
        $(".e_cargarProductoPAC").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal },
      success: function(data) {
        $(".e_cargarProductoPAC").html(data);
         $('#filtroConsolidadoPAC_Producto').multiselect({
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
  
  $("body").on("change", "#filtroConsolidadoPAC_FechaFinal", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroConsolidadoPAC_FechaInicial").val();
    d_fechaFinal = $("#filtroConsolidadoPAC_FechaFinal").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarReferenciaPAC.php",
      beforeSend: function() {
        $(".e_cargarProductoPAC").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal },
      success: function(data) {
        $(".e_cargarProductoPAC").html(data);
         $('#filtroConsolidadoPAC_Producto').multiselect({
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
  
  $("body").on("change", "#filtroConsolidadoPAC_Origen", function(e){
    e.preventDefault();
    
    d_area = $("#filtroConsolidadoPAC_Origen").val();
    $.ajax({
      type:"POST",
      url:"f_cargarMaquinaPAC.php",
      beforeSend: function() {
        $(".e_cargarMaquinaPAC").html(loader());
      },
      data:{ area: d_area },
      success: function(data) {
        $(".e_cargarMaquinaPAC").html(data);
        $(".e_cargarConsolidadoPAC").html(''); 
        $('#filtroConsolidadoPAC_Maquina').multiselect({
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
        $("#filtroConsolidadoPAC_Maquina").change();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#filtroConsolidadoPAC_Maquina", function(e){
    e.preventDefault();
    
    d_origen = $("#filtroConsolidadoPAC_Origen").val();
    d_maquina = $("#filtroConsolidadoPAC_Maquina").val();
    d_producto = $("#filtroConsolidadoPAC_Producto").val();
    d_cantSelecprod = d_producto.length;
    
    $.ajax({
      type:"POST",
      url:"f_cargarVariablesFiltroPAC.php",
      beforeSend: function() {
        $(".e_cargarVariablesPAC").html(loader());
      },
      data:{ origen: d_origen, maquina: d_maquina, producto: d_producto, cantidad:d_cantSelecprod  },
      success: function(data) {
        $(".e_cargarVariablesPAC").html(data);
         $('#filtroConsolidadoPAC_Variables').multiselect({
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
  
  $("body").on("click", "#Btn_ConsolidadoPACBuscar", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroConsolidadoPAC_FechaInicial").val();
    d_fechaFinal = $("#filtroConsolidadoPAC_FechaFinal").val();
    d_tipo = $("#filtroConsolidadoPAC_Tipo").val();
    d_producto = $("#filtroConsolidadoPAC_Producto").val();
    d_defecto = $("#filtroConsolidadoPAC_defecto").val();
    d_origen = $("#filtroConsolidadoPAC_Origen").val();
    d_maquina = $("#filtroConsolidadoPAC_Maquina").val();
    d_variables = $("#filtroConsolidadoPAC_Variables").val();
    d_supervisor = $("#filtroConsolidadoPAC_Supervisor").val();
    d_diasRetraso = $("#filtroConsolidadoPAC_DiaRetraso").val();
    
    $.ajax({
      type:"POST",
      url:"f_consolidadoPACListar.php",
      beforeSend: function() {
        $(".e_cargarConsolidadoPAC").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, tipo: d_tipo, producto: d_producto, defecto: d_defecto, origen: d_origen, maquina: d_maquina, variables: d_variables, supervisor: d_supervisor, diaRetraso: d_diasRetraso},
      success: function(data) {
        $(".e_cargarConsolidadoPAC").html(data);
        $("#tbl_consolidadoPAC").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });

    
  });
  
  $("#b_excelConsolidadoPACBoton").click(function (event) {
    $("#input_resultadoConsolidadoPAC").val($("<div>").append($("#tbl_consolidadoPAC").eq(0).clone()).html());
    $("#f_consultaConsolidadoPAC").submit();
  });



});