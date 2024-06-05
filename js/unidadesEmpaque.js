$(document).ready(function (e) {
  $('#filtroUnidadE_Planta').multiselect({
    includeSelectAllOption: true,
    enableFiltering: true,
    selectAllText: 'Seleccionar Todos',
    nonSelectedText: 'Seleccione...',
    nSelectedText: ' Todos',
    buttonWidth: '100%',
    enableCaseInsensitiveFiltering: true,
    maxHeight: 400,
    dropUp: true
  });

  $('#filtroUnidadE_Formato').multiselect({
    includeSelectAllOption: true,
    enableFiltering: true,
    selectAllText: 'Seleccionar Todos',
    nonSelectedText: 'Seleccione...',
    nSelectedText: ' Todos',
    buttonWidth: '100%',
    enableCaseInsensitiveFiltering: true,
    maxHeight: 400,
    dropUp: true
  });

  $("body").on("click", "#Btn_UnidadEmapqueBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroUnidadE_Planta").val();
    d_formato = $("#filtroUnidadE_Formato").val();
    d_estado = $("#filtroUnidadE_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_unidadesEListar.php",
      beforeSend: function () {
        $(".info_UnidadEmpaqueListar").html(loader());
      },
      data: {
        planta: d_planta,
        formato: d_formato,
        estado: d_estado
      },
      success: function (data) {
        $(".info_UnidadEmpaqueListar").html(data);
        $("#tbl_UnidadesEmpaqueListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_UnidadEmpaqueCrear", function (e) {
    e.preventDefault();

    $("#vtn_UnidadEmpaqueCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_unidadesECrear.php",
      beforeSend: function () {
        $(".info_UnidadEmpaqueCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_UnidadEmpaqueCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_Codigo_UnidadE", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo_UnidadE").val();

    $.ajax({
      type: "POST",
      url: "f_cargarFormatos.php",
      beforeSend: function () {
        $(".e_cargarFormatosCrear").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarFormatosCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_unidadesECrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_unidadesECrear #Pla_Codigo_UnidadE").val();
    d_formato = $("#f_unidadesECrear #For_Codigo").val();
    d_tipo = $("#f_unidadesECrear #UnidadE_Tipo").val();
    d_metros = $("#f_unidadesECrear #UniE_Metros").val();

    $.ajax({
      type: "POST",
      url: "op_unidadECrear.php",
      beforeSend: function () {
        bloquearFormulario("f_unidadesECrear");
        $("#Btn_UnidadEmpaqueCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_unidadesECrear");
        $("#Btn_UnidadEmpaqueCrearForm").show();
      },
      data: {
        planta: d_planta,
        formato: d_formato,
        tipo: d_tipo,
        metros: d_metros
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_UnidadEmpaqueNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_UnidadEmpaqueNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_UnidadEmpaqueNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_UnidadEmpaqueNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_UnidadEmpaqueNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_UnidadEmpaqueNotificacionesCrear").modal('hide');
    $("#vtn_UnidadEmpaqueCrear").modal('hide');

    d_planta = $("#filtroUnidadE_Planta").val();
    d_formato = $("#filtroUnidadE_Formato").val();
    d_estado = $("#filtroUnidadE_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_unidadesEListar.php",
      beforeSend: function () {
        $(".info_UnidadEmpaqueListar").html(loader());
      },
      data: {
        planta: d_planta,
        formato: d_formato,
        estado: d_estado
      },
      success: function (data) {
        $(".info_UnidadEmpaqueListar").html(data);
        $("#tbl_UnidadesEmpaqueListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarUnidadesEmpaque", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_UnidadEmpaqueActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_unidadEActualizar.php",
      beforeSend: function () {
        $(".info_UnidadesEmpaqueActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_UnidadesEmpaqueActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_Codigo_unidadesEAct", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo_unidadesEAct").val();
    d_codigo = $("#codigounidadesEAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarFormatosActualizar.php",
      beforeSend: function () {
        $(".e_cargarFormatosActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarFormatosActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_unidadEActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_unidadEActualizar #codigounidadesEAct").val();
    d_planta = $("#f_unidadEActualizar #Pla_Codigo_unidadesEAct").val();
    d_formato = $("#f_unidadEActualizar #For_CodigoAct").val();
    d_tipo = $("#f_unidadEActualizar #UnidadE_TipoAct").val();
    d_metros = $("#f_unidadEActualizar #UniE_MetrosAct").val();
    d_estado = $("#f_unidadEActualizar #UnidadE_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_unidadEActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_unidadEActualizar");
        $("#Btn_UnidadEmpaqueActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_unidadEActualizar");
        $("#Btn_UnidadEmpaqueActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        formato: d_formato,
        tipo: d_tipo,
        metros: d_metros,
        estado: d_estado
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_UnidadEmpaqueNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_UnidadEmpaqueNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_UnidadEmpaqueNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_UnidadEmpaqueNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_UnidadEmpaqueNotificacionesActualizar", function (e) {
    e.preventDefault();
    $("#vtn_UnidadEmpaqueNotificacionesActualizar").modal('hide');
    $("#vtn_UnidadEmpaqueActualizar").modal('hide');

    d_planta = $("#filtroUnidadE_Planta").val();
    d_formato = $("#filtroUnidadE_Formato").val();
    d_estado = $("#filtroUnidadE_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_unidadesEListar.php",
      beforeSend: function () {
        $(".info_UnidadEmpaqueListar").html(loader());
      },
      data: {
        planta: d_planta,
        formato: d_formato,
        estado: d_estado
      },
      success: function (data) {
        $(".info_UnidadEmpaqueListar").html(data);
        $("#tbl_UnidadesEmpaqueListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarUnidadesEmpaque", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_UnidadesEmpaqueConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_UnidadesEmpaqueEliminar").val(d_codigo);

  });
	
	$("body").on("click", "#Btn_UnidadesEmpaqueConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_UnidadesEmpaqueEliminar").val();
    $("#vtn_UnidadesEmpaqueConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_UnidadEEliminar.php",
      beforeSend: function () {
        $(".e_eliminarUnidadesEmpaque").hide();
      },
      complete: function () {
        $(".e_eliminarUnidadesEmpaque").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_UnidadEmpaqueNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_UnidadEmpaqueNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          $("#vtn_UnidadEmpaqueNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_UnidadEmpaqueNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_UnidadEmpaqueNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_UnidadEmpaqueNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroUnidadE_Planta").val();
    d_formato = $("#filtroUnidadE_Formato").val();
    d_estado = $("#filtroUnidadE_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_unidadesEListar.php",
      beforeSend: function () {
        $(".info_UnidadEmpaqueListar").html(loader());
      },
      data: {
        planta: d_planta,
        formato: d_formato,
        estado: d_estado
      },
      success: function (data) {
        $(".info_UnidadEmpaqueListar").html(data);
        $("#tbl_UnidadesEmpaqueListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

});
