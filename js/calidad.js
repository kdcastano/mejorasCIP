$(document).ready(function(e) {
  $('#filtroCalidad_Planta').multiselect({ 
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
  
  d_planta = $("#filtroCalidad_Planta").val();
  d_estado = $("#filtroCalidad_Estado").val();

  $.ajax({
    type:"POST",
    url:"f_calidadListar.php",
    beforeSend: function() {
      $(".info_cargarCalidad").html(loader());
    },
    data:{ planta: d_planta, estado: d_estado },
    success: function(data) {
      $(".info_cargarCalidad").html(data);
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  $("body").on("change", "#filtroCalidad_Planta", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroCalidad_Planta").val();
    d_estado = $("#filtroCalidad_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_calidadListar.php",
      beforeSend: function() {
        $(".info_cargarCalidad").html(loader());
      },
      data:{ planta: d_planta, estado: d_estado },
      success: function(data) {
        $(".info_cargarCalidad").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("change", "#filtroCalidad_Estado", function(e){
    e.preventDefault();
  
    d_planta = $("#filtroCalidad_Planta").val();
    d_estado = $("#filtroCalidad_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_calidadListar.php",
      beforeSend: function() {
        $(".info_cargarCalidad").html(loader());
      },
      data:{ planta: d_planta, estado: d_estado },
      success: function(data) {
        $(".info_cargarCalidad").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });

  $("body").on("click", "#Btn_CalidadCrear", function(e){
    e.preventDefault();
    
     $("#vtn_CalidadCrear").modal({
      backdrop: 'static'
     });
    
    $.ajax({
      type:"POST",
      url:"f_calidadCrear.php",
      beforeSend: function() {
        $(".info_CalidadCrear").html(loader());
      },
      data:{  },
      success: function(data) {
        $(".info_CalidadCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });      
  
  }); 
  
  $("body").on("change", "#Cal_Planta", function (e) {
    e.preventDefault();

    d_planta = $("#Cal_Planta").val();
    d_tipo = "6";

    $.ajax({
      type: "POST",
      url: "f_cargarAreas.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta, tipo: d_tipo
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
  
  $("body").on("change", "#Cal_PlantaAct", function (e) {
    e.preventDefault();

    d_planta = $("#Cal_PlantaAct").val();
    d_codigo = $("#Cal_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarAreascalidadActualizar.php",
      beforeSend: function () {
        $(".e_cargarAreaActualizar").html(loader());
      },
      data: {
        planta: d_planta, codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarAreaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("submit", "#f_calidadCrear", function(e){
    e.preventDefault();
    
    d_area = $("#f_calidadCrear #Are_Codigo").val();
    d_nombre = $("#f_calidadCrear #Cal_Nombre").val();
    d_valorCritico = $("#f_calidadCrear #Cal_ValorCritico").val();
    d_tolerancia = $("#f_calidadCrear #Cal_Tolerancia").val();
    d_tomaDefectos = $("#f_calidadCrear #Cal_TomaDefectos").val();
    d_operador = $("#f_calidadCrear #Cal_Operador").val();
    d_ordenamiento = $("#f_calidadCrear #Cal_Ordenamiento").val();
    d_agrupador = $("#f_calidadCrear #Cal_AgrupadorSuma").val();
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
    
    $.ajax({
      type:"POST",
      url:"op_calidadCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_calidadCrear");
        $("#Btn_CalidadCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_calidadCrear");
        $("#Btn_CalidadCrearForm").show();
      },
      data: { area: d_area, nombre: d_nombre, valorCritico: d_valorCritico, tolerancia: d_tolerancia, tomaDefectos: d_tomaDefectos, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, num: d_num, operador: d_operador, ordenamiento: d_ordenamiento, agrupador: d_agrupador },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_CalidadNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_CalidadNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_CalidadNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_CalidadNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_CalidadNotificacionesCrear", function(e){
    e.preventDefault();
    
    $("#vtn_CalidadNotificacionesCrear").modal('hide');
    $("#vtn_CalidadCrear").modal('hide');
  
    
    d_planta = $("#filtroCalidad_Planta").val();
    d_estado = $("#filtroCalidad_Estado").val();

    $.ajax({
      type:"POST",
      url:"f_calidadListar.php",
      beforeSend: function() {
        $(".info_cargarCalidad").html(loader());
      },
      data:{ planta: d_planta, estado: d_estado },
      success: function(data) {
        $(".info_cargarCalidad").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", ".e_EditarCalidad", function(e){
    e.preventDefault();
    
     $("#vtn_CalidadActualizar").modal({
      backdrop: 'static'
    });
    
    d_codigo = $(this).attr("data-cod");
    
    $.ajax({
      type:"POST",
      url:"f_calidadActualizar.php",
      beforeSend: function() {
        $(".info_CalidadActualizar").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_CalidadActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_calidadActualizar", function(e){
    e.preventDefault();
    
    d_codigo = $("#f_calidadActualizar #Cal_CodigoAct").val();
    d_area = $("#f_calidadActualizar #Are_CodigoAct").val();
    d_nombre = $("#f_calidadActualizar #Cal_NombreAct").val();
    d_valorCritico = $("#f_calidadActualizar #Cal_ValorCriticoAct").val();
    d_tolerancia = $("#f_calidadActualizar #Cal_ToleranciaAct").val();
    d_tomaDefectos = $("#f_calidadActualizar #Cal_TomaDefectosAct").val();
    d_operador = $("#f_calidadActualizar #Cal_OperadorAct").val();
    d_ordenamiento = $("#f_calidadActualizar #Cal_OrdenamientoAct").val();
    d_agrupador = $("#f_calidadActualizar #Cal_AgrupadorSumaAct").val();
    d_codigoCal = $(this).attr("data-cod");  

	  d_lista1 = [];
    d_lista2 = [];
    d_lista3 = [];
    d_lista4 = [];
    d_lista5 = [];
    
	  cont = 0;
		$(".Inp_TurnosSelAct").each(function(){
			
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
      type:"POST",
      url:"op_calidadActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_calidadActualizar");
        $("#Btn_CalidadActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_calidadActualizar");
        $("#Btn_CalidadActualizarForm").show();
      },
      data: { codigo: d_codigo, area: d_area, nombre: d_nombre, valorCritico: d_valorCritico, tolerancia: d_tolerancia, tomaDefectos: d_tomaDefectos, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5,
        codCalidad: d_codigoCal, num: d_num, operador: d_operador, ordenamiento: d_ordenamiento, agrupador: d_agrupador },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_CalidadNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_CalidadNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_CalidadNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_CalidadNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_CalidadNotificacionesActualizar", function(e){
    e.preventDefault();
    
    $("#vtn_CalidadNotificacionesActualizar").modal('hide');
    $("#vtn_CalidadActualizar").modal('hide');
    
     d_planta = $("#filtroCalidad_Planta").val();
     d_estado = $("#filtroCalidad_Estado").val();

      $.ajax({
        type:"POST",
        url:"f_calidadListar.php",
        beforeSend: function() {
          $(".info_cargarCalidad").html(loader());
        },
        data:{ planta: d_planta, estado: d_estado },
        success: function(data) {
          $(".info_cargarCalidad").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
  });
  
  $("body").on("click", ".e_eliminarCalidad", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_CalidadConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_CalidadConfEliminar").val(d_codigo);

  });
  
  $("body").on("click", "#Btn_CalidadConfNotificacionesEliminar", function(e){
    e.preventDefault();
    
    d_codigo = $(".Cod_CalidadConfEliminar").val();
    $("#vtn_CalidadConfNotificacionesEliminar").modal('hide');
    
    $.ajax({
      type:"POST",
      url:"op_calidadEliminar.php",
      beforeSend: function() {
        $(".e_eliminarCalidad").hide();
      },
      complete: function() {
        $(".e_eliminarCalidad").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_CalidadNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_CalidadNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_CalidadNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_CalidadNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_CalidadNotificacionesEliminar", function(e){
    e.preventDefault();
    
     $("#vtn_CalidadNotificacionesEliminar").modal('hide');
     d_planta = $("#filtroCalidad_Planta").val();
     d_estado = $("#filtroCalidad_Estado").val();

      $.ajax({
        type:"POST",
        url:"f_calidadListar.php",
        beforeSend: function() {
          $(".info_cargarCalidad").html(loader());
        },
        data:{ planta: d_planta, estado: d_estado },
        success: function(data) {
          $(".info_cargarCalidad").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
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
  
  $("body").on("change", ".Int_SeleccionTodosCalidadAct", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSelAct").prop("checked", true);
    } else {
      $(".Inp_TurnosSelAct").prop("checked", false);
    }
  });

});