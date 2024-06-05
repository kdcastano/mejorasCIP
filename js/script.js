$(document).ready(function(e) {
//Ejecutar Función en el evento click
document.getElementById("btn_open").addEventListener("click", open_close_menu);
//Declaramos variables
var side_menu = document.getElementById("menu_side");
var btn_open = document.getElementById("btn_open");
var body = document.getElementById("body");

//Evento para mostrar y ocultar menu 
  function open_close_menu(){
    body.classList.toggle("body_move");
    side_menu.classList.toggle("menu__side_move");
  }
  document.getElementById("btn_close").addEventListener("click", open_menu);
//Declaramos variables
var side_menu1 = document.getElementById("menu_side");
var btn_open1 = document.getElementById("btn_close");
var body1 = document.getElementById("body");

//Evento para mostrar y ocultar menu 
  function open_menu(){
    body1.classList.toggle("body_move");
    side_menu1.classList.toggle("menu__side_move");
  }
});

