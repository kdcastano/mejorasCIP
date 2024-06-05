$(document).ready(function (e) {

  $('#filtroTurnos_Planta').multiselect({
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

  $("body").on("click", "#Btn_TurnosBuscar", function (e) {
    e.preventDefault();
    d_planta = $("#filtroTurnos_Planta").val();
    d_estado = $("#filtroTurnos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_turnosListar.php",
      beforeSend: function () {
        $(".info_turnosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_turnosListar").html(data);		  
		$("#tbl_turnosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_TurnosCrear", function (e) {
    e.preventDefault();

    $("#vtn_TurnosCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_turnosCrear.php",
      beforeSend: function () {
        $(".info_TurnosCrear").html(loader());
      },
      success: function (data) {
        $(".info_TurnosCrear").html(data);
        $('#Tur_Pla_Codigo').multiselect({
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
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_turnosCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_turnosCrear #Tur_Pla_Codigo").val();
    d_nombre = $("#f_turnosCrear #Tur_Nombre").val();
    d_horaI = $("#f_turnosCrear #Tur_HoraInicio").val();
    d_horaF = $("#f_turnosCrear #Tur_HoraFin").val();

    $.ajax({
      type: "POST",
      url: "op_turnosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_turnosCrear");
        $("#Btn_TurnosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_turnosCrear");
        $("#Btn_TurnosCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre,
        horaI: d_horaI,
        horaF: d_horaF
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_TurnosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_TurnosNotificacionesCrear").modal({
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


  $("body").on("click", "#Btn_TurnosNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_TurnosNotificacionesCrear").modal('hide');
    $("#vtn_TurnosCrear").modal('hide');

    d_planta = $("#filtroTurnos_Planta").val();
    d_estado = $("#filtroTurnos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_turnosListar.php",
      beforeSend: function () {
        $(".info_turnosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_turnosListar").html(data);	  
		$("#tbl_turnosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_editarTurno", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_TurnosActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_turnosActualizar.php",
      beforeSend: function () {
        $(".info_TurnosActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_TurnosActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_turnosActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_turnosActualizar #codigoAct").val();
    d_planta = $("#f_turnosActualizar #Tur_Pla_CodigoAct").val();
    d_nombre = $("#f_turnosActualizar #Tur_NombreAct").val();
    d_horaI = $("#f_turnosActualizar #Tur_HoraInicioAct").val();
    d_horaF = $("#f_turnosActualizar #Tur_HoraFinAct").val();
    d_estado = $("#f_turnosActualizar #Tur_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_turnosActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_turnosActualizar");
        $("#Btn_TurnosActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_turnosActualizar");
        $("#Btn_TurnosActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        horaI: d_horaI,
        horaF: d_horaF,
		estado: d_estado
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_TurnosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_TurnosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });

  $("body").on("click", "#Btn_TurnosNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_TurnosNotificacionesActualizar").modal('hide');
    $("#vtn_TurnosActualizar").modal('hide');

    d_planta = $("#filtroTurnos_Planta").val();
    d_estado = $("#filtroTurnos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_turnosListar.php",
      beforeSend: function () {
        $(".info_turnosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_turnosListar").html(data);	  
		$("#tbl_turnosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".e_eliminarTurno", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_TurnosConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_TurnosEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_TurnosConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_TurnosEliminar").val();
    $("#vtn_TurnosConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_turnosEliminar.php",
      beforeSend: function () {
        $(".e_eliminarTurno").hide();
      },
      complete: function () {
        $(".e_eliminarTurno").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_TurnosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          $("#vtn_TurnosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_TurnosNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_TurnosNotificacionesEliminar").modal('hide');
    d_planta = $("#filtroTurnos_Planta").val();
    d_estado = $("#filtroTurnos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_turnosListar.php",
      beforeSend: function () {
        $(".info_turnosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_turnosListar").html(data);	  
		$("#tbl_turnosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });


}); // JavaScript Document
