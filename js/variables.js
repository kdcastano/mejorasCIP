$(document).ready(function (e) {

  $('#filtroVariables_Planta').multiselect({
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
  $('#filtroVariables_Area').multiselect({
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
  $('#filtroVariables_Maquina').multiselect({
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

  $("body").on("click", "#Btn_VariablesBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroVariables_Planta").val();
    d_area = $("#filtroVariables_Area").val();
    d_maquina = $("#filtroVariables_Maquina").val();
    d_estado = $("#filtroVariables_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_variablesListar.php",
      beforeSend: function () {
        $(".info_VariablesListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        maquina: d_maquina,
        estado: d_estado
      },
      success: function (data) {
        $(".info_VariablesListar").html(data);
        $("#tbl_variablesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_VariablesCrear", function (e) {
    e.preventDefault();

    $("#vtn_VariablesCrear").modal({
      backdrop: 'static'
    });
    $.ajax({
      type: "POST",
      url: "f_variablesCrear.php",
      beforeSend: function () {
        $(".info_VariablesCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_VariablesCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo").val();
    d_tipo = "2";

    $.ajax({
      type: "POST",
      url: "f_cargarAreas.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta,
        tipo: d_tipo
      },
      success: function (data) {
        $(".e_cargarAreaCrear").html(data);
		$.ajax({
          type:"POST",
          url:"f_cargarTurnos.php",
          beforeSend: function() {
            $(".e_cargarTurnos").html(loader());
          },
          data:{ planta: d_planta },
          success: function(data) {
            $(".e_cargarTurnos").html(data);
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
        });
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Are_Codigo", function (e) {
    e.preventDefault();

    d_area = $("#Are_Codigo").val();
    $.ajax({
      type: "POST",
      url: "f_cargarMaquinas.php",
      beforeSend: function () {
        $(".e_cargarMaquinaCrear").html(loader());
      },
      data: {
        area: d_area
      },
      success: function (data) {
        $(".e_cargarMaquinaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

   $("body").on("submit", "#f_VariablesCrear", function (e) {
    e.preventDefault();

    d_maquina = $("#f_VariablesCrear #Maq_Codigo").val();
    d_nombre = $("#f_VariablesCrear #Var_Nombre").val();
    d_tipo = $("#f_VariablesCrear #Var_Tipo").val();
    d_origen = $("#f_VariablesCrear #Var_Origen").val();
    d_uMedida = $("#f_VariablesCrear #Var_UnidadDeMedida").val();
    d_vControl = $("#f_VariablesCrear #Var_ValorControl").val();
    d_tolerancia = $("#f_VariablesCrear #Var_ValorTolerancia").val();
    d_operador = $("#f_VariablesCrear #Var_Operador").val();
    d_tipoVariable = $("#f_VariablesCrear #Var_TipoVariable").val();
    d_puntoControl = $("#f_VariablesCrear #Var_PuntoControl").val();
    d_archivo = $("#f_VariablesCrear #i_Arc_Variables_Archivo").val();
    d_orden = $("#f_VariablesCrear #Var_Orden").val();
    d_crearVariable = $("#f_VariablesCrear #crearVariableGenerales").val();
	  d_lista1 = [];
    d_lista2 = [];
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
        url: "op_variablesCrear.php",
        beforeSend: function () {
          bloquearFormulario("f_VariablesCrear");
          $("#Btn_FormatosAreasCrearForm").hide();
        },
        complete: function () {
          desbloquearFormulario("f_VariablesCrear");
          $("#Btn_FormatosAreasCrearForm").show();
        },
        data: {
          maquina: d_maquina,
          nombre: d_nombre,
          tipo: d_tipo,
          origen: d_origen,
          medida: d_uMedida,
          control: d_vControl,
          tolerancia: d_tolerancia,
          operador: d_operador,
          lista1: d_lista1,
          lista2: d_lista2,
          lista3: d_lista3,
          num: d_num,
          tipoVariable: d_tipoVariable,
          puntoControl: d_puntoControl,
          archivo: d_archivo,
          orden: d_orden
        },
        dataType: 'json',
        success: function (rs) {
          if (rs.mensaje == "OK") {
            $("#vtn_VariablesNotificacionesCrear").modal({
              backdrop: 'static'
            });
            $(".info_VariablesNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

          } else {
            $("#vtn_VariablesNotificacionesCrear").modal({
              backdrop: 'static'
            });
            $(".info_VariablesNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
            mensaje('2', rs.mensaje);
          }
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    }else{
      $(".cargar_variableExisteRespuesta").html('<br><div class="alert alert-danger"> <strong>Esta variable ya existe en el sistema, por favor cambiarla</strong> </div>');
    }
  });

  $("body").on("click", "#Btn_VariablesNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_VariablesNotificacionesCrear").modal('hide');
    $("#vtn_VariablesCrear").modal('hide');

    d_planta = $("#filtroVariables_Planta").val();
    d_area = $("#filtroVariables_Area").val();
    d_estado = $("#filtroVariables_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_variablesListar.php",
      beforeSend: function () {
        $(".info_VariablesListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado
      },
      success: function (data) {
        $(".info_VariablesListar").html(data);
        $("#tbl_variablesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarVariables", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_VariablesActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_variablesActualizar.php",
      beforeSend: function () {
        $(".info_VariablesActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_VariablesActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_CodigoAct", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_CodigoAct").val();
    d_tipo = "2";

    $.ajax({
      type: "POST",
      url: "f_cargarAreasActualizar.php",
      beforeSend: function () {
        $(".e_cargarAreaActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        tipo: d_tipo
      },
      success: function (data) {
        $(".e_cargarAreaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Are_CodigoAct", function (e) {
    e.preventDefault();

    d_area = $("#Are_CodigoAct").val();
    $.ajax({
      type: "POST",
      url: "f_cargarMaquinaActualizar.php",
      beforeSend: function () {
        $(".e_cargarMaquinaActualizar").html(loader());
      },
      data: {
        area: d_area
      },
      success: function (data) {
        $(".e_cargarMaquinaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
	
  $("body").on("submit", "#f_VariablesActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_VariablesActualizar #codigoAct").val();
    d_maquina = $("#f_VariablesActualizar #Maq_CodigoAct").val();
    d_nombre = $("#f_VariablesActualizar #Var_NombreAct").val();
    d_tipo = $("#f_VariablesActualizar #Var_TipoAct").val();
    d_origen = $("#f_VariablesActualizar #Var_OrigenAct").val();
    d_uMedida = $("#f_VariablesActualizar #Var_UnidadDeMedidaAct").val();
    d_vControl = $("#f_VariablesActualizar #Var_ValorControlAct").val();
    d_tolerancia = $("#f_VariablesActualizar #Var_ValorToleranciaAct").val();
    d_operador = $("#f_VariablesActualizar #Var_OperadorAct").val();
    d_estado = $("#f_VariablesActualizar #Var_EstadoAct").val();
    d_tipoVariable = $("#f_VariablesActualizar #Var_TipoVariableAct").val();
    d_puntoControl = $("#f_VariablesActualizar #Var_PuntoControlAct").val();
    d_archivo = $("#f_VariablesActualizar #i_Arc_Variables_ArchivoAct").val();
    d_orden = $("#f_VariablesActualizar #Var_OrdenAct").val();
	  d_codigoVar = $(this).attr("data-cod");  

	  d_lista1 = [];
    d_lista2 = [];
    d_lista3 = [];
    d_lista4 = [];
    d_lista5 = [];
    
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
      url: "op_variablesActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_VariablesActualizar");
        $("#Btn_VariablesActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_VariablesActualizar");
        $("#Btn_VariablesActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        maquina: d_maquina,
        nombre: d_nombre,
        tipo: d_tipo,
        origen: d_origen,
        medida: d_uMedida,
        control: d_vControl,
        tolerancia: d_tolerancia,
        operador: d_operador,
		    estado: d_estado,
		    lista1: d_lista1,
        lista2: d_lista2,
        lista3: d_lista3,
        lista4: d_lista4,
        lista5: d_lista5,
        codVariables: d_codigoVar,
        num: d_num,
        tipoVariable: d_tipoVariable,
        puntoControl: d_puntoControl,
        archivo: d_archivo,
        orden: d_orden
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_VariablesNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_VariablesNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');

        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_VariablesNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_VariablesNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_VariablesNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_VariablesNotificacionesActualizar").modal('hide');
    $("#vtn_VariablesActualizar").modal('hide');

    d_planta = $("#filtroVariables_Planta").val();
    d_area = $("#filtroVariables_Area").val();
    d_estado = $("#filtroVariables_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_variablesListar.php",
      beforeSend: function () {
        $(".info_VariablesListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado
      },
      success: function (data) {
        $(".info_VariablesListar").html(data);
        $("#tbl_variablesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarVariables", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_VariablesConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_VariablesEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_VariablesConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_VariablesEliminar").val();
    $("#vtn_VariablesConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_variablesEliminar.php",
      beforeSend: function () {
        $(".e_eliminarVariables").hide();
      },
      complete: function () {
        $(".e_eliminarVariables").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_VariablesNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_VariablesNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          $("#vtn_VariablesNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_VariablesNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_VariablesNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_VariablesNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroVariables_Planta").val();
    d_area = $("#filtroVariables_Area").val();
    d_estado = $("#filtroVariables_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_variablesListar.php",
      beforeSend: function () {
        $(".info_VariablesListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado
      },
      success: function (data) {
        $(".info_VariablesListar").html(data);
        $("#tbl_variablesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

 
  $("body").on("click", ".e_ingresarInfoVariablesOperadorMasivo", function (e) {
    e.preventDefault();

    $("#vtn_VariablesMasivasCrear").modal({
      backdrop: 'static'
    });

    d_codigo = $(this).attr("data-estu");
    d_hora = $(this).attr("data-hor");
    d_formato = $(this).attr("data-for");
    d_familia = $(this).attr("data-fam");
    d_color = $(this).attr("data-col");
    d_progProd = $(this).attr("data-prop");
    d_fecha = $(this).attr("data-fec");

    $.ajax({
      type: "POST",
      url: "f_variablesMasivasCrear.php",
      beforeSend: function () {
        $(".info_VariablesMasivasCrear").html(loader());
      },
      data: {
        codigo: d_codigo,
        hora: d_hora,
        formato: d_formato,
        familia: d_familia,
        color: d_color,
        codProgrProd: d_progProd,
        fecha: d_fecha
      },
      success: function (data) {
        $(".info_VariablesMasivasCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  }); 
  

  $("body").on("click", ".Btn_GuardarTomaVariableMasivo", function (e) {
    e.preventDefault();

    d_variable = $(this).attr("data-var");
    d_estacionUsuario = $(this).attr("data-estu");
    d_hora = $(this).attr("data-hor");
    d_valor = $("#VM_Valor" + d_variable).val();

    $.ajax({
      type: "POST",
      url: "op_variablesMasivasCrear.php",
      beforeSend: function () {
        $(".e_valBtnGuaMTV" + d_variable).hide();
      },
      complete: function () {
        $(".e_valBtnGuaMTV" + d_variable).show();
      },
      data: {
        variable: d_variable,
        estacionUsuario: d_estacionUsuario,
        hora: d_hora,
        valor: d_valor
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $(".EspBtnCrearM_" + d_variable).html('<span class="glyphicon glyphicon-ok verde letra14"></span>');
          $("#VM_Valor" + d_variable).attr("disabled", "true");
        } else {
          $(".e_valBtnGuaMTV" + d_variable).show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".Btn_ActualizarTomaVariableMasivo", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    d_variable = $(this).attr("data-var");
    d_valor = $("#VM_Valor" + d_variable).val();

    $.ajax({
      type: "POST",
      url: "op_variablesMasivasActualizar.php",
      beforeSend: function () {
        $(".e_valBtnActMTV" + d_variable).hide();
      },
      complete: function () {
        $(".e_valBtnActMTV" + d_variable).show();
      },
      data: {
        codigo: d_codigo,
        valor: d_valor
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $(".EspBtnActM_" + d_variable).html('<span class="glyphicon glyphicon-ok verde letra14"></span>');
          $("#VM_Valor" + d_variable).attr("disabled", "true");
        } else {
          $(".e_valBtnActMTV" + d_variable).show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".Rec_PanelOperador", function (e) {
    e.preventDefault();

    d_codigo = $(".EstU_Codigo_GlobalPanelDetalle").val();

    $.ajax({
      type: "POST",
      url: "f_panelOperadorVariables.php",
      beforeSend: function () {
        $(".info_PanelVariablesUsuarioOperadorActual").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_PanelVariablesUsuarioOperadorActual").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_ingresarInfoVariablesOperadorMasivoPokayoque", function (e) {
    e.preventDefault();

    $("#vtn_VariablesMasivasCrear").modal({
      backdrop: 'static'
    });

    d_codigo = $(this).attr("data-estu");
    d_hora = $(this).attr("data-hor");
    d_formato = $(this).attr("data-for");
    d_familia = $(this).attr("data-fam");
    d_color = $(this).attr("data-col");
    d_programaProduccion = $(this).attr("data-prop");
    d_fecha = $(this).attr("data-fec");

    $.ajax({
      type: "POST",
      url: "f_variablesMasivasPokayokeCrear.php",
      beforeSend: function () {
        $(".info_VariablesMasivasCrear").html(loader());
      },
      data: {
        codigo: d_codigo,
        hora: d_hora,
        formato: d_formato,
        familia: d_familia,
        color: d_color,
        programaProduccion: d_programaProduccion,
        fecha: d_fecha
      },
      success: function (data) {
        $(".info_VariablesMasivasCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".Btn_GuardarTomaVariableMasivoPok", function (e) {
    e.preventDefault();

    d_variable = $(this).attr("data-var");
    d_estacionUsuario = $(this).attr("data-estu");
    d_hora = $(this).attr("data-hor");

    if ($("#VM_Valor" + d_variable).prop("checked") == true) {
      d_valor = 1;
    } else {
      d_valor = 0;
    }

    $.ajax({
      type: "POST",
      url: "op_variablesMasivasPokCrear.php",
      beforeSend: function () {
        $(".e_valBtnGuaMTV" + d_variable).hide();
      },
      complete: function () {
        $(".e_valBtnGuaMTV" + d_variable).show();
      },
      data: {
        variable: d_variable,
        estacionUsuario: d_estacionUsuario,
        hora: d_hora,
        valor: d_valor
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $(".EspBtnCrearM_" + d_variable).html('<span class="glyphicon glyphicon-ok verde letra14"></span>');
          $("#VM_Valor" + d_variable).attr("disabled", "true");
        } else {
          $(".e_valBtnGuaMTV" + d_variable).show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".Btn_ActualizarTomaVariableMasivoPok", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    d_variable = $(this).attr("data-var");

    if ($("#VM_Valor" + d_variable).prop("checked") == true) {
      d_valor = 1;
    } else {
      d_valor = 0;
    }

    $.ajax({
      type: "POST",
      url: "op_variablesMasivasActualizar.php",
      beforeSend: function () {
        $(".e_valBtnActMTV" + d_variable).hide();
      },
      complete: function () {
        $(".e_valBtnActMTV" + d_variable).show();
      },
      data: {
        codigo: d_codigo,
        valor: d_valor
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $(".EspBtnActM_" + d_variable).html('<span class="glyphicon glyphicon-ok verde letra14"></span>');
          $("#VM_Valor" + d_variable).attr("disabled", "true");
        } else {
          $(".e_valBtnActMTV" + d_variable).show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".e_cargarVariablesSegundaInforme", function(e){
    e.preventDefault();
    
    d_formato = $(this).attr("data-for");
    d_familia = $(this).attr("data-fam");
    d_color = $(this).attr("data-col");
    d_hora = $(this).attr("data-hor");
    d_fecha = $(this).attr("data-fec");
    
     $("#vtn_VariablesMasivasCalidadListarInfoSegundaCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_variablesMasivasCalidadListarTS.php",
      beforeSend: function() {
        $(".info_VariablesMasivasCalidadListarInfoSegundaCrear").html(loader());
      },
      data:{ formato: d_formato, familia: d_familia, color: d_color, hora: d_hora, fecha: d_fecha },
      success: function(data) {
        $(".info_VariablesMasivasCalidadListarInfoSegundaCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".e_cargarVariablesRoturaInforme", function(e){
    e.preventDefault();
    
    d_formato = $(this).attr("data-for");
    d_familia = $(this).attr("data-fam");
    d_color = $(this).attr("data-col");
    d_hora = $(this).attr("data-hor");
    d_fecha = $(this).attr("data-fec");
    
     $("#vtn_VariablesMasivasCalidadListarInfoRoturaCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_variablesMasivasCalidadListarTSRotura.php",
      beforeSend: function() {
        $(".info_VariablesMasivasCalidadListarInfoRoturaCrear").html(loader());
      },
      data:{ formato: d_formato, familia: d_familia, color: d_color, hora: d_hora, fecha: d_fecha },
      success: function(data) {
        $(".info_VariablesMasivasCalidadListarInfoRoturaCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });  
  });

  $("body").on("change", ".Int_SeleccionTodosVariablesAct", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSel").prop("checked", true);
    } else {
      $(".Inp_TurnosSel").prop("checked", false);
    }
  });
  
  $("body").on("change", ".Int_SeleccionTodos", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSel").prop("checked", true);
    } else {
      $(".Inp_TurnosSel").prop("checked", false);
    }
  });
  
  $("body").on("change", "#f_VariablesCrear #Var_PuntoControl", function(e){
    e.preventDefault();
    
    d_puntoControl = $("#f_VariablesCrear #Var_PuntoControl").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarTipoVariable.php",
      beforeSend: function() {
        $(".e_cargarTipoVariable").html(loader());
      },
      data:{ puntoControl: d_puntoControl },
      success: function(data) {
        $(".e_cargarTipoVariable").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#f_VariablesActualizar #Var_PuntoControlAct", function(e){
    e.preventDefault();
    
    d_puntoControl = $("#f_VariablesActualizar #Var_PuntoControlAct").val();
    d_codigo = $("#f_VariablesActualizar #codigoAct").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarTipoVariableActualizar.php",
      beforeSend: function() {
        $(".e_cargarTipoVariableAct").html(loader());
      },
      data:{ puntoControl: d_puntoControl, codigo: d_codigo },
      success: function(data) {
        $(".e_cargarTipoVariableAct").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
    
  });
  
  $("body").on("change", "#f_VariablesCrear #Var_Tipo", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_VariablesCrear #Var_Nombre").val();
   d_planta = $("#f_VariablesCrear #codigoPlanta").val();
   d_tipo = $("#f_VariablesCrear #Var_Tipo").val();
   d_maquina = $("#f_VariablesCrear #Maq_Codigo").val();
   
   $.ajax({
    type:"POST",
    url:"f_cargarValVariablesGenerales.php",
    beforeSend: function() {
      $(".e_cargarTipoVariable").html(loader());
    },
    data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo, maquina: d_maquina },
    success: function(data) {
      $(".e_cargarTipoVariable").html(data);
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  });
  
  $("body").on("change", "#f_VariablesCrear #Var_Nombre", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_VariablesCrear #Var_Nombre").val();
   d_planta = $("#f_VariablesCrear #codigoPlanta").val();
   d_tipo = $("#f_VariablesCrear #Var_Tipo").val();
   d_maquina = $("#f_VariablesCrear #Maq_Codigo").val();
   
   $.ajax({
      type:"POST",
      url:"f_cargarValVariablesGenerales.php",
      beforeSend: function() {
        $(".e_cargarTipoVariable").html(loader());
      },
      data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo, maquina: d_maquina  },
      success: function(data) {
        $(".e_cargarTipoVariable").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("change", "#f_VariablesCrear #Maq_Codigo", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_VariablesCrear #Var_Nombre").val();
   d_planta = $("#f_VariablesCrear #codigoPlanta").val();
   d_tipo = $("#f_VariablesCrear #Var_Tipo").val();
   d_maquina = $("#f_VariablesCrear #Maq_Codigo").val();
   
   $.ajax({
      type:"POST",
      url:"f_cargarValVariablesGenerales.php",
      beforeSend: function() {
        $(".e_cargarTipoVariable").html(loader());
      },
      data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo, maquina: d_maquina  },
      success: function(data) {
        $(".e_cargarTipoVariable").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
});
