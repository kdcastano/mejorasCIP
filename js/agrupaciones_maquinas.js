$(document).ready(function (e) {
  
  $('#filtroAgrupacionesMaquinas_Planta').multiselect({
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

  $("body").on("click", "#Btn_AgrupacionesMaquinasBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroAgrupacionesMaquinas_Planta").val();
    d_estado = $("#filtroAgrupacionesMaquinas_Estado").val();
    d_tipo = $("#filtroAgrupacionesMaquinas_AgrM_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesMaquinasListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesMaquinasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        tipo: d_tipo
      },
      success: function (data) {
        $(".info_AgrupacionesMaquinasListar").html(data);
        $("#tbl_agrupacionesMaquinasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_AgrupacionesMaquinasCrear", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesMaquinasCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_agrupacionesMaquinasCrear.php",
      beforeSend: function () {
        $(".info_AgrupacionesMaquinasCrear").html(loader());
      },
      success: function (data) {
        $(".info_AgrupacionesMaquinasCrear").html(data);
        $('#AgrC_CodigoV').multiselect({
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
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_agrupacionesMaquinasCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_agrupacionesMaquinasCrear #AgrM_Pla_Codigo").val();
    d_nombre = $("#f_agrupacionesMaquinasCrear #AgrM_Nombre").val();
    d_agrVariable = $("#f_agrupacionesMaquinasCrear #AgrC_CodigoV").val();
    d_tipo = $("#f_agrupacionesMaquinasCrear #AgrM_Tipo").val();
    d_orden = $("#f_agrupacionesMaquinasCrear #AgrM_Orden").val();

    $.ajax({
      type: "POST",
      url: "op_agrupacionesMaquinasCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_agrupacionesMaquinasCrear");
        $("#Btn_AgrupacionesMaquinasCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_agrupacionesMaquinasCrear");
        $("#Btn_AgrupacionesMaquinasCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre,
        agrVariable: d_agrVariable,
        tipo: d_tipo,
        orden: d_orden
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesMaquinasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesMaquinasCrearNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesMaquinasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesMaquinasCrearNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_AgrupacionesMaquinasNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesMaquinasNotificacionesCrear").modal('hide');
    $("#vtn_AgrupacionesMaquinasCrear").modal('hide');

    d_planta = $("#filtroAgrupacionesMaquinas_Planta").val();
    d_estado = $("#filtroAgrupacionesMaquinas_Estado").val();
    d_tipo = $("#filtroAgrupacionesMaquinas_AgrM_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesMaquinasListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesMaquinasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        tipo: d_tipo
      },
      success: function (data) {
        $(".info_AgrupacionesMaquinasListar").html(data);
        $("#tbl_agrupacionesMaquinasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarAgrupacionMaquinas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_AgrupacionesMaquinasActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_agrupacionesMaquinasActualizar.php",
      beforeSend: function () {
        $(".info_AgrupacionesMaquinasActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_AgrupacionesMaquinasActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_agrupacionesMaquinasActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_agrupacionesMaquinasActualizar #codigoAct").val();
    d_planta = $("#f_agrupacionesMaquinasActualizar #AgrM_Pla_CodigoAct").val();
    d_nombre = $("#f_agrupacionesMaquinasActualizar #AgrM_NombreAct").val();
    d_estado = $("#f_agrupacionesMaquinasActualizar #AgrM_EstadoAct").val();
    d_tipo = $("#f_agrupacionesMaquinasActualizar #AgrM_TipoAct").val();
    d_orden = $("#f_agrupacionesMaquinasActualizar #AgrM_OrdenAct").val();

    $.ajax({
      type: "POST",
      url: "op_agrupacionesMaquinasActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_agrupacionesMaquinasActualizar");
        $("#Btn_AgrupacionesMaquinasActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_agrupacionesMaquinasActualizar");
        $("#Btn_AgrupacionesMaquinasActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        estado: d_estado,
        tipo: d_tipo,
        orden: d_orden
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesMaquinasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesMaquinasActualizarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesMaquinasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesMaquinasActualizarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
$("body").on("click", "#Btn_AgrupacionesMaquinasNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesMaquinasNotificacionesActualizar").modal('hide');
    $("#vtn_AgrupacionesMaquinasActualizar").modal('hide');

    d_planta = $("#filtroAgrupacionesMaquinas_Planta").val();
    d_estado = $("#filtroAgrupacionesMaquinas_Estado").val();
    d_tipo = $("#filtroAgrupacionesMaquinas_AgrM_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesMaquinasListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesMaquinasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        tipo: d_tipo
      },
      success: function (data) {
        $(".info_AgrupacionesMaquinasListar").html(data);
        $("#tbl_agrupacionesMaquinasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarAgrupacionMaquinas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_OperacionControlNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_OperacionControlEliminar").val(d_codigo);

  });
  
  $("body").on("click", "#Btn_OperacionControlNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_OperacionControlEliminar").val();
    $("#vtn_OperacionControlNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_agrupacionesMaquinasEliminar.php",
      beforeSend: function () {
        $("#e_eliminarAgrupacionMaquinas").hide();
      },
      complete: function () {
        $("#e_eliminarAgrupacionMaquinas").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesMaquinasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesMaquinasEliminarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesMaquinasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesMaquinasEliminarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
$("body").on("click", "#Btn_AgrupacionesMaquinasNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesMaquinasNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroAgrupacionesMaquinas_Planta").val();
    d_estado = $("#filtroAgrupacionesMaquinas_Estado").val();
    d_tipo = $("#filtroAgrupacionesMaquinas_AgrM_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesMaquinasListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesMaquinasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        tipo: d_tipo
      },
      success: function (data) {
        $(".info_AgrupacionesMaquinasListar").html(data);
        $("#tbl_agrupacionesMaquinasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_AsignarVariablesAgruMaquinas", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarVariablesActualizar").modal({
      backdrop: 'static'
    });
    
    d_codigo = $(this).attr("data-cod");
    d_planta = $(this).attr("data-pla");
    
    $.ajax({
      type:"POST",
      url:"f_asignacionVariablesMaquinas.php",
      beforeSend: function() {
        $(".info_AsignarVariablesActualizar").html(loader());
      },
      data:{ codigo: d_codigo, planta: d_planta },
      success: function(data) {
        $(".info_AsignarVariablesActualizar").html(data);
          $('#AgrC_Codigo').multiselect({
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
  
  $("body").on("submit", "#f_asignacionVariablesMaquinas", function(e){
    e.preventDefault();
    
    d_AgrMaquina = $("#f_asignacionVariablesMaquinas #AgrM_Codigo").val();
    d_AgrVariable = $("#f_asignacionVariablesMaquinas #AgrC_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"op_asignacionVariablesMauinas.php",
      beforeSend: function() {
        bloquearFormulario("f_asignacionVariablesMaquinas");
        $("#Btn_AsignarVariablesMaquinasForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_asignacionVariablesMaquinas");
        $("#Btn_AsignarVariablesMaquinasForm").show();
      },
      data: { agrMaquina: d_AgrMaquina, agrVariable: d_AgrVariable },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_AsignarVariablesNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_AsignarVariablesNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_AsignarVariablesNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_AsignarVariablesNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", "#Btn_AsignarVariablesNotificacionesCrear", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarVariablesNotificacionesCrear").modal('hide');
    
    d_AgrMaquina = $("#f_asignacionVariablesMaquinas #AgrM_Codigo").val();
    d_planta = $("#f_asignacionVariablesMaquinas #AgrM_Planta").val();
    
    $.ajax({
      type:"POST",
      url:"f_asignacionVariablesMaquinas.php",
      beforeSend: function() {
        $(".info_AsignarVariablesActualizar").html(loader());
      },
      data:{ codigo: d_AgrMaquina, planta: d_planta },
      success: function(data) {
        $(".info_AsignarVariablesActualizar").html(data);
          $('#AgrC_Codigo').multiselect({
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
  
  $("body").on("click", ".e_eliminarVariableControlMaquina", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_planta = $(this).attr("data-pla");
    
    $("#vtn_AsignarVariablesNotificacionesEliminarConfirmacion").modal({
      backdrop: 'static'
    });

    $(".Cod_AgrupacionMaquina").val(d_codigo);
    $(".Planta_AgrupacionMaquina").val(d_planta);
    
  });
  
  $("body").on("click", "#Btn_AsignarVariablesFinalizarForm", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarVariablesNotificacionesEliminarConfirmacion").modal('hide');
    
    d_codigo = $(".Cod_AgrupacionMaquina").val();
    d_planta = $(".Planta_AgrupacionMaquina").val();
    
    $.ajax({
      type:"POST",
      url:"op_asignacionVariablesMaquinasEliminar.php",
      beforeSend: function() {
        bloquearFormulario("f_asignacionVariablesMaquinas");
        $(".e_eliminarVariableControlMaquina").hide();
      },
      complete: function() {
        desbloquearFormulario("f_asignacionVariablesMaquinas");
        $(".e_eliminarVariableControlMaquina").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_AsignarVariablesNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_vtn_AsignarVariablesNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_AsignarVariablesNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_vtn_AsignarVariablesNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", "#Btn_vtn_AsignarVariablesNotificacionesEliminar", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarVariablesNotificacionesEliminar").modal('hide');
    
    d_AgrMaquina = $("#f_asignacionVariablesMaquinas #AgrM_Codigo").val();
//    d_AgrMaquina = $(".Cod_AgrupacionMaquina").val();
    d_planta = $("#f_asignacionVariablesMaquinas #AgrM_Planta").val();
    
    $.ajax({
      type:"POST",
      url:"f_asignacionVariablesMaquinas.php",
      beforeSend: function() {
        $(".info_AsignarVariablesActualizar").html(loader());
      },
      data:{ codigo: d_AgrMaquina, planta: d_planta },
      success: function(data) {
        $(".info_AsignarVariablesActualizar").html(data);
          $('#AgrC_Codigo').multiselect({
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
  
  $("body").on("click", ".e_AsignarMaquinas", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarMaquinasCrear").modal({
      backdrop: 'static'
    });
    
    d_AgrMaquina = $(this).attr("data-cod");
    
    $.ajax({
      type:"POST",
      url:"f_asignacionMaquinas.php",
      beforeSend: function() {
        $(".info_AsignarMaquinasCrear").html(loader());
      },
      data:{ codigo: d_AgrMaquina },
      success: function(data) {
        $(".info_AsignarMaquinasCrear").html(data);
        $('#Maq_Codigo').multiselect({
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
  
  $("body").on("submit", "#f_asignacionMaquinaAgrupacion", function(e){
    e.preventDefault();
    
    d_AgrMaquina = $("#f_asignacionMaquinaAgrupacion #AgrM_Codigo").val();
    d_Maquina = $("#f_asignacionMaquinaAgrupacion #Maq_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"op_asignacionMaquinas.php",
      beforeSend: function() {
        bloquearFormulario("f_asignacionMaquinaAgrupacion");
        $("#Btn_AsignarMaquinaAgrupacionForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_asignacionMaquinaAgrupacion");
        $("#Btn_AsignarMaquinaAgrupacionForm").show();
      },
      data: { agrMaquina: d_AgrMaquina, maquina: d_Maquina },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_AsignarMaquinasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_AsignarMaquinasNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_AsignarMaquinasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_AsignarMaquinasNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_AsignarMaquinasNotificacionesCrear", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarMaquinasNotificacionesCrear").modal('hide');
    
    d_AgrMaquina = $("#f_asignacionMaquinaAgrupacion #AgrM_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"f_asignacionMaquinas.php",
      beforeSend: function() {
        $(".info_AsignarMaquinasCrear").html(loader());
      },
      data:{ codigo: d_AgrMaquina },
      success: function(data) {
        $(".info_AsignarMaquinasCrear").html(data);
        $('#Maq_Codigo').multiselect({
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
  
  $("body").on("click", ".e_eliminarMaquinaAgrupacion", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_AsignarMaquinasNotificacionesEliminarConfirmacion").modal({
      backdrop: 'static'
    });

    $(".Cod_AgrupacionMaquina").val(d_codigo);
    
  });
  
  $("body").on("click", "#Btn_AsignarMaquinasEliminarConfirForm", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarMaquinasNotificacionesEliminarConfirmacion").modal('hide');
    
    d_codigo = $(".Cod_AgrupacionMaquina").val();
    
    $.ajax({
      type:"POST",
      url:"op_asignacionMaquinasEliminar.php",
      beforeSend: function() {
        bloquearFormulario("f_asignacionMaquinaAgrupacion");
        $(".e_eliminarMaquinaAgrupacion").hide();
      },
      complete: function() {
        desbloquearFormulario("f_asignacionMaquinaAgrupacion");
        $(".e_eliminarMaquinaAgrupacion").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_AsignarMaquinasNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_vtn_AsignarMaquinasNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_AsignarMaquinasNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_vtn_AsignarMaquinasNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", "#Btn_vtn_AsignarMaquinasNotificacionesEliminar", function(e){
    e.preventDefault();
    
    $("#vtn_AsignarMaquinasNotificacionesEliminar").modal('hide');
    
    d_AgrMaquina = $("#f_asignacionMaquinaAgrupacion #AgrM_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"f_asignacionMaquinas.php",
      beforeSend: function() {
        $(".info_AsignarMaquinasCrear").html(loader());
      },
      data:{ codigo: d_AgrMaquina },
      success: function(data) {
        $(".info_AsignarMaquinasCrear").html(data);
        $('#Maq_Codigo').multiselect({
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
  
  $("body").on("click", ".recargarAgrMaquinas", function(e){
      e.preventDefault();
    
    d_planta = $("#filtroAgrupacionesMaquinas_Planta").val();
    d_estado = $("#filtroAgrupacionesMaquinas_Estado").val();
    d_tipo = $("#filtroAgrupacionesMaquinas_AgrM_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesMaquinasListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesMaquinasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        tipo: d_tipo
      },
      success: function (data) {
        $(".info_AgrupacionesMaquinasListar").html(data);
        $("#tbl_agrupacionesMaquinasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
    
  });
  
  $("body").on("change", "#AgrM_Pla_Codigo", function(e){
    e.preventDefault();
    
    d_planta = $("#f_agrupacionesMaquinasCrear #AgrM_Pla_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarVariablesControl.php",
      beforeSend: function() {
        $(".cargarVariablesControl").html(loader());
      },
      data:{ planta: d_planta },
      success: function(data) {
        $(".cargarVariablesControl").html(data);
        $('#AgrC_CodigoV').multiselect({
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
  
}); // JavaScript Document
