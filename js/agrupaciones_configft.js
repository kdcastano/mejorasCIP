$(document).ready(function (e) {
  $('#filtroAgrupacionesConfigft_Planta').multiselect({
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

  $("body").on("click", "#Btn_AgrupacionesConfigftBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroAgrupacionesConfigft_Planta").val();
    d_estado = $("#filtroAgrupacionesConfigft_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesConfigftListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesConfigftListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AgrupacionesConfigftListar").html(data);
        $("#tbl_agrupacionesConfigftListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_AgrupacionesConfigftCrear", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesConfigftCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_agrupacionesConfigftCrear.php",
      beforeSend: function () {
        $(".info_AgrupacionesConfigftCrear").html(loader());
      },
      success: function (data) {
        $(".info_AgrupacionesConfigftCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_agrupacionesConfigftCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_agrupacionesConfigftCrear #AgrC_Pla_Codigo").val();
    d_nombre = $("#f_agrupacionesConfigftCrear #AgrC_Nombre").val();
    d_archivo = $("#f_agrupacionesConfigftCrear #i_Arc_AgrCFT_Archivo").val();
    d_tomaVariables = $("#f_agrupacionesConfigftCrear #AgrC_TomaVariable").val();
    d_ordenamiento = $("#f_agrupacionesConfigftCrear #AgrC_Ordenamiento").val();
    d_tipo = $("#f_agrupacionesConfigftCrear #AgrC_Tipo").val();
    d_puntoControl = $("#f_agrupacionesConfigftCrear #AgrC_PuntoControl").val();
    d_tipoVariable = $("#f_agrupacionesConfigftCrear #AgrC_TipoVariable").val();
    d_unidadMedida = $("#f_agrupacionesConfigftCrear #AgrC_UnidadMedida").val();
    d_crearVariable = $("#f_agrupacionesConfigftCrear #crearVariable").val();
    
    d_lista1 = [];
    d_lista2 = [];
    d_lista3 = [];
    
		cont = 0;
		$(".Inp_TurnosSel").each(function(){
			
			d_lista1[cont] = $(this).attr("data-tur");
      d_lista2[cont] = $(this).attr("data-hor");
      a = $(this).attr("data-num");
      
      if($("#Inp_ValCrear"+a).prop("checked") == true){
				d_lista3[cont] = 1;
			}else{
				d_lista3[cont] = 0;
			}
      
			cont++;
		});
		d_num = cont;
    
    if(d_crearVariable == "1"){
      $.ajax({
        type: "POST",
        url: "op_agrupacionesConfigftCrear.php",
        beforeSend: function () {
          bloquearFormulario("f_agrupacionesConfigftCrear");
          $("#Btn_AgrupacionesConfigftCrearForm").hide();
        },
        complete: function () {
          desbloquearFormulario("f_agrupacionesConfigftCrear");
          $("#Btn_AgrupacionesConfigftCrearForm").show();
        },
        data: {
          planta: d_planta,
          nombre: d_nombre,
          archivo: d_archivo,
          tomaVariable: d_tomaVariables,
          ordenamiento: d_ordenamiento,
          tipo: d_tipo,
          puntoControl: d_puntoControl,
          tipoVariable: d_tipoVariable,
          unidadMedida: d_unidadMedida,
          lista1: d_lista1,
          lista2: d_lista2,
          lista3: d_lista3,
          num: d_num
        },
        dataType: 'json',
        success: function (rs) {
          if (rs.mensaje == "OK") {
            $("#vtn_AgrupacionesConfigftNotificacionesCrear").modal({
              backdrop: 'static'
            });
            $(".info_AgrupacionesConfigftCrearNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
          } else {
            $("#vtn_AgrupacionesConfigftNotificacionesCrear").modal({
              backdrop: 'static'
            });
            $(".info_AgrupacionesConfigftCrearNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
            mensaje('2', rs.mensaje);
          }
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    }else{
      $(".cargar_variableExiste").html('<br><div class="alert alert-danger"> <strong>Esta variable ya existe en el sistema, por favor cambiarla</strong> </div>');
    }
    
  });

  $("body").on("click", "#Btn_AgrupacionesConfigftNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesConfigftNotificacionesCrear").modal('hide');
    $("#vtn_AgrupacionesConfigftCrear").modal('hide');

    d_planta = $("#filtroAgrupacionesConfigft_Planta").val();
    d_estado = $("#filtroAgrupacionesConfigft_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesConfigftListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesConfigftListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AgrupacionesConfigftListar").html(data);
        $("#tbl_agrupacionesConfigftListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarAgrupacionesConfigft", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_AgrupacionesConfigftActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_agrupacionesConfigftActualizar.php",
      beforeSend: function () {
        $(".info_AgrupacionesConfigftActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_AgrupacionesConfigftActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#f_agrupacionesConfigftCrear #AgrC_Tipo", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_agrupacionesConfigftCrear #AgrC_Nombre").val();
   d_planta = $("#f_agrupacionesConfigftCrear #codigoPlanta").val();
   d_tipo = $("#f_agrupacionesConfigftCrear #AgrC_Tipo").val();
   
   $.ajax({
    type:"POST",
    url:"f_cargarValVariablesControl.php",
    beforeSend: function() {
      $(".cargar_variableExiste").html(loader());
    },
    data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo },
    success: function(data) {
      $(".cargar_variableExiste").html(data);
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  });
  
  $("body").on("change", "#f_agrupacionesConfigftCrear #AgrC_Nombre", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_agrupacionesConfigftCrear #AgrC_Nombre").val();
   d_planta = $("#f_agrupacionesConfigftCrear #codigoPlanta").val();
   d_tipo = $("#f_agrupacionesConfigftCrear #AgrC_Tipo").val();
   
   $.ajax({
      type:"POST",
      url:"f_cargarValVariablesControl.php",
      beforeSend: function() {
        $(".cargar_variableExiste").html(loader());
      },
      data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".cargar_variableExiste").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });

  $("body").on("submit", "#f_agrupacionesConfigftActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_agrupacionesConfigftActualizar #codigoAct").val();
    d_planta = $("#f_agrupacionesConfigftActualizar #AgrC_Pla_CodigoAct").val();
    d_nombre = $("#f_agrupacionesConfigftActualizar #AgrC_NombreAct").val();
    d_estado = $("#f_agrupacionesConfigftActualizar #AgrC_EstadoAct").val();
    d_archivo = $("#f_agrupacionesConfigftActualizar #i_Arc_AgrCFT_ArchivoAct").val();
    d_tomaVariables = $("#f_agrupacionesConfigftActualizar #AgrC_TomaVariableAct").val();
    d_ordenamiento = $("#f_agrupacionesConfigftActualizar #AgrC_OrdenamientoAct").val();
    d_tipo = $("#f_agrupacionesConfigftActualizar #AgrC_TipoAct").val();
    d_puntoControl = $("#f_agrupacionesConfigftActualizar #AgrC_PuntoControlAct").val();
    d_tipoVariable = $("#f_agrupacionesConfigftActualizar #AgrC_TipoVariableAct").val();
    d_unidadMedida = $("#f_agrupacionesConfigftActualizar #AgrC_UnidadMedidaAct").val();
    
    d_lista1 = []; // turno
    d_lista2 = []; // hora
    d_lista3 = []; // acción
    d_lista4 = []; // codigo frecuencia
    d_lista5 = []; // estado
    
		cont = 0;
		$(".Inp_TurnosSel").each(function(){
			
			d_lista1[cont] = $(this).attr("data-tur");
      d_lista2[cont] = $(this).attr("data-hor");
      d_lista3[cont] = $(this).attr("data-acc");
      d_lista4[cont] = $(this).attr("data-codfre");
      a = $(this).attr("data-num");
      
      if($("#Inp_ValAct"+a).prop("checked") == true){
				d_lista5[cont] = 1;
			}else{
				d_lista5[cont] = 0;
			}
      
			cont++;
		});
		d_num = cont;

    $.ajax({
      type: "POST",
      url: "op_AgrupacionesConfigftActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_agrupacionesConfigftActualizar");
        $("#Btn_AgrupacionesConfigftActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_agrupacionesConfigftActualizar");
        $("#Btn_AgrupacionesConfigftActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        estado: d_estado,
        archivo: d_archivo,
        tomaVariable: d_tomaVariables,
        ordenamiento: d_ordenamiento,
        tipo: d_tipo,
        puntoControl: d_puntoControl,
        tipoVariable: d_tipoVariable,
        unidadMedida: d_unidadMedida,
        lista1: d_lista1,
        lista2: d_lista2,
        lista3: d_lista3,
        lista4: d_lista4,
        lista5: d_lista5,
        num: d_num
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesConfigftNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesConfigftActualizarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesConfigftNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesConfigftActualizarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
$("body").on("click", "#Btn_AgrupacionesConfigftNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesConfigftNotificacionesActualizar").modal('hide');
    $("#vtn_AgrupacionesConfigftActualizar").modal('hide');

    d_planta = $("#filtroAgrupacionesConfigft_Planta").val();
    d_estado = $("#filtroAgrupacionesConfigft_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesConfigftListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesConfigftListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AgrupacionesConfigftListar").html(data);
        $("#tbl_agrupacionesConfigftListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarAgrupacionesConfigft", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_VariablesControlNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_VarControl").val(d_codigo);

  });
  
  $("body").on("click", "#Btn_VariablesControlNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_VarControl").val();
    
    $("#vtn_VariablesControlNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_agrupacionesConfigftEliminar.php",
      beforeSend: function () {
        $("#e_eliminarAgrupacionesConfigft").hide();
      },
      complete: function () {
        $("#e_eliminarAgrupacionesConfigft").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesConfigftNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesConfigftEliminarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesConfigftNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesConfigftEliminarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
$("body").on("click", "#Btn_AgrupacionesConfigftNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesConfigftNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroAgrupacionesConfigft_Planta").val();
    d_estado = $("#filtroAgrupacionesConfigft_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesConfigftListar.php",
      beforeSend: function () {
        $(".info_AgrupacionesConfigftListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AgrupacionesConfigftListar").html(data);
        $("#tbl_AgrupacionesConfigftListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#AgrC_Pla_Codigo", function(e){
    e.preventDefault();
    
    d_planta = $("#f_agrupacionesConfigftCrear #AgrC_Pla_Codigo").val();
    
    $.ajax({
      type: "POST",
      url: "f_cargarTurnos.php",
      beforeSend: function () {
        $(".e_cargarTurnosAgrupaciones").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarTurnosAgrupaciones").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", ".Int_SeleccionTodos", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSel").prop("checked", true);
    } else {
      $(".Inp_TurnosSel").prop("checked", false);
    }
  });

  $("body").on("change", ".Int_SeleccionTodosAgruCFTAct", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSel").prop("checked", true);
    } else {
      $(".Inp_TurnosSel").prop("checked", false);
    }
  });
}); // JavaScript Document