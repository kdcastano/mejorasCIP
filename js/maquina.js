$(document).ready(function (e) {

  $('#filtroMaquina_Planta').multiselect({
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

  $('#filtroMaquina_Area').multiselect({
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

  $('#filtroMaquina_Estado').multiselect({
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
  
  $('#filtroMaquina_AgrM').multiselect({
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

  $("body").on("click", "#Btn_MaquinaBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroMaquina_Planta").val();
    d_fases = $("#filtroMaquina_Fases").val();
    d_canales = $("#filtroMaquina_Canales").val();
    d_areas = $("#filtroMaquina_Area").val();
    d_estado = $("#filtroMaquina_Estado").val();
    d_agrupacionM = $("#filtroMaquina_AgrM").val();

    $.ajax({
      type: "POST",
      url: "f_maquinaListar.php",
      beforeSend: function () {
        $(".info_MaquinaListar").html(loader());
      },
      data: {
        planta: d_planta,
        fases: d_fases,
        canales: d_canales,
        area: d_areas,
        estado: d_estado, 
        agrupacionM: d_agrupacionM
      },
      success: function (data) {
        $(".info_MaquinaListar").html(data);
        $("#tbl_maquinaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });

  $("body").on("click", "#Btn_MaquinaCrear", function (e) {
    e.preventDefault();
    $("#vtn_MaquinaCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_maquinasCrear.php",
      beforeSend: function () {
        $(".info_MaquinaCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_MaquinaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });


  $("body").on("change", "#Maq_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Maq_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarAreas.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarAreaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#Are_Codigo", function(e){
    e.preventDefault();
    
    d_planta = $("#f_MaquinasCrear #Maq_Codigo").val();
    d_area = $("#f_MaquinasCrear #Are_Codigo").val();
    
    $.ajax({
      type: "POST",
      url: "f_cargarAgrupacionesMaquinas.php",
      beforeSend: function () {
        $(".e_cargarAgrupacionMaquinaCrear").html(loader());
      },
      data: {
        planta: d_planta, area: d_area
      },
      success: function (data) {
        $(".e_cargarAgrupacionMaquinaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
    
  });
  
  $("body").on("change", "#AgrM_Codigo", function(e){
    e.preventDefault();
    
    d_agrupacion = $("#f_MaquinasCrear #AgrM_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarNombreMaquinaCrear.php",
      beforeSend: function() {
        $(".e_cargarNombreAgrupacion").html(loader());
      },
      data:{ agrupacion: d_agrupacion },
      success: function(data) {
        $(".e_cargarNombreAgrupacion").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });

  $("body").on("submit", "#f_MaquinasCrear", function (e) {
    e.preventDefault();

    d_area = $("#f_MaquinasCrear #Are_Codigo").val();
    d_nombre = $("#f_MaquinasCrear #Maq_Nombre").val();
    d_agrupacion = $("#f_MaquinasCrear #AgrM_Codigo").val();
    d_orden = $("#f_MaquinasCrear #Maq_Orden").val();

    $.ajax({
      type: "POST",
      url: "op_maquinaCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_MaquinasCrear");
        $("#Btn_MaquinaCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_MaquinasCrear");
        $("#Btn_MaquinaCrearForm").show();
      },
      data: {
        area: d_area,
        nombre: d_nombre,
        agrupacion: d_agrupacion,
        orden: d_orden
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_CrearMaquinaCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_CrearMaquinaCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_CrearMaquinaCargarNotificaciones", function (e) {
    e.preventDefault();


    $("#vtn_CrearMaquinaCargarNotificaciones").modal('hide');
    $("#vtn_MaquinaCrear").modal('hide');
    d_planta = $("#filtroMaquina_Planta").val();
    d_areas = $("#filtroMaquina_Area").val();
    d_estado = $("#filtroMaquina_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_maquinaListar.php",
      beforeSend: function () {
        $(".info_MaquinaListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_areas,
        estado: d_estado
      },
      success: function (data) {
        $(".info_MaquinaListar").html(data);
        $("#tbl_maquinaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_editarMaquina", function (e) {
    e.preventDefault();

    $("#vtn_MaquinaActualizar").modal({
      backdrop: 'static'
    });

    d_codigo = $(this).attr("data-cod");
    d_agrupacion = $(this).attr("data-agr");

    $.ajax({
      type: "POST",
      url: "f_maquinaActualizar.php",
      beforeSend: function () {
        $(".info_MaquinaActualizar").html(loader());
      },
      data: {
        codigo: d_codigo, agrupacion: d_agrupacion
      },
      success: function (data) {
        $(".info_MaquinaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_CodigoAct", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_CodigoAct").val();
    d_codigo = $("#codigoMaquinaAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarAreasActualizar.php",
      beforeSend: function () {
        $(".e_cargarAreaActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarAreaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("change", "#Are_CodigoAct", function(e){
    e.preventDefault();
    
    d_planta = $("#Pla_CodigoAct").val();
    d_codigo = $("#codigoMaquinaAct").val();
    d_area = $("#Are_CodigoAct").val();
    
    $.ajax({
      type: "POST",
      url: "f_cargarAgrupacionesMaquinasAct.php",
      beforeSend: function () {
        $(".e_cargarAgrupacionMaquinaActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        codigo: d_codigo,
        area: d_area
      },
      success: function (data) {
        $(".e_cargarAgrupacionMaquinaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#AgrM_CodigoAct", function(e){
    e.preventDefault();
    
    d_codigo = $("#f_MaquinasActualizar #codigoMaquinaAct").val();
    d_agrupacion = $("#f_MaquinasActualizar #AgrM_CodigoAct").val();
  
    $.ajax({
      type:"POST",
      url:"f_cargarNombreMaquinaActualizar.php",
      beforeSend: function() {
        $(".e_cargarNombreAgrupacionActualizar").html(loader());
      },
      data:{ agrupacion: d_agrupacion, codigo: d_codigo },
      success: function(data) {
        $(".e_cargarNombreAgrupacionActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  $("body").on("submit", "#f_MaquinasActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_MaquinasActualizar #codigoMaquinaAct").val();
    d_area = $("#f_MaquinasActualizar #Are_CodigoAct").val();
    d_nombre = $("#f_MaquinasActualizar #Maq_NombreAct").val();
    d_estado = $("#f_MaquinasActualizar #Maq_EstadoAct").val();
    d_agrupacion = $("#f_MaquinasActualizar #AgrM_CodigoAct").val();
    d_orden = $("#f_MaquinasActualizar #Maq_OrdenAct").val();
    d_codigoAgrupacionMaqCFT = $("#f_MaquinasActualizar #agrupacionMaqCFTAct").val();

    $.ajax({
      type: "POST",
      url: "op_maquinaActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_MaquinasActualizar");
        $("#Btn_MaquinaActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_MaquinasActualizar");
        $("#Btn_MaquinaActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        area: d_area,
        nombre: d_nombre,
        estado: d_estado,
        agrupacion: d_agrupacion,
        orden: d_orden, 
        codAgrMaqCFT: d_codigoAgrupacionMaqCFT
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ActualizarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_ActualizarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_ActualizarCargarNotificaciones", function (e) {
    e.preventDefault();

    $("#vtn_ActualizarCargarNotificaciones").modal('hide');
    $("#vtn_MaquinaActualizar").modal('hide');
    d_planta = $("#filtroMaquina_Planta").val();
    d_fases = $("#filtroMaquina_Fases").val();
    d_canales = $("#filtroMaquina_Canales").val();
    d_areas = $("#filtroMaquina_Area").val();
    d_estado = $("#filtroMaquina_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_maquinaListar.php",
      beforeSend: function () {
        $(".info_MaquinaListar").html(loader());
      },
      data: {
        planta: d_planta,
        fases: d_fases,
        canales: d_canales,
        area: d_areas,
        estado: d_estado
      },
      success: function (data) {
        $(".info_MaquinaListar").html(data);
        $("#tbl_maquinaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
    $("body").on("click", ".e_eliminarMaquina", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_MaquinasNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_maquinaEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_MaquinasNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_maquinaEliminar").val();
    $("#vtn_MaquinasNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_maquinaEliminar.php",
      beforeSend: function () {
        $(".e_eliminarMaquina").hide();
      },
      complete: function () {
        $(".e_eliminarMaquina").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_EliminarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_EliminarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');

        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_EliminarCargarNotificaciones", function (e) {
    e.preventDefault();

    $("#vtn_EliminarCargarNotificaciones").modal('hide');
    d_planta = $("#filtroMaquina_Planta").val();
    d_fases = $("#filtroMaquina_Fases").val();
    d_canales = $("#filtroMaquina_Canales").val();
    d_areas = $("#filtroMaquina_Area").val();
    d_estado = $("#filtroMaquina_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_maquinaListar.php",
      beforeSend: function () {
        $(".info_MaquinaListar").html(loader());
      },
      data: {
        planta: d_planta,
        fases: d_fases,
        canales: d_canales,
        area: d_areas,
        estado: d_estado
      },
      success: function (data) {
        $(".info_MaquinaListar").html(data);
        $("#tbl_maquinaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

});
