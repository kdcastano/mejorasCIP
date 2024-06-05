$(document).ready(function(e) {
    $('#filtroBitacoras_Planta').multiselect({
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
  
  $('#filtroBitacoras_PuestoT').multiselect({
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
  
  $('#filtroBitacoras_Usuarios').multiselect({
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
  
  $('#filtroBitacoras_SAPSAM').multiselect({
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
  
  $('#filtroBitacoras_Requerimiento').multiselect({
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
  
  
    d_fechaI = $("#filtroBitacoras_FechaI").val();
    d_fechaF = $("#filtroBitacoras_FechaF").val();
    d_puesto = $("#filtroBitacoras_PuestoT").val();
    d_usuario = $("#filtroBitacoras_Usuarios").val();
    d_sapsam = $("#filtroBitacoras_SAPSAM").val();
    d_requerimiento = $("#filtroBitacoras_Requerimiento").val();
    
    $.ajax({
      type:"POST",
      url:"f_listarBitacoras.php",
      beforeSend: function() {
        $(".info_BitacorasListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        puesto: d_puesto,
        usuario: d_usuario,
        sapsam: d_sapsam,
        requerimiento: d_requerimiento
      },
      success: function(data) {
        $(".info_BitacorasListar").html(data);
        $("#tbl_bitacorasListar").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  $("body").on("click", "#Btn_BitacorasBuscar", function(e){
    e.preventDefault();
    
    d_fechaI = $("#filtroBitacoras_FechaI").val();
    d_fechaF = $("#filtroBitacoras_FechaF").val();
    d_puesto = $("#filtroBitacoras_PuestoT").val();
    d_usuario = $("#filtroBitacoras_Usuarios").val();
    d_sapsam = $("#filtroBitacoras_SAPSAM").val();
    d_requerimiento = $("#filtroBitacoras_Requerimiento").val();
    
    $.ajax({
      type:"POST",
      url:"f_listarBitacoras.php",
      beforeSend: function() {
        $(".info_BitacorasListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        puesto: d_puesto,
        usuario: d_usuario,
        sapsam: d_sapsam,
        requerimiento: d_requerimiento
      },
      success: function(data) {
        $(".info_BitacorasListar").html(data);
        $("#tbl_bitacorasListar").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
  
  $("body").on("click", "#Btn_BitacorasCrear", function(e){
    e.preventDefault();
    
    $("#vtn_BitacorasCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_bitacorasCrear.php",
      beforeSend: function() {
        $(".info_BitacorasCrear").html(loader());
      },
      data:{  },
      success: function(data) {
        $(".info_BitacorasCrear").html(data);
        $('#Bit_SAP').multiselect({
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
        $('#Bit_SAM').multiselect({
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
//        $('#PueT_Codigo').multiselect({
//          includeSelectAllOption: true,
//          enableFiltering: true,
//          selectAllText: 'Seleccionar Todos',
//          nonSelectedText: 'Seleccione...',
//          nSelectedText: ' Todos',
//          buttonWidth: '100%',
//          enableCaseInsensitiveFiltering: true,
//          maxHeight: 400,
//          dropUp: true
//        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("submit", "#f_bitacorasCrear", function(e){
    e.preventDefault();
    
    d_planta = $("#f_bitacorasCrear #Pla_Codigo").val();
    d_puesto = $("#f_bitacorasCrear #PueT_Codigo").val();
    d_descripcion = $("#f_bitacorasCrear #Bit_Descripcion").val();
    d_accion = $("#f_bitacorasCrear #Bit_Accion").val();
    d_requerimiento = $("#f_bitacorasCrear #Bit_Requerimiento").val();
    d_sap = $("#f_bitacorasCrear #Bit_SAP").val();
//    d_sam = $("#f_bitacorasCrear #Bit_SAM").val();
    
    $.ajax({
      type:"POST",
      url:"op_bitacorasUnicoCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_bitacorasCrear");
        $("#Btn_BitacorasCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_bitacorasCrear");
        $("#Btn_BitacorasCrearForm").show();
      },
      data: { 
        planta: d_planta,
        puesto: d_puesto,
        descripcion: d_descripcion,
        accion: d_accion,
        requerimiento: d_requerimiento,
        sap: d_sap
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_BitacorasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_BitacorasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  }); 
  
  $("body").on("click", "#Btn_BitacorasNotificacionesCrear", function(e){
    e.preventDefault();
    $("#vtn_BitacorasNotificacionesCrear").modal('hide');
    $("#vtn_BitacorasCrear").modal('hide');

    d_fechaI = $("#filtroBitacoras_FechaI").val();
    d_fechaF = $("#filtroBitacoras_FechaF").val();
    d_puesto = $("#filtroBitacoras_PuestoT").val();
    d_usuario = $("#filtroBitacoras_Usuarios").val();
    d_sapsam = $("#filtroBitacoras_SAPSAM").val();
    d_requerimiento = $("#filtroBitacoras_Requerimiento").val();
    
    $.ajax({
      type:"POST",
      url:"f_listarBitacoras.php",
      beforeSend: function() {
        $(".info_BitacorasListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        puesto: d_puesto,
        usuario: d_usuario,
        sapsam: d_sapsam,
        requerimiento: d_requerimiento
      },
      success: function(data) {
        $(".info_BitacorasListar").html(data);
        $("#tbl_bitacorasListar").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    }); 
  });
  
  $("body").on("click", ".e_editarBitacora", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_BitacorasActualizar").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_bitacorasActualizar.php",
      beforeSend: function() {
        $(".info_BitacorasActualizar").html(loader());
      },
      data:{ 
        codigo: d_codigo
      },
      success: function(data) {
        $(".info_BitacorasActualizar").html(data);
        $('#Bit_SAPAct').multiselect({
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
        $('#Bit_SAMAct').multiselect({
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
        $('#PueT_CodigoAct').multiselect({
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
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("submit", "#f_bitacorasActualizar", function(e){
    e.preventDefault();
    
    d_codigo = $("#codigoAct").val();
    d_planta = $("#f_bitacorasActualizar #Pla_CodigoAct").val();
    d_puesto = $("#f_bitacorasActualizar #PueT_CodigoAct").val();
    d_descripcion = $("#f_bitacorasActualizar #Bit_DescripcionAct").val();
    d_accion = $("#f_bitacorasActualizar #Bit_AccionAct").val();
    d_requerimiento = $("#f_bitacorasActualizar #Bit_RequerimientoAct").val();
    d_sap = $("#f_bitacorasActualizar #Bit_SAPAct").val();
    d_sam = $("#f_bitacorasActualizar #Bit_SAMAct").val();
    
    $.ajax({
      type:"POST",
      url:"op_bitacorasActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_bitacorasActualizar");
        $("#Btn_BitacorasActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_bitacorasActualizar");
        $("#Btn_BitacorasActualizarForm").show();
      },
      data: { 
        codigo: d_codigo,
        planta: d_planta,
        puesto: d_puesto,
        descripcion: d_descripcion,
        accion: d_accion,
        requerimiento: d_requerimiento,
        sap: d_sap,
        sam: d_sam
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_BitacorasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_BitacorasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_BitacorasNotificacionesActualizar", function(e){
    e.preventDefault();
    $("#vtn_BitacorasNotificacionesActualizar").modal('hide');
    $("#vtn_BitacorasActualizar").modal('hide');

    d_fechaI = $("#filtroBitacoras_FechaI").val();
    d_fechaF = $("#filtroBitacoras_FechaF").val();
    d_puesto = $("#filtroBitacoras_PuestoT").val();
    d_usuario = $("#filtroBitacoras_Usuarios").val();
    d_sapsam = $("#filtroBitacoras_SAPSAM").val();
    d_requerimiento = $("#filtroBitacoras_Requerimiento").val();
    
    $.ajax({
      type:"POST",
      url:"f_listarBitacoras.php",
      beforeSend: function() {
        $(".info_BitacorasListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        puesto: d_puesto,
        usuario: d_usuario,
        sapsam: d_sapsam,
        requerimiento: d_requerimiento
      },
      success: function(data) {
        $(".info_BitacorasListar").html(data);
        $("#tbl_bitacorasListar").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarBitacora", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_BitacorasEliminarConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_BitacorasEliminar").val(d_codigo);

  });
  
  $("body").on("click", "#Btn_BitacorasEliminarConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_BitacorasEliminar").val();
    $("#vtn_BitacorasEliminarConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_bitacorasEliminar.php",
      beforeSend: function () {
        $(".e_eliminarBitacora").hide();
      },
      complete: function () {
        $(".e_eliminarBitacora").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_BitacorasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_BitacorasNotificacionesEliminar").modal({
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

  $("body").on("click", "#Btn_BitacorasNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_BitacorasNotificacionesEliminar").modal('hide');

    d_fechaI = $("#filtroBitacoras_FechaI").val();
    d_fechaF = $("#filtroBitacoras_FechaF").val();
    d_puesto = $("#filtroBitacoras_PuestoT").val();
    d_usuario = $("#filtroBitacoras_Usuarios").val();
    d_sapsam = $("#filtroBitacoras_SAPSAM").val();
    d_requerimiento = $("#filtroBitacoras_Requerimiento").val();
    
    $.ajax({
      type:"POST",
      url:"f_listarBitacoras.php",
      beforeSend: function() {
        $(".info_BitacorasListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        puesto: d_puesto,
        usuario: d_usuario,
        sapsam: d_sapsam,
        requerimiento: d_requerimiento
      },
      success: function(data) {
        $(".info_BitacorasListar").html(data);
        $("#tbl_bitacorasListar").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    }); 
  });
  
   $("body").on("submit", "#f_bitacorasTablaCrear", function(e){
    e.preventDefault();
     
    d_a = $("#f_bitacorasTablaCrear #Num_CantVariablesBitacoras").val();
     
    d_lista1 = []; // planta
    d_lista2 = []; // puesto de trabajo
    d_lista3 = []; // usuario
    d_lista4 = []; // fecha
    d_lista5 = []; // descripcion
    d_lista6 = []; // acción
    d_lista7 = []; // requerimiento
    d_lista8 = []; // SAP
//    d_lista9 = []; // SAM
    d_lista10 = []; // Acción (actualizar-crear)
    d_lista11 = []; // codigo bitacoras
    d_lista12 = []; // Fecha programada
    d_lista13 = []; // Fecha real
    
		cont = 0;    
    for(r = 0; r < d_a; r++){
      
      d_planta = $("#f_bitacorasTablaCrear #Pla_Codigo"+r).val();
      d_puestoTrabajo = $("#f_bitacorasTablaCrear #PueT_Codigo"+r).val();
      d_descripcion = $("#f_bitacorasTablaCrear #Bit_Descripcion"+r).val();
      
      if(d_planta != "" && d_puestoTrabajo != "" && d_descripcion != ""){
      
        d_codigo = $("#f_bitacorasTablaCrear #Bit_Codigo"+r).val();
        d_requerimiento = $("#f_bitacorasTablaCrear #Bit_Requerimiento"+r).val();
        d_lista11[cont] = $("#f_bitacorasTablaCrear #Bit_Codigo"+r).val();

        d_lista1[cont] = $("#f_bitacorasTablaCrear #Pla_Codigo"+r).val();
        d_lista2[cont] = $("#f_bitacorasTablaCrear #PueT_Codigo"+r).val();
        d_lista3[cont] = $("#f_bitacorasTablaCrear #Usu_Codigo"+r).val();
        d_lista4[cont] = $("#f_bitacorasTablaCrear #Bit_Fecha"+r).val();
        d_lista5[cont] = $("#f_bitacorasTablaCrear #Bit_Descripcion"+r).val();
        d_lista6[cont] = $("#f_bitacorasTablaCrear #Bit_Accion"+r).val();

        $("#f_bitacorasTablaCrear .Bit_Requerimiento"+r+":checked").each(function(){ 
          d_lista7[cont] = $(this).val();
        });

        d_lista8[cont] = $("#f_bitacorasTablaCrear #Bit_SAP"+r).val();
//        d_lista9[cont] = $("#f_bitacorasTablaCrear #Bit_SAM"+r).val();

        if(d_codigo){
          //Actualizar
          d_lista10[cont] = "2";
        }else{
          //Crear
          d_lista10[cont] = "1";
        }
        
        d_lista12[cont] = $("#f_bitacorasTablaCrear #Bit_FechaProgramada"+r).val();
        d_lista13[cont] = $("#f_bitacorasTablaCrear #Bit_FechaReal"+r).val();
        cont++;
      }
      
    }
//     
//     console.log(d_lista1);
//     console.log(d_lista2);
//     console.log(d_lista3);
//     console.log(d_lista4);
//     console.log(d_lista5);
//     console.log(d_lista6);
//     console.log(d_lista7);
//     console.log(d_lista8);
//     console.log(d_lista9);
//     console.log(d_lista10);
//     console.log(d_lista11);
    
    d_num = cont;
    
    $.ajax({
      type:"POST",
      url:"op_bitacorasCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_bitacorasTablaCrear");
        $("#Btn_BitacorasCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_bitacorasTablaCrear");
        $("#Btn_BitacorasCrearForm").show();
      },   
      data: { 
        num: d_num, lista1: d_lista1 , lista2: d_lista2 , lista3: d_lista3 , lista4: d_lista4 , lista5: d_lista5 , lista6: d_lista6 , lista7: d_lista7 , lista8: d_lista8 , lista10: d_lista10, lista11: d_lista11, lista12: d_lista12, lista13: d_lista13
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_BitacorasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Guardado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_BitacorasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Guardado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_cargarNuevoRegistro", function(e){
    e.preventDefault();
    
    d_contador= $("#f_bitacorasTablaCrear #cantRegistroBitacora").val();
    d_contadorTotal = parseInt(d_contador)+1;
    
    $.ajax({
      type:"POST",
      url:"f_bitacoraCrearNuevo.php",
      beforeSend: function() {
//        $(".BitacoraNuevoRegistro").html(loader());
      },
      data:{ cont: d_contadorTotal },
      success: function(data) {
        $(".BitacoraNuevoRegistro").append(data);
        $("#f_bitacorasTablaCrear #cantRegistroBitacora").val(d_contadorTotal);
        $("#f_bitacorasTablaCrear #Num_CantVariablesBitacoras").val(d_contadorTotal);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  //Exportar a Excel
  $("body").on("click", ".excel_exportarBitacora", function(e){
  e.preventDefault();
    
    d_fechaI = $("#filtroBitacoras_FechaI").val();
    d_fechaF = $("#filtroBitacoras_FechaF").val();
    d_puesto = $("#filtroBitacoras_PuestoT").val();
    d_usuario = $("#filtroBitacoras_Usuarios").val();
    d_sapsam = $("#filtroBitacoras_SAPSAM").val();
    d_requerimiento = $("#filtroBitacoras_Requerimiento").val();
    
    window.location.href = "excel_exportarBitacora.php?fechaInicial="+d_fechaI+"&fechaFinal="+d_fechaF+"&puestoTrabajo="+d_puesto+"&usuario="+d_usuario+"&sapsam="+d_sapsam+"&requerimiento="+d_requerimiento;

  });
});