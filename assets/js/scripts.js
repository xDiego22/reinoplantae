$(document).ready(function () {
    let stepper = new Stepper($(".bs-stepper")[0], {
        linear: false,
        animation: true
    });
    
    
    $("#anterior").on('click', function () {
        stepper.previous();
    });
    $("#siguiente").on('click', function () {
        stepper.next();
    });

    $("#enviar").on('click', () => {
        let datos = new FormData();
        datos.append("accion", "busqueda");
        datos.append("habitat", $(".habitat:checked").val());
        datos.append("inflorescencia", $(".inflorescencia:checked").val());
        datos.append("filogenia", $(".filogenia:checked").val());
        datos.append("reproduccion", $(".reproduccion:checked").val());
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
        success: function (respuesta) {
            if (accion === "busqueda") {
                $("#modalPregunta").modal('hide');
                Swal.fire({
                  title: "Tu planta es:",
                  html: `<h5>${respuesta}</h5>`,
                  icon: "success",
                });
            }
        },
        error: function(xhr){
            if (accion === "busqueda") {
                $("#modalPregunta").modal('hide');
                Swal.fire({
                  title: "Que Lastima",
                  html: `<h5>${xhr.responseText}</h5>`,
                  icon: "warning",
                });
            }
        }
    });
}