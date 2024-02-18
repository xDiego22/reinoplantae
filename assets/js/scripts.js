$(document).ready(function () {
    window.stepper = new Stepper($(".bs-stepper")[0], {
        linear: false,
        animation: true,
    });

    $("#enviar").on('click', () => {
        
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
    success: async function (respuesta) {
      if (accion === "busqueda") {

        $("#modalPregunta").modal('hide');
        
        const plantas = JSON.parse(respuesta);
        const cantidadCoincidentes = Object.keys(plantas).length;

        if (cantidadCoincidentes > 1) {
          // Crear objeto con opciones para el input select
          const opciones = {};
          Object.keys(plantas).forEach((key, index) => {
            opciones[index] = plantas[key].nombre; // Asignar el nombre de la planta como valor de la opción
          });

          const { value: opcionSeleccionada } = await Swal.fire({
            title: `Se encontraron ${cantidadCoincidentes} coincidencias`,
            text: "¿cual es su planta?",
            icon: "info",
            input: "select",
            inputOptions: opciones,
            inputPlaceholder: "Seleccionar planta",
            cancelButtonText: "No esta mi planta",
            confirmButtonColor: "#2EB42F",
            cancelButtonColor: "#848484",
            showCancelButton: true,
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value !== "") {
                  resolve();
                } else {
                  resolve("Seleccione una opción");
                }
              });
            },
          });

          if (opcionSeleccionada !== undefined) {

            const plantaSeleccionada = plantas[Object.keys(plantas)[opcionSeleccionada]]; // Obtener la planta seleccionada
            alertInfoPlanta(plantaSeleccionada);
          } else {
            alertAgregarPlanta();
          }

        } else if (cantidadCoincidentes === 1) {
          const plantaUnica = Object.values(plantas)[0];
          alertInfoPlanta(plantaUnica);
        }

      }
      
      if (accion === "agregar") {
        
        Swal.fire({
          title: `${respuesta}`,
          text: "Su planta ha sido registrada exitosamente",
          icon: "success",
        });

        desmarcarOpciones();
      }
    },
    error: function(xhr){
      
      if (xhr.status === 404) {
        if (accion === "busqueda") {
          $("#modalPregunta").modal('hide');
          alertAgregarPlanta();
        }
      } 
      if (xhr.status === 500 || xhr.status === 400) {
        Swal.fire({
          title: "error",
          text: `${xhr.responseText}`,
          icon: "error",
        });
      } 
    },
    complete: function () {
      stepper.to(1);
    }
  });
}

function desmarcarOpciones() {
  $(".habitat").prop("checked", false);
  $(".inflorescencia").prop("checked", false);
  $(".filogenia").prop("checked", false);
  $(".reproduccion").prop("checked", false);
}

function alertInfoPlanta(planta) {
  Swal.fire({
    title: `Tu planta es: ${planta.nombre}`,
    showDenyButton: true,
    showCancelButton: true,
    denyButtonColor: "#848484",
    denyButtonText: "No es mi planta",
    cancelButtonColor: "#D51C1C",
    cancelButtonText: "Cancelar",
    html: `<span class='fs-5'><b>Su habitat es:</b> ${planta.habitat}</span>
    <br>
    <span class='fs-5'><b>Inflorescencia:</b> ${planta.inflorescencia}</span>
    <br>
    <span class='fs-5'><b>Filogenia:</b> ${planta.filogenia}</span>
    <br>
    <span class='fs-5'><b>Reproduccion:</b> ${planta.reproduccion}</span>`,
    icon: "success",
  }).then((result) => {
    if (result.isDenied) {
      alertAgregarPlanta();
    } else {
      desmarcarOpciones();
    }
  });
}

function alertAgregarPlanta() {
  Swal.fire({
    title: "Su planta no existe, ¿Desea registrar su planta?",
    text: "¡Se registrara la plantas con los datos suministrados!",
    icon: "info",
    showCancelButton: true,
    confirmButtonColor: "#2EB42F",
    cancelButtonColor: "#D51C1C",
    confirmButtonText: "Si, agregar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Nombre de la planta:",
        input: "text",
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonColor: "green",
        cancelButtonColor: "#D51C1C",
        confirmButtonText: "Enviar",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async (nombre) => {
          let datos = new FormData();
          datos.append("accion", "agregar");
          datos.append("nombre", nombre);
          datos.append("habitat", $(".habitat:checked").val());
          datos.append("inflorescencia", $(".inflorescencia:checked").val());
          datos.append("filogenia", $(".filogenia:checked").val());
          datos.append("reproduccion", $(".reproduccion:checked").val());
          ajax(datos, "agregar");
        },
        allowOutsideClick: () => !Swal.isLoading(),
      });
    } else {
      desmarcarOpciones();
    }
  });
}