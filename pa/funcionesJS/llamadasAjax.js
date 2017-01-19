//-------------------------------//
//           INICIO             //
//-----------------------------//

function cargarInicio() {
    $(".cargaAjax").empty();
    $("#inicio").show("fast");
}
//-------------------------------//
//      Modulo Configuracion    //
//-----------------------------//


//----------------------------//
//          Usuarios         //
//--------------------------//
function cargarIngresarUsuario() {


    $("#inicio").hide('fast');
    $.get("configuracion/usuario/ingresarUsuario.php", function (r) {
        $.getScript("funcionesJS/configuracion/funcionesUsuarios.js");
        $(".cargaAjax").html(r);
    });
}

function cargarPerfilUsuario() {
    $("#inicio").hide("fast");
    $.get("configuracion/usuario/actualizarPerfil.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesUsuarios.js");
        $(".cargaAjax").html(r);
    });
}


function cargarActualizarEliminarUsuario() {
    $("#inicio").hide("fast");
    $.get("configuracion/usuario/actualizarEliminarUsuario.php", function (r) {
        $.getScript("funcionesJS/configuracion/funcionesUsuarios.js");

        $(".cargaAjax").html(r);
    });
}

//----------------------------------//
//      Administrar Contratos      //
//--------------------------------//

function cargarMantenerContratos() {
    $("#inicio").hide("fast");
    $.get("configuracion/contratos/administrarContratos.php", function (r) {

        $.getScript("funcionesJS/configuracion/funcionesAdmContratos.js");
        $.getScript("funcionesJS/cargarCalendario.js");

        $(".cargaAjax").html(r);

    });
}


//----------------------------------//
//      Administrar Checklist      //
//--------------------------------//

function cargarGenerarChecklist() {
    $("#inicio").hide("fast");
    $.get("admChecklist/generarChecklist.php", function (r) {

        $.getScript("funcionesJS/admChecklist/funcionesChecklist.js");
        $.getScript("funcionesJS/cargarCalendario.js");

        $(".cargaAjax").html(r);

    });

}


function cargarModificarChecklist() {

    $("#inicio").hide("fast");
    $.get("admChecklist/modificarChecklist.php", function (r) {

        $.getScript("funcionesJS/admChecklist/funcionesChecklist.js");
        $.getScript("funcionesJS/cargarCalendario.js");

        $(".cargaAjax").html(r);

    });
}

function cargarHistorialChecklist() {
    $("#inicio").hide("fast");
    $.get("admChecklist/historialChecklist.php", function (r) {

        $.getScript("funcionesJS/admChecklist/funcionesChecklist.js");
        $(".cargaAjax").html(r);

    });


}


//*****************************************//
//              ESTADISTICAS              //
//***************************************//
function cargarEstadisticas() {
    $("#inicio").hide("fast");
    
    $.get("estadisticas/estadisticas.php", function (r) {
        $.getScript("funcionesJS/estadisticas/funcionesEstadisticas.js");
        $(".cargaAjax").html(r);

    });
}