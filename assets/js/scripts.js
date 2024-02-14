$(document).ready(function () {
    
    $("#enviar").on('click', () => {
        let datos = new FormData();
        datos.append("accion", "busqueda");
        // datos.append("clave", $("#valor").val());
        ajax(datos, "busqueda");
    })
});

function ajax(datos,accion) {
    $.ajax({ 
        async: true,
        url: '', 
        type: 'POST',
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function(respuesta) {
            $("#mensaje").html(respuesta);
        },
        error: function(){
            $("#mensaje").html(respuesta);
        }
    });
}