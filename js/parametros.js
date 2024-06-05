$(document).ready(function (e) {
  $('#filtroParametros_Planta').multiselect({
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

  $('#filtroParametros_Tipo').multiselect({
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

  $("body").on("click", "#Btn_ParametrosBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroParametros_Planta").val();
    d_estado = $("#filtroParametros_Estado").val();
    d_tipo = $("#filtroParametros_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_parametrosListar.php",
      beforeSend: function () {
        $(".info_ParametrosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        tipo: d_tipo
      },
      success: function (data) {
        $(".info_ParametrosListar").html(data);
        $("#tbl_parametrosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_ParametrosCrear", function (e) {
    e.preventDefault();

    $("#vtn_ParametrosCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_parametrosCrear.php",
      beforeSend: function () {
        $(".info_ParametrosCrear").html(loader());
      },
      success: function (data) {
        $(".info_ParametrosCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#Par_Estado", function(e){
    e.preventDefault();
  	
	tipo = $("#Par_Estado").val();
	d_planta = $("#f_parametrosCrear #Par_Pla_Codigo").val();
	if(d_planta != ""){
		if(tipo==8){
		  $.ajax({
			type: "POST",
			url: "f_cargarEfectoFT.php",
			beforeSend: function () {
			  $(".e_cargarTipoEfecto").html(loader());
			},
			data: { planta: d_planta },
			success: function (data) {
			  $(".e_cargarTipoEfecto").html(data);
			},
			error: function (er1, er2, er3) {
			  console.log(er2 + "-" + er3);
			}
		  });
		}else {
		 $(".e_cargarTipoEfecto").html('');
		} 
	}else{
		$(".e_cargarTipoEfecto").html('');
	}
	 
  });
  $("body").on("submit", "#f_parametrosCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_parametrosCrear #Par_Pla_Codigo").val();
    d_nombre = $("#f_parametrosCrear #Par_Nombre").val();
    d_tipo = $("#f_parametrosCrear #Par_Estado").val();
	d_efecto = $("#f_parametrosCrear #Par_Efecto").val();
    $.ajax({
      type: "POST",
      url: "op_parametrosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_parametrosCrear");
        $("#Btn_ParametrosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_parametrosCrear");
        $("#Btn_ParametrosCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre,
        tipo: d_tipo,
		efecto: d_efecto
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ParametrosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_ParametrosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_ParametrosNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_ParametrosNotificacionesCrear").modal('hide');
    $("#vtn_ParametrosCrear").modal('hide');

    d_planta = $("#filtroParametros_Planta").val();
    d_estado = $("#filtroParametros_Estado").val();
	d_tipo = $("#filtroParametros_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_parametrosListar.php",
      beforeSend: function () {
        $(".info_ParametrosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
		tipo: d_tipo
      },
      success: function (data) {
        $(".info_ParametrosListar").html(data);
        $("#tbl_parametrosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarParametro", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_ParametrosActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_parametrosActualizar.php",
      beforeSend: function () {
        $(".info_ParametrosActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_ParametrosActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Par_TipoAct", function(e){
    e.preventDefault();
  	
	d_codigo: $("#codigoAct").val();
	tipo = $("#Par_TipoAct").val();
	d_planta = $("#f_ParametrosActualizar #Par_Pla_CodigoAct").val();
	if(tipo==8){
      $.ajax({
        type: "POST",
        url: "f_cargarEfectoFTActualizar.php",
        beforeSend: function () {
          $(".e_cargarEfectosAct").html(loader());
        },
        data: {
			codigo: d_codigo, planta: d_planta
        },
        success: function (data) {
          $(".e_cargarEfectosAct").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
	}else {
	 $(".e_cargarEfectosAct").html('');
	}  
  });	
	
  $("body").on("submit", "#f_ParametrosActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_ParametrosActualizar #codigoAct").val();
    d_planta = $("#f_ParametrosActualizar #Par_Pla_CodigoAct").val();
    d_nombre = $("#f_ParametrosActualizar #Par_NombreAct").val();
    d_tipo = $("#f_ParametrosActualizar #Par_TipoAct").val();
    d_estado = $("#f_ParametrosActualizar #Par_EstadoAct").val();
    d_efecto = $("#f_ParametrosActualizar #Par_EfectoAct").val();

    $.ajax({
      type: "POST",
      url: "op_parametrosActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_ParametrosActualizar");
        $("#Btn_ParametrosActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_ParametrosActualizar");
        $("#Btn_ParametrosActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        tipo: d_tipo,
        estado: d_estado,
		efecto: d_efecto
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ParametrosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_ParametrosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_ParametrosNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_ParametrosNotificacionesActualizar").modal('hide');
    $("#vtn_ParametrosActualizar").modal('hide');

    d_planta = $("#filtroParametros_Planta").val();
    d_estado = $("#filtroParametros_Estado").val();
	d_tipo = $("#filtroParametros_Tipo").val();

    $.ajax({
      type: "POST",
      url: "f_parametrosListar.php",
      beforeSend: function () {
        $(".info_ParametrosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
		tipo: d_tipo
      },
      success: function (data) {
        $(".info_ParametrosListar").html(data);
        $("#tbl_parametrosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarParametro", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_ParametrosConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_ParametrosEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_ParametrosConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_ParametrosEliminar").val();
    $("#vtn_ParametrosConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_parametrosEliminar.php",
      beforeSend: function () {
        $("#e_eliminarParametro").hide();
      },
      complete: function () {
        $("#e_eliminarParametro").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ParametrosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_ParametrosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

    $("body").on("click", "#Btn_ParametrosNotificacionesEliminar", function (e) {
      e.preventDefault();

      $("#vtn_ParametrosNotificacionesEliminar").modal('hide');

      d_planta = $("#filtroParametros_Planta").val();
      d_estado = $("#filtroParametros_Estado").val();

      $.ajax({
        type: "POST",
        url: "f_parametrosListar.php",
        beforeSend: function () {
          $(".info_ParametrosListar").html(loader());
        },
        data: {
          planta: d_planta,
          estado: d_estado
        },
        success: function (data) {
          $(".info_ParametrosListar").html(data);
          $("#tbl_parametrosListar").tablesorter();
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    });
  });

}); // JavaScript Document
