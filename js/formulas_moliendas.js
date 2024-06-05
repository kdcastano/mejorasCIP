$(document).ready(function(e) {
  $('#filtroFormulasM_Planta').multiselect({
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
$("body").on("click", "#Btn_FormulasMBuscar", function(e){
    e.preventDefault();
	  d_planta = $("#filtroFormulasM_Planta").val();
	  d_estado = $("#filtroFormulasM_Estado").val();

	  $.ajax({
        type:"POST",
        url:"f_formulasMoliendasListar.php",
        beforeSend: function() {
          $(".info_formulasMListar").html(loader());
        },
        data:{ 
          planta: d_planta,
		  estado: d_estado
		},
        success: function(data) {
          $(".info_formulasMListar").html(data);
		  $("#tbl_formatosListar").tablesorter();
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
	});
  });

  $("body").on("click", "#Btn_FormulasMCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormulasMCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_formulasMoliendasCrear.php",
      beforeSend: function () {
        $(".info_FormulasMCrear").html(loader());
      },
      success: function (data) {
        $(".info_FormulasMCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_formulasMCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_formulasMCrear #ForM_Pla_Codigo").val();
    d_nombre = $("#f_formulasMCrear #ForM_Nombre").val();
    d_tipo = $("#f_formulasMCrear #ForM_Tipo").val();
    d_archivo = $("#f_formulasMCrear #i_Arc_FormulasMolienda_Archivo").val();

    $.ajax({
      type: "POST",
      url: "op_formulasMoliendasCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_formulasMCrear");
        $("#Btn_FormulasMCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_formulasMCrear");
        $("#Btn_FormulasMCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre,
        tipo: d_tipo,
        archivo: d_archivo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormulasMNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormulasMCrearNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_FormulasMNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormulasMCrearNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_FormulasMNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormulasMNotificacionesCrear").modal('hide');
    $("#vtn_FormulasMCrear").modal('hide');

      d_planta = $("#filtroFormulasM_Planta").val();
	  d_estado = $("#filtroFormulasM_Estado").val();

	  $.ajax({
        type:"POST",
        url:"f_formulasMoliendasListar.php",
        beforeSend: function() {
          $(".info_formulasMListar").html(loader());
        },
        data:{ 
          planta: d_planta,
		  estado: d_estado
		},
        success: function(data) {
          $(".info_formulasMListar").html(data);
		  $("#tbl_formatosListar").tablesorter();
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
	});
  });

$("body").on("click", ".e_editarFormulas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormulasMActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_formulasMoliendasActualizar.php",
      beforeSend: function () {
        $(".info_FormulasMActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_FormulasMActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_formulasMActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_formulasMActualizar #codigoAct").val();
    d_planta = $("#f_formulasMActualizar #ForM_Pla_CodigoAct").val();
    d_nombre = $("#f_formulasMActualizar #ForM_NombreAct").val();
    d_tipo = $("#f_formulasMActualizar #ForM_TipoAct").val();
    d_estado = $("#f_formulasMActualizar #ForM_EstadoAct").val();
    d_archivo = $("#f_formulasMActualizar #i_Arc_FormulasMolienda_ArchivoAct").val();
    d_codigoArchivo = $("#f_formulasMActualizar #codigoArchivo").val();

    $.ajax({
      type: "POST",
      url: "op_formulasMoliendasActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_formulasMActualizar");
        $("#Btn_FormulasMActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_formulasMActualizar");
        $("#Btn_FormulasMActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        tipo: d_tipo,
        estado: d_estado,
        archivo: d_archivo,
        codigoArchivo: d_codigoArchivo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormulasMNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormulasMActualizarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_FormulasMNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormulasMActualizarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_FormulasMNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_FormulasMNotificacionesActualizar").modal('hide');
    $("#vtn_FormulasMActualizar").modal('hide');

      d_planta = $("#filtroFormulasM_Planta").val();
	  d_estado = $("#filtroFormulasM_Estado").val();

	  $.ajax({
        type:"POST",
        url:"f_formulasMoliendasListar.php",
        beforeSend: function() {
          $(".info_formulasMListar").html(loader());
        },
        data:{ 
          planta: d_planta,
		  estado: d_estado
		},
        success: function(data) {
          $(".info_formulasMListar").html(data);
		  $("#tbl_formatosListar").tablesorter();
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
	});
  });
  
  $("body").on("click", ".e_eliminarFormulas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormulasMoliendaConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_formulasMoliendaEliminar").val(d_codigo);

  });
  
  $("body").on("click", "#Btn_FormulasMoliendaConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_formulasMoliendaEliminar").val();
    $("#vtn_FormulasMoliendaConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_formulasMoliendasEliminar.php",
      beforeSend: function () {
        $("#e_eliminarFormulas").hide();
      },
      complete: function () {
        $("#e_eliminarFormulas").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormulasMNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormulasMEliminarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_FormulasMNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormulasMEliminarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_FormulasMNotificacionesEliminar", function (e) {
      e.preventDefault();

      $("#vtn_FormulasMNotificacionesEliminar").modal('hide');

      d_planta = $("#filtroFormulasM_Planta").val();
      d_estado = $("#filtroFormulasM_Estado").val();

      $.ajax({
          type:"POST",
          url:"f_formulasMoliendasListar.php",
          beforeSend: function() {
            $(".info_formulasMListar").html(loader());
          },
          data:{ 
            planta: d_planta,
        estado: d_estado
      },
          success: function(data) {
            $(".info_formulasMListar").html(data);
        $("#tbl_formatosListar").tablesorter();
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
    });
  });
  
  $("body").on("click", ".e_historialFormulas", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_HistorialFM").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_formulasMoliendasHistorial.php",
      beforeSend: function() {
        $(".info_HistorialFM").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_HistorialFM").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
});