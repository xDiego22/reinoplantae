<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once('bin/component/head.php');?>
</head>
<body>
    <?php require_once('bin/component/navbar.php');?>

    <div class="container">
        <div class="caja-info">
            <h2>Bienvenido a nuestra página sobre la clasificación del reino de las plantas 🌱</h2>
            <p>En esta página encontrarás información sobre la clasificación del reino de las plantas, que es una parte fundamental de la biología y la botánica. Las plantas se clasifican en diferentes categorías, desde especies individuales hasta grupos más amplios.</p>
            
            <p>Explora nuestra página para aprender más sobre la diversidad de las plantas y su fascinante clasificación.</p>
            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalPregunta">
                Clasificación
            </button>
        </div>
    </div>
        
    <!-- Modal -->
    <div class="modal fade" id="modalPregunta" tabindex="-1" aria-labelledby="modalPreguntaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalPreguntaLabel">Pregunta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="mensaje">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="enviar" type="button" class="btn btn-success">Guardar</button>
            </div>
            </div>
        </div>
    </div>

    <?php require_once('bin/component/scripts.php');?>
    
</body>
</html>