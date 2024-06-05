$(document).ready(function (e) {
  $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '<Ant',
    nextText: 'Sig>',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: "yy-mm-dd",
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: '',
    yearRange: '-100:+12',
  };
  $.datepicker.setDefaults($.datepicker.regional['es']);

  $("body").on("click", "#b_consultas", function (e) {
    $("#input_resultado").val($("#consuExtInf").html());
    $("#f_consulta").submit();
  });
  $("body").on("click", "#imprimir", function (e) {
    $("#input_resultado2").val($("#consuExtInf").html());
    $("#frmimprimir").submit();
  });

  $("body").on("click", "#b_consultascon", function (e) {
    $("#input_resultadocon").val($("#con_consolidadoGeneral").html());
    $("#f_consultacon").submit();
  });

  /*$("body").on("click", "#b_excelClientes", function(e) {
  		$("#input_resultadoClientes").val($("#imp_tablaClientes").html());
  		$("#f_consultaClientes").submit();
  });*/

  $("body").on("click", "#imprimircon", function (e) {
    $("#input_resultadocon2").val($("#con_consolidadoGeneral").html());
    $("#frmimprimircon").submit();
  });
});

function cargarfecha() {
  $(".fecha").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd"
  });
}

function cargarfechaLimitEsp(dias) {

  $(".fechaBloqueo1").datepicker({
    minDate: dias,
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd"
  });

}

function cargarfechaEntre(ini, fin) {

  $(".fechaEntre").datepicker({
    minDate: ini,
    maxDate: fin,
    changeMonth: true,
    changeYear: true,
    dateFormat: "yy-mm-dd"
  });

}

function cargarhora() {
  $(document).ready(function () {
    $('.hora').ptTimeSelect();
  });
}

function bloquearFormulario(formulario) {
  $("#" + formulario + " input, " + "#" + formulario + " select, " + "#" + formulario + " textarea").prop("readonly", true);
}

function desbloquearFormulario(formulario) {
  $("#" + formulario + " input, " + "#" + formulario + " select, " + "#" + formulario + " textarea").prop("readonly", false);
}

function mensaje(tipo, mensaje, div) {
  switch (tipo) {
    case '1':
      $(div).html('<br><div class="col-md-8 alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Operación Exitosa:</strong> ' + mensaje + '</div>');
      break;
    case '2':
      $(div).html('<br><div class="col-md-8 alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Error: </strong> ' + mensaje + '</div>');
      break;
  }

}

function number_format(a, b, c, d) {
  a = Math.round(a * Math.pow(10, b)) / Math.pow(10, b);
  e = a + '';
  f = e.split('.');
  if (!f[0]) {
    f[0] = '0';
  }
  if (!f[1]) {
    f[1] = '';
  }
  if (f[1].length < b) {
    g = f[1];
    for (i = f[1].length + 1; i <= b; i++) {
      g += '0';
    }
    f[1] = g;
  }
  if (d != '' && f[0].length > 3) {
    h = f[0];
    f[0] = '';
    for (j = 3; j < h.length; j += 3) {
      i = h.slice(h.length - j, h.length - j + 3);
      f[0] = d + i + f[0] + '';
    }
    j = h.substr(0, (h.length % 3 == 0) ? 3 : (h.length % 3));
    f[0] = j + f[0];
  }
  c = (b <= 0) ? '' : c;
  return f[0] + c + f[1];
}

function loader() {
  imgloader = '<div id="d_espera"><img src="../imagenes/loader.gif"></div>';
  return imgloader;
}

function format() {
  $(".format").maskMoney({
    mask: false,
    //prefix: "",
    thousands: ",",
    decimal: "",
    precision: 0,
    affixesStay: true,
    allowZero: true
  });
}

function format1() {
  $(".format1").maskMoney({
    mask: false,
    //prefix: "",
    thousands: ",",
    decimal: ".",
    precision: 1,
    affixesStay: true,
    allowZero: true
  });
}

function format2() {
  $(".format2").maskMoney({
    mask: false,
    //prefix: "",
    thousands: ",",
    decimal: ".",
    precision: 2,
    affixesStay: true,
    allowZero: true
  });
}

function format4() {
  $(".format4").maskMoney({
    mask: false,
    //prefix: "",
    thousands: ",",
    decimal: ".",
    precision: 4,
    affixesStay: true,
    allowZero: true
  });
}

function format5(){
  $(".format5").maskMoney({
    mask: false,
//    prefix: '',
    affixesStay: false,
    precision: 1,
    allowZero: true,
    allowNegative: true
  });
}


function inputDecimales() {
  $(".inputDecimales").keyup(function () {
    var val = $(this).val();
    if (isNaN(val)) {
      val = val.replace(/[^0-9\.,\-]/g, '');
      if (val.split(',').length > 0)
        val = val.replace(/\,/, ".");
      if (val.split('.').length > 2)
        val = val.replace(/\.+$/, "");    
      if (val.split('-').length > 2)
        val = val.replace(/[\-]/g, "");
    }
    $(this).val(val);
  });
}

function inputEntero() {
  $(".inputEntero").keyup(function () {
    var val = $(this).val();
    val = val.replace('.', "");
    if (isNaN(val)) {
      val = val.replace(/[^0-9/.,\-]/g, '');
      if (val.split('.').length > 2)
        val = val.replace(/\.+$/, "");
      if (val.split('-').length > 2)
        val = val.replace(/[\-]/g, "");
    }
    $(this).val(val);
  });
}

