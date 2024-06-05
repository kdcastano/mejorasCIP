$(document).ready(function (e) {
	
  $('#filtroPermisos_Tipo').multiselect({
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

  $("body").on("click", "#Btn_PermisosBuscar", function (e) {
    e.preventDefault();
	  
    d_tipo = $("#filtroPermisos_Tipo").val();
    d_estado = $("#filtroPermisos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_permisosListar.php",
      beforeSend: function () {
        $(".info_PermisosListar").html(loader());
      },
      data: {
        tipo: d_tipo,
        estado: d_estado
      },
      success: function (data) {
        $(".info_PermisosListar").html(data);
		$("#tbl_permisosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_PermisosCrear", function (e) {
    e.preventDefault();

    $("#vtn_PermisosCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_permisosCrear.php",
      beforeSend: function () {
        $(".info_PermisosCrear").html(loader());
      },
      success: function (data) {
        $(".info_PermisosCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_permisosCrear", function (e) {
    e.preventDefault();

    d_modulo = $("#f_permisosCrear #Per_Modulo").val();
    d_tipo = $("#f_permisosCrear #Per_Tipo").val();
    d_descrip = $("#f_permisosCrear #Per_Descripcion").val();

    $.ajax({
      type: "POST",
      url: "op_permisosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_permisosCrear");
        $("#Btn_PermisosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_permisosCrear");
        $("#Btn_PermisosCrearForm").show();
      },
      data: {
        modulo: d_modulo,
        tipo: d_tipo,
        descrip: d_descrip
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {

          $("#vtn_PermisosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_PermisosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {

          $("#vtn_PermisosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_PermisosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_PermisosNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_PermisosNotificacionesCrear").modal('hide');
    $("#vtn_PermisosCrear").modal('hide');

    d_modulo = $("#filtroPermisos_Modulo").val();
    d_tipo = $("#filtroPermisos_Tipo").val();
    d_estado = $("#filtroPermisos_Estado").val();


    $.ajax({
      type: "POST",
      url: "f_permisosListar.php",
      beforeSend: function () {
        $(".info_PermisosListar").html(loader());
      },
      data: {
        modulo: d_modulo,
        tipo: d_tipo,
        estado: d_estado
      },
      success: function (data) {
        $(".info_PermisosListar").html(data);
		$("#tbl_permisosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_editarPermiso", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_PermisosActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_PermisosActualizar.php",
      beforeSend: function () {
        $(".info_PermisosActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_PermisosActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });


  $("body").on("submit", "#f_permisosActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_permisosActualizar #codigoAct").val();
    d_modulo = $("#f_permisosActualizar #Per_ModuloAct").val();
    d_tipo = $("#f_permisosActualizar #Per_TipoAct").val();
    d_descrip = $("#f_permisosActualizar #Per_DescripcionAct").val();
    d_estado = $("#f_permisosActualizar #Per_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_permisosActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_permisosActualizar");
        $("#Btn_PermisosActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_permisosActualizar");
        $("#Btn_PermisosActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        modulo: d_modulo,
        tipo: d_tipo,
        descripcion: d_descrip,
		estado: d_estado
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PermisosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_PermisosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_PermisosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_PermisosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_PermisosNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_PermisosNotificacionesActualizar").modal('hide');
    $("#vtn_PermisosActualizar").modal('hide');

    d_modulo = $("#filtroPermisos_Modulo").val();
    d_tipo = $("#filtroPermisos_Tipo").val();
    d_estado = $("#filtroPermisos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_permisosListar.php",
      beforeSend: function () {
        $(".info_PermisosListar").html(loader());
      },
      data: {
        modulo: d_modulo,
        tipo: d_tipo,
        estado: d_estado
      },
      success: function (data) {
        $(".info_PermisosListar").html(data);
		$("#tbl_permisosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
	
	$("body").on("click", ".e_eliminarPermiso", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "op_permisosEliminar.php",
      beforeSend: function () {
        $(".e_eliminarPermiso").hide();
      },
      complete: function () {
        $(".e_eliminarPermiso").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PermisosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_PermisosNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          $("#vtn_PermisosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_PermisosNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
	
	
	$("body").on("click", "#Btn_PermisosNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_PermisosNotificacionesEliminar").modal('hide');
		d_modulo = $("#filtroPermisos_Modulo").val();
    d_tipo = $("#filtroPermisos_Tipo").val();
    d_estado = $("#filtroPermisos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_permisosListar.php",
      beforeSend: function () {
        $(".info_PermisosListar").html(loader());
      },
      data: {
         modulo: d_modulo,
        tipo: d_tipo,
        estado: d_estado
      },
      success: function (data) {
        $(".info_PermisosListar").html(data);
		$("#tbl_permisosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });
});
