var tabla;
$(document).ready(function () {
  tabla = $("#tablaplantas").DataTable({
    language: {
      url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
    },
    ajax: {
      url: "",
      type: "POST",
      data: { accion: "consultar" },
    },
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "habitat" },
      { data: "inflorescencia" },
      { data: "filogenia" },
      { data: "reproduccion" },
      { data: "id_habitat" , className: 'd-none'},
      { data: "id_filogenia" , className: 'd-none'},
      { data: "id_inflorescencia" , className: 'd-none'},
      { data: "id_reproduccion" , className: 'd-none'},
      { data: "opciones" },
    ],
    columnDefs: [
      {
        target: -1,
        searchable: false,
      },
    ],
    lengthMenu: [
      [10, 15, 20],
      [10, 15, 20],
    ],

    ordering: true,
    info: true,
  });

  $("#nombre").on("keypress", function (e) {
    validarkeypress(/^[A-Za-z0-9\sáéíóúÁÉÍÓÚñÑ]*$/, e);

  });

  $("#registrar").on("click", function () {
    if (validarboton()) {
      var datos = new FormData();
      datos.append("accion", "registrar");
      datos.append("nombre", $("#nombre").val());
      datos.append("habitat", $("#habitat").val());
      datos.append("inflorescencia", $("#inflorescencia").val());
      datos.append("filogenia", $("#filogenia").val());
      datos.append("reproduccion", $("#reproduccion").val());
      ajax(datos, "registrar");
    }else{
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
          title: "¡Datos incompletos!",
        });
    }
    $("#modal_gestion").modal("hide");
    limpia_formulario();
  });

  $("#modificar").on("click", function () {
    if (validarboton()) {
      let datos = new FormData();
      datos.append("accion", "modificar");
      datos.append("nombre", $("#nombre").val());
      datos.append("habitat", $("#habitat").val());
      datos.append("inflorescencia", $("#inflorescencia").val());
      datos.append("filogenia", $("#filogenia").val());
      datos.append("reproduccion", $("#reproduccion").val());
      ajax(datos, "modificar");
    }else{
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
          title: "¡Datos incompletos!",
        });
    }
    $("#modal_gestion").modal("hide");
    limpia_formulario();
  });
  
});

function ajax(datos, accion,fila = null) {
  $.ajax({
    async: true,
    url: "", 
    type: "POST", 
    contentType: false,
    data: datos,
    processData: false,
    cache: false,
    success: function (respuesta) {
      if (accion === "registrar") {
        tabla.ajax.reload(null, false);
        Swal.fire({
          title: `${respuesta}`,
          text: "La informacion ha sido agredada satisfactoriamente.",
          icon: "success",
        });
         
      } 
      if (accion === "modificar") {
        tabla.ajax.reload(null, false);
        Swal.fire({
          title: `${respuesta}`,
          text: "La informacion ha sido modificada satisfactoriamente.",
          icon: "success",
        });
         
      } 
      if (accion == "eliminar") {
        Swal.fire({
          title: `${respuesta}`,
          text: "La informacion ha sido eliminada.",
          icon: "success",
        });
        tabla.row(fila).remove().draw(false);
      }
    },
    error: function (xhr) {
      if (xhr.status === 500 || xhr.status === 400) {
        Swal.fire({
          title: "error",
          text: `${xhr.responseText}`,
          icon: "error",
        });
      } 
    },
  });
}

function limpia_formulario() {
  $("#nombre").val("");
  $("#habitat").val("");
  $("#inflorescencia").val("");
  $("#reproduccion").val("");
  $("#filogenia").val("");
}

function modalregistrar() {
  $("#modal_gestionLabel").html("Registrar");
  limpia_formulario();
  $("#registrar").show();
  $("#modificar").hide();

  // Habilitar el campo nombre
  $("#nombre").prop("disabled", false);
}

function modalmodificar(fila) {
  $("#modal_gestionLabel").html("Modificar");
  $("#modificar").show();
  $("#registrar").hide();

  let linea = $(fila).closest("tr");
  $("#nombre").val($(linea).find("td:eq(1)").text());
  $("#habitat").val($(linea).find("td:eq(6)").text());
  $("#filogenia").val($(linea).find("td:eq(7)").text());
  $("#inflorescencia").val($(linea).find("td:eq(8)").text());
  $("#reproduccion").val($(linea).find("td:eq(9)").text());
  
  $("#nombre").prop("disabled", true);

}

function elimina(fila) {
  Swal.fire({
    title: "¿Estas Seguro?",
    text: "¡No podrás revertir esto!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3B71CA",
    confirmButtonText: "Si, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      let linea = $(fila).closest("tr");
      let id = $(linea).find("td:eq(0)");

      let datos = new FormData();
      datos.append("accion", "eliminar");
      datos.append("id", id.text());
      ajax(datos, "eliminar", linea);
    }
  });
}

function validarkeypress(er, e) {
  codigo = e.keyCode; //codigo ascii

  tecla = String.fromCharCode(codigo); //transformar codigo ascii generado al pulsar boton a una tecla

  tecla_bien = er.test(tecla); //evalua con la expresion regular y almacena

  //elimnina tecla fuera de la expresion regular
  if (!tecla_bien) {
    e.preventDefault();
  }
}

function validarboton () {	
	
	if ($("#nombre").val()=="" && $("#habitat").val()=="" && $("#filogenia").val()=="" && $("#inflorescencia").val()=="" && $("#reproduccion").val()=="") {
		return false;
	}
	 
	else if ($("#nombre").val()=="") {
		return false;
	}
	else if ($("#habitat").val()=="") {
		return false;
	}
	
	else if ($("#filogenia").val()=="") {
		return false;
	}
	else if ($("#inflorescencia").val()=="") {
		return false;
	}
	else if ($("#reproduccion").val()=="") {
		return false;
	}
	else{
		return true;	
	}
	
}