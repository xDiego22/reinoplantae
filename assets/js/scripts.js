$(document).ready(function () {
    window.stepper = new Stepper($(".bs-stepper")[0], {
        linear: false,
        animation: true,
    });

    $("#enviar").on('click', () => {
        // Obtener los valores seleccionados
        let habitat = $(".habitat:checked").val();
        let inflorescencia = $(".inflorescencia:checked").val();
        let filogenia = $(".filogenia:checked").val();
        let reproduccion = $(".reproduccion:checked").val();

        if (habitat && inflorescencia && filogenia && reproduccion) {
          let datos = new FormData();
          datos.append("accion", "busqueda");
          datos.append("habitat", $(".habitat:checked").val());
          datos.append("inflorescencia", $(".inflorescencia:checked").val());
          datos.append("filogenia", $(".filogenia:checked").val());
          datos.append("reproduccion", $(".reproduccion:checked").val());
          ajax(datos, "busqueda");
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            },
          });
          Toast.fire({
            icon: "warning",
            title: "¡Faltan preguntas por responder!",
          });
        }
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
                
                $(".habitat").prop("checked", false);
                $(".inflorescencia").prop("checked", false);
                $(".filogenia").prop("checked", false);
                $(".reproduccion").prop("checked", false);
                
                const planta = JSON.parse(respuesta);
                Swal.fire({
                  title: `Tu planta es: ${planta.nombre}`,
                  html: `<span class='fs-5'><b>Su habitat es:</b> ${planta.habitat}</span>
                  <br>
                  <span class='fs-5'><b>Inflorescencia:</b> ${planta.inflorescencia}</span>
                  <br>
                  <span class='fs-5'><b>Filogenia:</b> ${planta.filogenia}</span>
                  <br>
                  <span class='fs-5'><b>Reproduccion:</b> ${planta.reproduccion}</span>`,
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