$(document).ready(function (e) {

  $('#filtroParametrosV_Planta').multiselect({
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

  $('#filtroParametrosV_Area').multiselect({
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

  $('#filtroParametrosV_Maquina').multiselect({
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

  $("body").on("click", "#Btn_ParametrosVBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroParametrosV_Planta").val();
    d_areas = $("#filtroParametrosV_Area").val();
    d_maquina = $("#filtroParametrosV_Maquina").val();
    d_estado = $("#filtroParametrosV_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_parametrosVariablesListar.php",
      beforeSend: function () {
        $(".info_ParametrosVListar").html(loader());
      },
      data: {
        planta: d_planta,
        areas: d_areas,
        maquina: d_maquina,
        estado: d_estado
      },
      success: function (data) {
        $(".info_ParametrosVListar").html(data);
        $("#tbl_ParametrosVariablesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_ParametrosVCrear", function (e) {
    e.preventDefault();

    $("#vtn_ParametrosVCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_parametrosVariablesCrear.php",
      beforeSend: function () {
        $(".info_ParametrosVCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_ParametrosVCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_ParametrosVariablesCrear #Pla_Codigo_canales", function (e) {
    e.preventDefault();

    d_planta = $("#f_ParametrosVariablesCrear #Pla_Codigo_canales").val();
    $(".e_cargarAreaCrear").html('<div class="form-group"><label class="control-label">Área:<span class="rojo">*</span></label><select id="Are_Codigo" class="form-control" required><option></option></select></div>');
    $(".e_cargarMaquinaCrear").html('<div class="form-group"><label class="control-label">Máquina:<span class="rojo">*</span></label><select id="Maq_Codigo" class="form-control" required><option></option></select></div>');

    $.ajax({
      type: "POST",
      url: "f_cargarFases.php",
      beforeSend: function () {
        $(".e_cargarFasesCrear").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarFasesCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#f_ParametrosVariablesCrear #Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#f_ParametrosVariablesCrear #Pla_Codigo").val();
    $(".e_cargarAreaCrear").html('<div class="form-group"><label class="control-label">Área:<span class="rojo">*</span></label><select id="Are_Codigo" class="form-control" required><option></option></select></div>');
    $(".e_cargarMaquinaCrear").html('<div class="form-group"><label class="control-label">Máquina:<span class="rojo">*</span></label><select id="Maq_Codigo" class="form-control" required><option></option></select></div>');

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
        $.ajax({
          type:"POST",
          url:"f_cargarTurnos.php",
          beforeSend: function() {
            $(".e_cargarTurnosPlanta").html(loader());
          },
          data:{ planta: d_planta },
          success: function(data) {
            $(".e_cargarTurnosPlanta").html(data);
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

  $("body").on("change", "#f_ParametrosVariablesCrear #Are_Codigo", function (e) {
    e.preventDefault();

    d_area = $("#f_ParametrosVariablesCrear #Are_Codigo").val();

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
  
  $("body").on("change", "#f_ParametrosVariablesCrear #PV_Tipo", function(e){
    e.preventDefault();
  
    d_tipo = $("#f_ParametrosVariablesCrear #PV_Tipo").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarCamposParametrosVariables.php",
      beforeSend: function() {
        $(".e_cargarCamposParametrosVariables").html(loader());
      },
      data:{ tipo: d_tipo },
      success: function(data) {
        $(".e_cargarCamposParametrosVariables").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  $("body").on("submit", "#f_ParametrosVariablesCrear", function (e) {
    e.preventDefault();

    d_maquina = $("#f_ParametrosVariablesCrear #Maq_Codigo").val();
    d_tipo = $("#f_ParametrosVariablesCrear #PV_Tipo").val();
    d_nombre = $("#f_ParametrosVariablesCrear #Maq_Nombre").val();
    d_unidadMedida = $("#f_ParametrosVariablesCrear #PV_UnidadMedida").val();
    d_valorControl = $("#f_ParametrosVariablesCrear #PV_ValorControl").val();
    d_valorTolerancia = $("#f_ParametrosVariablesCrear #PV_ValorTolerancia").val();
    d_operador = $("#f_ParametrosVariablesCrear #PV_Operador").val();
    d_formato = $("#f_ParametrosVariablesCrear #For_Codigo").val();
    d_archivo = $("#f_ParametrosVariablesCrear #i_Arc_ParamVariables_Archivo").val();
    d_tipoVariable = $("#f_ParametrosVariablesCrear #ParV_TipoVariable").val();
    d_puntoControl = $("#f_ParametrosVariablesCrear #ParV_PuntoControl").val();
    d_orden = $("#f_ParametrosVariablesCrear #ParV_Orden").val();
    d_crearVariable = $("#f_ParametrosVariablesCrear #crearParametrosVariable").val();
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
    
    if(d_crearVariable == "1" ){
      $.ajax({
        type: "POST",
        url: "op_parametrosVariablesCrear.php",
        beforeSend: function () {
          bloquearFormulario("f_ParametrosVariablesCrear");
          $("#Btn_ParametrosVCrearForm").hide();
        },
        complete: function () {
          desbloquearFormulario("f_ParametrosVariablesCrear");
          $("#Btn_ParametrosVCrearForm").show();
        },
        data: {
          maquina: d_maquina,
          nombre: d_nombre,
          unidadMedida: d_unidadMedida,
          valorcontrol: d_valorControl,
          valorTolerancia: d_valorTolerancia,
          operador: d_operador,
          tipo: d_tipo,
          formato: d_formato,
          lista1: d_lista1,
          lista2: d_lista2,
          lista3: d_lista3,
          num: d_num, 
          archivo: d_archivo,
          tipoVariable: d_tipoVariable,
          puntoControl: d_puntoControl,
          orden: d_orden
        },
        dataType: 'json',
        success: function (rs) {
          if (rs.mensaje == "OK") {
            $("#vtn_parametrosVariablesCrearCargarNotificaciones").modal({
              backdrop: 'static'
            });
            $(".info_parametrosVariablesCrearCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
          } else {
            mensaje('2', rs.mensaje);
            $("#vtn_parametrosVariablesCrearCargarNotificaciones").modal({
              backdrop: 'static'
            });
            $(".info_parametrosVariablesCrearCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          }
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    }else{
      $(".cargar_ParametroVariableExisteRespuesta").html('<br><div class="alert alert-danger"> <strong>Esta variable ya existe en el sistema, por favor cambiarla</strong> </div>');
    }

  });

  $("body").on("click", "#Btn_parametrosVariablesCrearCargarNotificaciones", function (e) {
    e.preventDefault();

    $("#vtn_parametrosVariablesCrearCargarNotificaciones").modal('hide');
    $("#vtn_ParametrosVCrear").modal('hide');

    d_planta = $("#filtroParametrosV_Planta").val();
    d_fases = $("#filtroParametrosV_Fases").val();
    d_canales = $("#filtroParametrosV_Canales").val();
    d_areas = $("#filtroParametrosV_Area").val();
    d_maquina = $("#filtroParametrosV_Maquina").val();
    d_estado = $("#filtroParametrosV_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_parametrosVariablesListar.php",
      beforeSend: function () {
        $(".info_ParametrosVListar").html(loader());
      },
      data: {
        planta: d_planta,
        fases: d_fases,
        canales: d_canales,
        areas: d_areas,
        maquina: d_maquina,
        estado: d_estado
      },
      success: function (data) {
        $(".info_ParametrosVListar").html(data);
        $("#tbl_ParametrosVariablesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarParametrosV", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_ParametrosVActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_parametrosvariableActualizar.php",
      beforeSend: function () {
        $(".info_ParametrosVActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_ParametrosVActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_ParametrosVariablesActualizar #Pla_CodigoAct", function (e) {
    e.preventDefault();

    d_planta = $("#f_ParametrosVariablesActualizar #Pla_CodigoAct").val();
    d_codigo = $("#f_ParametrosVariablesActualizar #codigoMaquinaAct").val();

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

  $("body").on("change", "#f_ParametrosVariablesActualizar #Are_CodigoAct", function (e) {
    e.preventDefault();

    d_area = $("#f_ParametrosVariablesActualizar #Are_CodigoAct").val();
    d_codigo = $("#f_ParametrosVariablesActualizar #codigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarMaquinaActualizar.php",
      beforeSend: function () {
        $(".e_cargarMaquinaActualizar").html(loader());
      },
      data: {
        area: d_area,
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarMaquinaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_ParametrosVariablesActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_ParametrosVariablesActualizar #codigoAct").val();
    d_maquina = $("#f_ParametrosVariablesActualizar #Maq_CodigoAct").val();
    d_nombre = $("#f_ParametrosVariablesActualizar #Maq_NombreAct").val();
    d_unidadMedida = $("#f_ParametrosVariablesActualizar #PV_UnidadMedidaAct").val();
    d_valorControl = $("#f_ParametrosVariablesActualizar #PV_ValorControlAct").val();
    d_valorTolerancia = $("#f_ParametrosVariablesActualizar #PV_ValorToleranciaAct").val();
    d_operador = $("#f_ParametrosVariablesActualizar #PV_OperadorAct").val();
    d_estado = $("#f_ParametrosVariablesActualizar #parV_EstadoAct").val();
    d_tipo = $("#f_ParametrosVariablesActualizar #PV_TipoAct").val();
    d_formato = $("#f_ParametrosVariablesActualizar #For_CodigoAct").val();
    d_archivo = $("#f_ParametrosVariablesActualizar #i_Arc_ParamVariables_ArchivoAct").val();
    d_tipoVariable = $("#f_ParametrosVariablesActualizar #ParV_TipoVariableAct").val();
    d_puntoControl = $("#f_ParametrosVariablesActualizar #Var_PuntoControlAct").val();
    d_orden = $("#f_ParametrosVariablesActualizar #ParV_OrdenAct").val();
    d_codigoParam = $(this).attr("data-cod");
    
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
      url: "op_parametrosVariablesActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_ParametrosVariablesActualizar");
        $("#Btn_ParametrosVActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_ParametrosVariablesActualizar");
        $("#Btn_ParametrosVActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        maquina: d_maquina,
        nombre: d_nombre,
        unidadMedida: d_unidadMedida,
        valorcontrol: d_valorControl,
        valorTolerancia: d_valorTolerancia,
        operador: d_operador,
        estado: d_estado,
        tipo: d_tipo,
        formato: d_formato,
        lista1: d_lista1,
        lista2: d_lista2,
        lista3: d_lista3,
        lista4: d_lista4,
        lista5: d_lista5,
        codParametros: d_codigoParam,
        num: d_num,
        archivo: d_archivo,
        tipoVariable: d_tipoVariable,
        puntoControl: d_puntoControl,
        orden: d_orden
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ParametrosVCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosVCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');

        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_ParametrosVCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosVCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });

  $("body").on("click", "#Btn_ParametrosVCargarNotificaciones", function (e) {
    e.preventDefault();

    $("#vtn_ParametrosVCargarNotificaciones").modal('hide');
    $("#vtn_ParametrosVActualizar").modal('hide');

    d_planta = $("#filtroParametrosV_Planta").val();
    d_fases = $("#filtroParametrosV_Fases").val();
    d_canales = $("#filtroParametrosV_Canales").val();
    d_areas = $("#filtroParametrosV_Area").val();
    d_maquina = $("#filtroParametrosV_Maquina").val();
    d_estado = $("#filtroParametrosV_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_parametrosVariablesListar.php",
      beforeSend: function () {
        $(".info_ParametrosVListar").html(loader());
      },
      data: {
        planta: d_planta,
        fases: d_fases,
        canales: d_canales,
        areas: d_areas,
        maquina: d_maquina,
        estado: d_estado
      },
      success: function (data) {
        $(".info_ParametrosVListar").html(data);
        $("#tbl_ParametrosVariablesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_eliminarParametrosV", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "op_parametrosVariablesEliminar.php",
      beforeSend: function () {
        $(".e_eliminarParametrosV").hide();
      },
      complete: function () {
        $(".e_eliminarParametrosV").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ParametrosVEliminarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosVEliminarCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_ParametrosVEliminarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ParametrosVEliminarCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_ParametrosVEliminarCargarNotificaciones", function (e) {
    e.preventDefault();
    $("#vtn_ParametrosVEliminarCargarNotificaciones").modal('hide');

    d_planta = $("#filtroParametrosV_Planta").val();
    d_fases = $("#filtroParametrosV_Fases").val();
    d_canales = $("#filtroParametrosV_Canales").val();
    d_areas = $("#filtroParametrosV_Area").val();
    d_maquina = $("#filtroParametrosV_Maquina").val();
    d_estado = $("#filtroParametrosV_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_parametrosVariablesListar.php",
      beforeSend: function () {
        $(".info_ParametrosVListar").html(loader());
      },
      data: {
        planta: d_planta,
        fases: d_fases,
        canales: d_canales,
        areas: d_areas,
        maquina: d_maquina,
        estado: d_estado
      },
      success: function (data) {
        $(".info_ParametrosVListar").html(data);
        $("#tbl_ParametrosVariablesListar").tablesorter();
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
  
  $("body").on("change", ".Int_SeleccionTodosParVariablesAct", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSel").prop("checked", true);
    } else {
      $(".Inp_TurnosSel").prop("checked", false);
    }
  });
  
  $("body").on("change", "#f_ParametrosVariablesCrear #ParV_PuntoControl", function(e){
    e.preventDefault();
    
    d_puntoControl = $("#f_ParametrosVariablesCrear #ParV_PuntoControl").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarTipoParametrosVariables.php",
      beforeSend: function() {
        $(".e_cargarTipoParametrosVariable").html(loader());
      },
      data:{ puntoControl: d_puntoControl },
      success: function(data) {
        $(".e_cargarTipoParametrosVariable").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#f_ParametrosVariablesActualizar #Var_PuntoControlAct", function(e){
    e.preventDefault();
    
    d_puntoControl = $("#f_ParametrosVariablesActualizar #Var_PuntoControlAct").val();
    d_codigo = $("#f_ParametrosVariablesActualizar #codigoAct").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarTipoParametrosVariablesActualizar.php",
      beforeSend: function() {
        $(".e_cargarTipoParametrosVariableAct").html(loader());
      },
      data:{ puntoControl: d_puntoControl, codigo: d_codigo },
      success: function(data) {
        $(".e_cargarTipoParametrosVariableAct").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("change", "#f_ParametrosVariablesCrear #PV_Tipo", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_ParametrosVariablesCrear #Maq_Nombre").val();
   d_planta = $("#f_ParametrosVariablesCrear #codigoPlanta").val();
   d_tipo = $("#f_ParametrosVariablesCrear #PV_Tipo").val();
   d_maquina = $("#f_ParametrosVariablesCrear #Maq_Codigo").val();
   d_formato = $("#f_ParametrosVariablesCrear #For_Codigo").val();
   
   $.ajax({
    type:"POST",
    url:"f_cargarValParametrosVariables.php",
    beforeSend: function() {
      $(".cargar_ParametroVariableExisteRespuesta").html(loader());
    },
    data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo, maquina: d_maquina, formato: d_formato },
    success: function(data) {
      $(".cargar_ParametroVariableExisteRespuesta").html(data);
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  });
  
  $("body").on("change", "#f_ParametrosVariablesCrear #Maq_Nombre", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_ParametrosVariablesCrear #Maq_Nombre").val();
   d_planta = $("#f_ParametrosVariablesCrear #codigoPlanta").val();
   d_tipo = $("#f_ParametrosVariablesCrear #PV_Tipo").val();
   d_maquina = $("#f_ParametrosVariablesCrear #Maq_Codigo").val();
   d_formato = $("#f_ParametrosVariablesCrear #For_Codigo").val();
   
   $.ajax({
      type:"POST",
      url:"f_cargarValParametrosVariables.php",
      beforeSend: function() {
        $(".cargar_ParametroVariableExisteRespuesta").html(loader());
      },
      data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo, maquina: d_maquina, formato: d_formato },
      success: function(data) {
        $(".cargar_ParametroVariableExisteRespuesta").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("change", "#f_ParametrosVariablesCrear #Maq_Codigo", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_ParametrosVariablesCrear #Maq_Nombre").val();
   d_planta = $("#f_ParametrosVariablesCrear #codigoPlanta").val();
   d_tipo = $("#f_ParametrosVariablesCrear #PV_Tipo").val();
   d_maquina = $("#f_ParametrosVariablesCrear #Maq_Codigo").val();
   d_formato = $("#f_ParametrosVariablesCrear #For_Codigo").val();
   
   $.ajax({
      type:"POST",
      url:"f_cargarValParametrosVariables.php",
      beforeSend: function() {
        $(".cargar_ParametroVariableExisteRespuesta").html(loader());
      },
      data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo, maquina: d_maquina, formato: d_formato },
      success: function(data) {
        $(".cargar_ParametroVariableExisteRespuesta").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  }); 
  
  $("body").on("change", "#f_ParametrosVariablesCrear #For_Codigo", function(e){
    e.preventDefault();
   
   d_nombre = $("#f_ParametrosVariablesCrear #Maq_Nombre").val();
   d_planta = $("#f_ParametrosVariablesCrear #codigoPlanta").val();
   d_tipo = $("#f_ParametrosVariablesCrear #PV_Tipo").val();
   d_maquina = $("#f_ParametrosVariablesCrear #Maq_Codigo").val();
   d_formato = $("#f_ParametrosVariablesCrear #For_Codigo").val();
   
   $.ajax({
      type:"POST",
      url:"f_cargarValParametrosVariables.php",
      beforeSend: function() {
        $(".cargar_ParametroVariableExisteRespuesta").html(loader());
      },
      data:{ nombre: d_nombre, planta: d_planta, tipo: d_tipo, maquina: d_maquina, formato: d_formato },
      success: function(data) {
        $(".cargar_ParametroVariableExisteRespuesta").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
});
