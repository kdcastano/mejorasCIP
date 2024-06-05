$(document).ready(function(e) {
  $('#filtroSemanas_Planta').multiselect({
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

  $("body").on("click", "#Btn_SemanasBuscar", function(e){
    e.preventDefault();
    
    d_estado = $("#filtroSemanas_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_semanasListar.php",
      beforeSend: function() {
        $(".info_SemanasListar").html(loader());
      },
      data:{ 
        estado: d_estado
      },
      success: function(data) {
        $(".info_SemanasListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_SemanasCrear", function(e){
    e.preventDefault();
    
    $("#vtn_SemanasCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_semanasCrear.php",
      beforeSend: function() {
        $(".info_SemanasCrear").html(loader());
      },
      data:{  },
      success: function(data) {
        $(".info_SemanasCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("submit", "#f_semanasCrear", function(e){
    e.preventDefault();
    
    d_semana = $("#f_semanasCrear #Sem_Semana").val();
    d_fechaIni = $("#f_semanasCrear #Sem_FechaInicial").val();
    d_fechaFin = $("#f_semanasCrear #Sem_FechaFinal").val();
    
    $.ajax({
      type:"POST",
      url:"op_semanasCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_semanasCrear");
        $("#Btn_SemanasCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_semanasCrear");
        $("#Btn_SemanasCrearForm").show();
      },
      data: { 
        semana: d_semana,
        fechaIni: d_fechaIni,
        fechaFin: d_fechaFin
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_SemanasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_SemanasNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          $("#vtn_SemanasNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_SemanasNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_SemanasNotificacionesCrear", function(e){
    e.preventDefault();
    $("#vtn_SemanasNotificacionesCrear").modal('hide');
    $("#vtn_SemanasCrear").modal('hide');
    
    d_estado = $("#filtroSemanas_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_semanasListar.php",
      beforeSend: function() {
        $(".info_SemanasListar").html(loader());
      },
      data:{ 
        estado: d_estado
      },
      success: function(data) {
        $(".info_SemanasListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_editarSemana", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $("#vtn_SemanasActualizar").modal({
      backdrop: 'static'
    });    
    $.ajax({
      type:"POST",
      url:"f_semanasActualizar.php",
      beforeSend: function() {
        $(".info_SemanassActualizar").html(loader());
      },
      data:{ 
        codigo: d_codigo
      },
      success: function(data) {
        $(".info_SemanassActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("submit", "#f_semanasActualizar", function(e){
    e.preventDefault();
    
    d_codigo = $("#f_semanasActualizar #codigoAct").val();
    d_estado = $("#f_semanasActualizar #Sem_EstadoAct").val();
    d_semana = $("#f_semanasActualizar #Sem_SemanaAct").val();
    d_fechaIni = $("#f_semanasActualizar #Sem_FechaInicialAct").val();
    d_fechaFin = $("#f_semanasActualizar #Sem_FechaFinalAct").val();
    
    $.ajax({
      type:"POST",
      url:"op_semanasActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_semanasActualizar");
        $("#Btn_SemanasActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_semanasActualizar");
        $("#Btn_SemanasActualizarForm").show();
      },
      data: { 
        codigo: d_codigo,
        semana: d_semana,
        fechaIni: d_fechaIni,
        fechaFin: d_fechaFin,
        estado: d_estado
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_SemanasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_SemanasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          $("#vtn_SemanasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_SemanasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_SemanasNotificacionesActualizar", function(e){
    e.preventDefault();
    $("#vtn_SemanasNotificacionesActualizar").modal('hide');
    $("#vtn_SemanasActualizar").modal('hide');
    
    d_estado = $("#filtroSemanas_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_semanasListar.php",
      beforeSend: function() {
        $(".info_SemanasListar").html(loader());
      },
      data:{ 
        estado: d_estado
      },
      success: function(data) {
        $(".info_SemanasListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarSemana", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_SemanasConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_SemanaEliminar").val(d_codigo);

  });
  
  $("body").on("click", "#Btn_SemanasConfNotificacionesEliminar", function(e){
    e.preventDefault();
    
    d_codigo = $(".Cod_SemanaEliminar").val();
    $("#vtn_SemanasConfNotificacionesEliminar").modal('hide');
    
    $.ajax({
      type:"POST",
      url:"op_semanasEliminar.php",
      beforeSend: function() {
        $(".e_eliminarSemana").hide();
      },
      complete: function() {
        $(".e_eliminarSemana").show();
      },
      data: { 
        codigo: d_codigo
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_SemanasNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_SemanasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          $("#vtn_SemanasNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_SemanasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_SemanasNotificacionesEliminar", function(e){
    e.preventDefault();
    $("#vtn_SemanasNotificacionesEliminar").modal('hide');
    
    d_estado = $("#filtroSemanas_Estado").val();    
    $.ajax({
      type:"POST",
      url:"f_semanasListar.php",
      beforeSend: function() {
        $(".info_SemanasListar").html(loader());
      },
      data:{ 
        estado: d_estado
      },
      success: function(data) {
        $(".info_SemanasListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
});