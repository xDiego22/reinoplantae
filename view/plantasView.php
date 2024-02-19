<!DOCTYPE html>
<html lang="es">
<head>
<head>
    <?php require_once('bin/component/head.php');?>

</head>
<body>
    <?php require_once('bin/component/navbar.php');?>

    <div class="container">
        <div class="caja-info">
            <div class="mt-4 mb-3">
                <div class="row justify-content-between">
                    <div class="col-auto mr-auto mb-2">
                        <div class="h4 text-dark">Listado de Plantas</div>
                    </div>
                    <div class="col-auto" >
                         
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_gestion" id="boton_nuevo" onclick="modalregistrar()">
                            <i class="bi bi-plus-circle me-1"></i>Nuevo registro
                        </button>
                        
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="tablaplantas" class='table table-striped table-hover table-borderless'>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Habitat</th>
                            <th>Filogenia</th>
                            <th>Inflorescencia</th>
                            <th>Reproduccion</th>
                            <th>id_habitat</th>
                            <th>id_filogenia</th>
                            <th>id_inflorescencia</th>
                            <th>id_reproduccion</th>
                            <th>opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

   <!-- Modal de Registro -->
    <div class="modal fade" id="modal_gestion" tabindex="-1" aria-labelledby="modal_gestionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_gestionLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-2">
                        <div class="col-md-12">
                            
                            <label for="nombre">Nombre</label>
                            <input type="text" maxlength="30" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la planta">
                        </div>
					</div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            
                            <label for="habitat">Habitat</label>
                            <select class="form-control" id="habitat">
                                <option value="" disabled selected>Seleccione una opción:</option>
                               
                               <?php
                                    if(!empty($habitat)){
                                        echo $habitat;
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            
                            <label for="filogenia">Filogenia</label>
                            <select class="form-control" name="filogenia" id="filogenia">
                                <option value="" disabled selected>Seleccione una opción:</option>
                               <?php
                                    if(!empty($filogenia)){
                                        echo $filogenia;
                                    }
                                ?>
                            </select>
                        </div>
					</div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            
                            <label for="inflorescencia">Inflorescencia</label>
                            <select class="form-control" id="inflorescencia">
                                <option value="" disabled selected>Seleccione una opción:</option>
                               
                               <?php
                                    if(!empty($inflorescencia)){
                                        echo $inflorescencia;
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            
                            <label for="reproduccion">Reproduccion</label>
                            <select class="form-control" name="reproduccion" id="reproduccion">
                                <option value="" disabled selected>Seleccione una opción:</option>
                               <?php
                                    if(!empty($reproduccion)){
                                        echo $reproduccion;
                                    }
                                ?>
                            </select>
                        </div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id='modificar' class="btn btn-success">Modificar</button>
                    <button type="button" id='registrar' class="btn btn-success">Registrar</button>
                </div>
            </div>
        </div>
    </div>


    <?php require_once('bin/component/scripts.php');?>
    <script type="text/javascript" src="assets/js/plantas.js"></script>

</body>
</html>
