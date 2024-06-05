$(document).ready(function (e) {

  $('#filtroReferenciasEmergencia_Planta').multiselect({
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
  $('#filtroReferenciasEmergencia_Area').multiselect({
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
  
  $("body").on("click", "#Btn_ReferenciasEmergenciaBuscar", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroReferenciasEmergencia_Planta").val();
    d_area = $("#filtroReferenciasEmergencia_Area").val();
    d_estado = $("#filtroReferenciasEmergencia_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_referenciasEmergenciaListar.php",
      beforeSend: function() {
        $(".info_ReferenciasEmergenciaListar").html(loader());
      },
      data:{ 
        planta: d_planta,
        area: d_area,
        estado: d_estado
      },
      success: function(data) {
        $(".info_ReferenciasEmergenciaListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });

  $("body").on("change", "#RefE_Tipo", function (e) {
    e.preventDefault();
    
    d_tipo = $("#RefE_Tipo").val(); 
    
    $.ajax({
      type:"POST",
      url:"f_referenciasEmergenciaCrear.php",
      beforeSend: function() {
        $(".e_cargarInfoTipoPP").html(loader());
      },
      data:{ tipo: d_tipo },
      success: function(data) {
        $(".e_cargarInfoTipoPP").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_ReferenciasEmergenciaCrear", function (e) {
    e.preventDefault();
    $("#vtn_ReferenciasEmergenciaCrear").modal({
      backdrop: 'static'
    });
    $.ajax({
      type: "POST",
      url: "f_programaProduccionRealCrear.php",
      beforeSend: function () {
        $(".info_ReferenciasEmergenciaCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_ReferenciasEmergenciaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });


  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo").val();
    $(".e_cargarColorCrear").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="RefE_Color" class="form-control" required><option></option></select></div>');
    $(".e_cargarFamiliaReferenciaEmergencia").html('<div class="form-group"><label class="control-label">Familia:<span class="rojo">*</span></label><select id="RefE_Familia" class="form-control" required><option></option></select></div>');
    $.ajax({
      type: "POST",
      url: "f_cargarAreas.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta,
        tipo: 1
      },
      success: function (data) {
        $(".e_cargarAreaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#Are_Codigo", function(e){
    e.preventDefault();
    
    $(".e_cargarFamiliaReferenciaEmergencia").html('<div class="form-group"><label class="control-label">Familia:<span class="rojo">*</span></label><select id="RefE_Familia" class="form-control" required><option></option></select></div>');
    $(".e_cargarColorCrear").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="RefE_Color" class="form-control" required><option></option></select></div>');
    
    d_planta = $("#Pla_Codigo").val();
    d_area = $("#Are_Codigo").val();
    
    $.ajax({
      type: "POST",
      url: "f_cargarFormatosReferenciasE.php",
      beforeSend: function () {
        $(".e_cargarFormatoReferenciaEmergencia").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area
      },
      success: function (data) {
        $(".e_cargarFormatoReferenciaEmergencia").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#For_Codigo", function (e) {
    e.preventDefault();

    d_formato = $("#For_Codigo").val();
    d_planta = $("#Pla_Codigo").val();
    $(".e_cargarColorCrear").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="RefE_Color" class="form-control" required><option></option></select></div>');

    $.ajax({
      type: "POST",
      url: "f_cargarFamiliaReferenciaE.php",
      beforeSend: function () {
        $(".e_cargarFamiliaReferenciaEmergencia").html(loader());
      },
      data: {
        formato: d_formato,
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarFamiliaReferenciaEmergencia").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#RefE_Familia", function (e) {
    e.preventDefault();

    d_familia = $("#f_ReferenciasEmergenciasCrear #RefE_Familia").val();
    d_planta = $("#f_ReferenciasEmergenciasCrear #Pla_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarColorReferenciaE.php",
      beforeSend: function () {
        $(".e_cargarColorCrear").html(loader());
      },
      data: {
        familia: d_familia,
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarColorCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#RefE_Color", function (e) {
    e.preventDefault();
    
    d_formato = $("#f_ReferenciasEmergenciasCrear #For_Codigo").val();
    d_familia = $("#f_ReferenciasEmergenciasCrear #RefE_Familia").val();
    d_color = $("#f_ReferenciasEmergenciasCrear #RefE_Color").val();

    $.ajax({
      type: "POST",
      url: "f_cargarDescripcionReferenciaE.php",
      beforeSend: function () {
        $(".e_cargarDescipcionReferencia").html(loader());
      },
      data: {
        familia: d_familia,
        formato: d_formato,        
        color: d_color
      },
      success: function (data) {
        $(".e_cargarDescipcionReferencia").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("submit", "#f_ReferenciasEmergenciasCrear", function(e){
    e.preventDefault();
    
    d_planta = $("#f_ReferenciasEmergenciasCrear #Pla_Codigo").val();
    d_area = $("#f_ReferenciasEmergenciasCrear #Are_Codigo").val();
    d_formato = $("#f_ReferenciasEmergenciasCrear #For_Codigo").val();
    d_familia = $("#f_ReferenciasEmergenciasCrear #RefE_Familia").val();
    d_color = $("#f_ReferenciasEmergenciasCrear #RefE_Color").val();
    d_tipo = $("#f_ReferenciasEmergenciasCrear #RefE_Tipo").val();
    d_descripcion = $("#f_ReferenciasEmergenciasCrear #RefE_Descripcion").val();
    
    $.ajax({
      type:"POST",
      url:"op_referenciasEmergenciaCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_ReferenciasEmergenciasCrear");
        $("#Btn_ReferenciasEmergenciaCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_ReferenciasEmergenciasCrear");
        $("#Btn_ReferenciasEmergenciaCrearForm").show();
      },
      data: { 
        planta: d_planta,
        area: d_area,
        formato: d_formato,
        familia: d_familia,
        color: d_color,
        tipo: d_tipo,
        descripcion: d_descripcion
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_CrearReferenciasEmergenciaCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          $("#vtn_CrearReferenciasEmergenciaCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_CrearReferenciasEmergenciaCargarNotificaciones", function(e){
    e.preventDefault();
    
    $("#vtn_CrearReferenciasEmergenciaCargarNotificaciones").modal('hide');
    $("#vtn_ReferenciasEmergenciaCrear").modal('hide');
    
    d_planta = $("#filtroReferenciasEmergencia_Planta").val();
    d_area = $("#filtroReferenciasEmergencia_Area").val();
    d_estado = $("#filtroReferenciasEmergencia_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_referenciasEmergenciaListar.php",
      beforeSend: function() {
        $(".info_ReferenciasEmergenciaListar").html(loader());
      },
      data:{ 
        planta: d_planta,
        area: d_area,
        estado: d_estado
      },
      success: function(data) {
        $(".info_ReferenciasEmergenciaListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
  
  $("body").on("click", ".e_editarReferencias", function (e) {
    e.preventDefault();
      d_codigo = $(this).attr("data-cod");
    $("#vtn_ReferenciasEmergenciaActualizar").modal({
      backdrop: 'static'
    });
    $.ajax({
      type: "POST",
      url: "f_referenciasEmergenciaActualizar.php",
      beforeSend: function () {
        $(".info_ReferenciasEmergenciaActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_ReferenciasEmergenciaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#RefE_TipoAct", function (e) {
    e.preventDefault();

    d_tipo = $("#f_referenciasEmergenciasActualizar #RefE_TipoAct").val();
    d_codigo = $("#f_referenciasEmergenciasActualizar #codigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_referenciasEmergenciaCargarCamposAct.php",
      beforeSend: function () {
        $(".e_cargarCamposForm").html(loader());
      },
      data: {
        tipo: d_tipo,
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarCamposForm").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#Pla_CodigoAct", function (e) {
      e.preventDefault();
  
      d_planta = $("#Pla_CodigoAct").val();
      d_codigo = $("#codigoAct").val();
      $(".e_cargarFamiliaReferenciaEmergenciaAct").html('<div class="form-group"><label class="control-label">Familia:<span class="rojo">*</span></label><select id="RefE_FamiliaAct" class="form-control" required><option></option></select></div>');
      $(".e_cargarColorActualizar").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="RefE_ColorAct" class="form-control" required><option></option></select></div>');
  
      $.ajax({
        type: "POST",
        url: "f_cargarAreasActualizar.php",
        beforeSend: function () {
          $(".e_cargarAreaActualizar").html(loader());
        },
        data: {
          planta: d_planta,
          codigo: d_codigo,
          tipo: 1
        },
        success: function (data) {
          $(".e_cargarAreaActualizar").html(data);
          
          $.ajax({
            type:"POST",
            url:"f_cargarFormatosReferenciasEAct.php",
            beforeSend: function() {
              $(".e_cargarFormatoReferenciaEmergenciaAct").html(loader());
            },
            data:{ planta: d_planta,
                  codigo: d_codigo },
            success: function(data) {
              $(".e_cargarFormatoReferenciaEmergenciaAct").html(data);
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
  
  $("body").on("change", "#For_CodigoAct", function(e){
    e.preventDefault();
    
    d_formato = $("#For_CodigoAct").val();
    d_planta = $("#Pla_CodigoAct").val();
    $(".e_cargarColorActualizar").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="RefE_ColorAct" class="form-control" required><option></option></select></div>');
    
    $.ajax({
      type:"POST",
      url:"f_cargarFamiliaReferenciaEAct.php",
      beforeSend: function() {
        $(".e_cargarFamiliaReferenciaEmergenciaAct").html(loader());
      },
      data:{ formato: d_formato, planta: d_planta  },
      success: function(data) {
        $(".e_cargarFamiliaReferenciaEmergenciaAct").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });

  $("body").on("change", "#RefE_FamiliaAct", function (e) {
    e.preventDefault();

    d_familia = $("#f_referenciasEmergenciasActualizar #RefE_FamiliaAct").val();
    d_planta = $("#f_referenciasEmergenciasActualizar #Pla_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarColorReferenciaEAct.php",
      beforeSend: function () {
        $(".e_cargarColorActualizar").html(loader());
      },
      data: {
        familia: d_familia,
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarColorActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#RefE_ColorAct", function (e) {
    e.preventDefault();
    
    d_formato = $("#f_referenciasEmergenciasActualizar #For_CodigoAct").val();
    d_familia = $("#f_referenciasEmergenciasActualizar #RefE_FamiliaAct").val();
    d_color = $("#f_referenciasEmergenciasActualizar #RefE_ColorAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarDescripcionReferenciaEAct.php",
      beforeSend: function () {
        $(".e_cargarDescipcionReferenciaAct").html(loader());
      },
      data: {
        familia: d_familia,
        formato: d_formato,        
        color: d_color
      },
      success: function (data) {
        $(".e_cargarDescipcionReferenciaAct").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("submit", "#f_referenciasEmergenciasActualizar", function(e){
    e.preventDefault();
    
    d_codigo = $("#f_referenciasEmergenciasActualizar #codigoAct").val();
    d_planta = $("#f_referenciasEmergenciasActualizar #Pla_CodigoAct").val();
    d_area = $("#f_referenciasEmergenciasActualizar #Are_CodigoAct").val();
    d_formato = $("#f_referenciasEmergenciasActualizar #For_CodigoAct").val();
    d_familia = $("#f_referenciasEmergenciasActualizar #RefE_FamiliaAct").val();
    d_color = $("#f_referenciasEmergenciasActualizar #RefE_ColorAct").val();
    d_tipo = $("#f_referenciasEmergenciasActualizar #RefE_TipoAct").val();
    d_estado = $("#f_referenciasEmergenciasActualizar #RefE_EstadoAct").val();
    d_descripcion = $("#f_referenciasEmergenciasActualizar #RefE_DescripcionAct").val();
    
    $.ajax({
      type:"POST",
      url:"op_referenciasEmergenciaActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_referenciasEmergenciasActualizar");
        $("#Btn_ReferenciasEmergenciaActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_referenciasEmergenciasActualizar");
        $("#Btn_ReferenciasEmergenciaActualizarForm").show();
      },
      data: { 
        codigo: d_codigo,
        planta: d_planta,
        area: d_area,
        formato: d_formato,
        familia: d_familia,
        color: d_color,
        tipo: d_tipo,
        estado: d_estado,
        descripcion: d_descripcion
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ActualizarCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          $("#vtn_ActualizarCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_ActualizarCargarNotificaciones", function(e){
    e.preventDefault();
    
    $("#vtn_ActualizarCargarNotificaciones").modal('hide');
    $("#vtn_ReferenciasEmergenciaActualizar").modal('hide');
    
    d_planta = $("#filtroReferenciasEmergencia_Planta").val();
    d_area = $("#filtroReferenciasEmergencia_Area").val();
    d_estado = $("#filtroReferenciasEmergencia_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_referenciasEmergenciaListar.php",
      beforeSend: function() {
        $(".info_ReferenciasEmergenciaListar").html(loader());
      },
      data:{ 
        planta: d_planta,
        area: d_area,
        estado: d_estado
      },
      success: function(data) {
        $(".info_ReferenciasEmergenciaListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
  
  $("body").on("click", ".e_eliminarReferencias", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_RefEmergenciaConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_RefEmergenciaEliminar").val(d_codigo);

  });
  
   $("body").on("click", "#Btn_RefEmergenciaConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_RefEmergenciaEliminar").val();
    $("#vtn_RefEmergenciaConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_referenciasEmergenciaEliminar.php",
      beforeSend: function () {
        $("#e_eliminarReferencias").hide();
      },
      complete: function () {
        $("#e_eliminarReferencias").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_EliminarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_EliminarCargarNotificaciones").modal({
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
  $("body").on("click", "#Btn_EliminarCargarNotificaciones", function(e){
    e.preventDefault();
    
    $("#vtn_EliminarCargarNotificaciones").modal('hide');
    
    d_planta = $("#filtroReferenciasEmergencia_Planta").val();
    d_area = $("#filtroReferenciasEmergencia_Area").val();
    d_estado = $("#filtroReferenciasEmergencia_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_referenciasEmergenciaListar.php",
      beforeSend: function() {
        $(".info_ReferenciasEmergenciaListar").html(loader());
      },
      data:{ 
        planta: d_planta,
        area: d_area,
        estado: d_estado
      },
      success: function(data) {
        $(".info_ReferenciasEmergenciaListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
});
