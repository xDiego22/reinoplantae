<!DOCTYPE html>
<html lang="es">
<head>
<head>
    <?php require_once('bin/component/head.php');?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
    $(document).ready(function() {
        $('#tablaplantas').DataTable();
    });
    </script>

</head>
<body>
    <?php require_once('bin/component/navbar.php');?>

    <div class="container">
        <div class="caja-info">
            <h2 class="text-center">Consulta de Plantas</h2>

            <?php
        require_once('bin/model/plantasModel.php');

        use model\plantasModel;

        $plantasModel = new plantasModel();
        $plantas = $plantasModel->obtenerPlantas();
        ?>

        <div class="table-responsive">
        <table id="tablaplantas" class="table table-striped" style="width:100%">

        <div style="text-align: right;">
          <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal_registro">
          <i class="bi bi-flower2"></i> Nuevo registro
          </button>
         </div>

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Habitat</th>
                    <th>Filogenia</th>
                    <th>Inflorescencia</th>
                    <th>Reproduccion</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plantas as $planta): ?>
                    <tr>
                        <td><?php echo $planta['nombre']; ?></td>
                        <td><?php echo $planta['habitats']; ?></td>
                        <td><?php echo $planta['filogenia']; ?></td>
                        <td><?php echo $planta['inflorescencia']; ?></td>
                        <td><?php echo $planta['reproduccion']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="modificarPlanta()">Modificar</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="eliminarPlanta()">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                </div>
            </div>

   <!-- Modal de Registro -->
<div class="modal fade" id="modal_registro" tabindex="-1" aria-labelledby="modal_registroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_registroLabel">Nuevo Registro de Planta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre de la planta">
                    </div>
                    <div class="form-group">
                        <label for="habitat">Habitat</label>
                        <select class="form-control" id="habitat">
                            <option value="" disabled selected>Seleccione una opción:</option>
                            <option value="Agua Dulce">Agua Dulce</option>
                            <option value="Agua salada">Agua salada</option>
                            <option value="Desierto">Desierto</option>
                            <option value="Selva">Selva</option>
                            <option value="Tundra">Tundra</option>
                            <option value="Sabana">Sabana</option>
                            <option value="Bosque">Bosque</option>
                            <option value="Pradera">Pradera</option>
                            <option value="Pantano">Pantano</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="filogenia">Filogenia</label>
                        <select class="form-control" id="filogenia">
                            <option value="" disabled selected>Seleccione una opción:</option>
                            <option value="Angiosperma">Angiosperma</option>
                            <option value="Gimnosperma">Gimnosperma</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inflorescencia">Inflorescencia</label>
                        <select class="form-control" id="inflorescencia">
                            <option value="" disabled selected>Seleccione una opción:</option>
                            <option value="Flotante">Flotante</option>
                            <option value="Sumergida">Sumergida</option>
                            <option value="Espiciforme">Espiciforme</option>
                            <option value="Racemosa">Racemosa</option>
                            <option value="Cimosa">Cimosa</option>
                            <option value="Capituliforme">Capituliforme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reproduccion">Reproduccion</label>
                        <select class="form-control" id="reproduccion">
                            <option value="" disabled selected>Seleccione una opción:</option>
                            <option value="Semilla">Semilla</option>
                            <option value="Division">Division</option>
                            <option value="Esquejes">Esquejes</option>
                            <option value="Polen">Polen</option>
                            <option value="Fecundacion">Fecundacion</option>
                            <option value="Estolones">Estolones</option>
                            <option value="Bulbos">Bulbos</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success">Registrar</button>
            </div>
        </div>
    </div>
</div>


    <?php require_once('bin/component/scripts.php');?>

</body>
</html>
