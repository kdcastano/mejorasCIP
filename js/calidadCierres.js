$(document).ready(function(e) {
  
  //OPERADOR
  
  d_agr = $("#cierre_agr").val();
  d_fecha = $("#filtroCierres_Fecha").val();

//  d_horI = $("#cierre_horI").val();
//  d_horF = $("#cierre_horF").val();
  
  $.ajax({
    type:"POST",
    url:"f_calidadCierres.php",
    beforeSend: function() {
      $(".info_cargarCierresCalidad").html(loader());
    },
    data:{ 
      agr: d_agr,
      fecha: d_fecha
  //    horI: d_horI,
  //    horF: d_horF
    },
    success: function(data) {
      $(".info_cargarCierresCalidad").html(data);
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  $("body").on("change", "#filtroCierres_Fecha", function(e){
    e.preventDefault();
    
    d_agr = $("#cierre_agr").val();
    d_fecha = $("#filtroCierres_Fecha").val();

    $.ajax({
      type:"POST",
      url:"f_calidadCierres.php",
      beforeSend: function() {
        $(".info_cargarCierresCalidad").html(loader());
      },
      data:{ 
        agr: d_agr,
        fecha: d_fecha
      },
      success: function(data) {
        $(".info_cargarCierresCalidad").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  //ADMINISTRADOR
  
  $("body").on("click", "#Btn_CierresBuscar", function(e){
    e.preventDefault();
    
    d_agr = $("#filtroCierres_AgrupacionPT").val();
    d_fecha = $("#filtroCierres_FechaAdmin").val();

    $.ajax({
      type:"POST",
      url:"f_calidadCierres.php",
      beforeSend: function() {
        $(".info_cargarCierresCalidadAdmin").html(loader());
      },
      data:{ 
        agr: d_agr,
        fecha: d_fecha
      },
      success: function(data) {
        $(".info_cargarCierresCalidadAdmin").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  


});