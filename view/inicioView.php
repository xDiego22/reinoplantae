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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPreguntaLabel">Pregunta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="mensaje">

                    
                    <div id="" class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#habitat-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="habitat-part" id="habitat-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Habitat</span>
                                </button>
                            </div>

                            <div class="line"></div>

                            <div class="step" data-target="#inflorescencia-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="inflorescencia-part" id="inflorescencia-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Inflorescencia</span>
                                </button>
                            </div>

                            <div class="line"></div>

                            <div class="step" data-target="#filogenia-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="filogenia-part" id="filogenia-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Filogenia</span>
                                </button>
                            </div>

                            <div class="line"></div>
                            
                            <div class="step" data-target="#reproduccion-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="reproduccion-part" id="reproduccion-part-trigger">
                                    <span class="bs-stepper-circle">4</span>
                                    <span class="bs-stepper-label">Reproduccion</span>
                                </button>
                            </div>

                        </div>

                        <div class="bs-stepper-content">
                            <!-- your steps content here -->
                            
                            <div id="habitat-part" class="content" role="tabpanel" aria-labelledby="habitat-part-trigger">
                                
                                <h5 class="text-wrap my-2">¿En que tipo de habitat natural es mas probable encontrar esta planta?</h5>

                                <div class="form-check mt-2">
                                    <input class="form-check-input habitat" type="radio" value="Agua Dulce" name="habitat" id="habitat1">
                                    <label class="form-check-label" for="habitat1">
                                    Agua Dulce
                                    </label>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Agua Salada" name="habitat" id="habitat2">
                                    <label class="form-check-label" for="habitat2">
                                    Agua Salada
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Desierto" name="habitat" id="habitat3">
                                    <label class="form-check-label" for="habitat3">
                                    Desierto
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Tundra" name="habitat" id="habitat4">
                                    <label class="form-check-label" for="habitat4">
                                    Tundra
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Selva" name="habitat" id="habitat5">
                                    <label class="form-check-label" for="habitat5">
                                    Selva
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Sabana" name="habitat" id="habitat6">
                                    <label class="form-check-label" for="habitat6">
                                    Sabana
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Bosque" name="habitat" id="habitat7">
                                    <label class="form-check-label" for="habitat7">
                                    Bosque
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Pradera" name="habitat" id="habitat8">
                                    <label class="form-check-label" for="habitat8">
                                    Pradera
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input habitat" type="radio" value="Pantano" name="habitat" id="habitat9">
                                    <label class="form-check-label" for="habitat9">
                                    Pantano
                                    </label>
                                </div>

                                <div class="d-flex justify-content-evenly mt-4">

                                    <button type='button' onclick="stepper.next();" class="btn btn-primary"> <i class="bi bi-arrow-right me-2"></i>Siguiente</button>
                                </div>
                            </div>

                            <div id="inflorescencia-part" class="content" role="tabpanel" aria-labelledby="inflorescencia-part-trigger">
                                
                                <h5 class="text-wrap my-2">¿Cúal es el tipo de inflorescencia característico de esta planta?</h5>

                                <div class="form-check mt-3">
                                    <input class="form-check-input inflorescencia" type="radio" value="Flotante" name="inflorescencia" id="inflorescencia1">
                                    <label class="form-check-label" for="inflorescencia1">
                                    Flotante
                                    </label>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input inflorescencia" type="radio" value="Sumergida" name="inflorescencia" id="inflorescencia2">
                                    <label class="form-check-label" for="inflorescencia2">
                                    Sumergida
                                    </label>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input inflorescencia" type="radio" value="Espiciforme" name="inflorescencia" id="inflorescencia3">
                                    <label class="form-check-label" for="inflorescencia3">
                                    Espiciforme
                                    </label>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input inflorescencia" type="radio" value="Racemosa" name="inflorescencia" id="inflorescencia4">
                                    <label class="form-check-label" for="inflorescencia4">
                                    Racemosa
                                    </label>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input inflorescencia" type="radio" value="Cimosa" name="inflorescencia" id="inflorescencia5">
                                    <label class="form-check-label" for="inflorescencia5">
                                    Cimosa
                                    </label>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input inflorescencia" type="radio" value="Capituliforme" name="inflorescencia" id="inflorescencia6">
                                    <label class="form-check-label" for="inflorescencia6">
                                    Capituliforme
                                    </label>
                                </div>

                                <div class="d-flex justify-content-evenly mt-4">

                                    <button type='button' onclick="stepper.previous();" class="btn btn-primary"><i class="bi bi-arrow-left me-2"></i>Anterior</button>
                                    <button type='button' onclick="stepper.next();" class="btn btn-primary"> <i class="bi bi-arrow-right me-2"></i>Siguiente</button>
                                </div>
                            </div>

                            <div id="filogenia-part" class="content" role="tabpanel" aria-labelledby="filogenia-part-trigger">
                                
                                <h5 class="text-wrap my-2">¿Cúal es la Filogenia de esta planta?</h5>
                                <div class="form-check mt-3">
                                    <input class="form-check-input filogenia" type="radio" value="Angiospermas" name="filogenia" id="filogenia1">
                                    <label class="form-check-label" for="filogenia1">
                                    Angiospermas
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input filogenia" type="radio" value="Gimnospermas" name="filogenia" id="filogenia2">
                                    <label class="form-check-label" for="filogenia2">
                                    Gimnospermas
                                    </label>
                                </div>
                                <div class="d-flex justify-content-evenly mt-4">

                                    <button type='button' onclick="stepper.previous();" class="btn btn-primary"><i class="bi bi-arrow-left me-2"></i>Anterior</button>
                                    <button type='button' onclick="stepper.next();" class="btn btn-primary"> <i class="bi bi-arrow-right me-2"></i>Siguiente</button>
                                </div>
                            </div>

                            <div id="reproduccion-part" class="content" role="tabpanel" aria-labelledby="reproduccion-part-trigger">
                                
                                <h5 class="text-wrap my-2">¿Cómo se reproduce principalmente esta planta?</h5>
                                
                                <div class="form-check mt-3">
                                    <input class="form-check-input reproduccion" type="radio" value="Semilla" name="reproduccion" id="reproduccion1">
                                    <label class="form-check-label" for="reproduccion1">
                                    Semilla
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input reproduccion" type="radio" value="Division" name="reproduccion" id="reproduccion2">
                                    <label class="form-check-label" for="reproduccion2">
                                    Division
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input reproduccion" type="radio" value="Esquejes" name="reproduccion" id="reproduccion3">
                                    <label class="form-check-label" for="reproduccion3">
                                    Esquejes
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input reproduccion" type="radio" value="Polen" name="reproduccion" id="reproduccion4">
                                    <label class="form-check-label" for="reproduccion4">
                                    Polen
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input reproduccion" type="radio" value="Fecundacion" name="reproduccion" id="reproduccion5">
                                    <label class="form-check-label" for="reproduccion5">
                                    Fecundacion
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input reproduccion" type="radio" value="Estolones" name="reproduccion" id="reproduccion6">
                                    <label class="form-check-label" for="reproduccion6">
                                    Estolones
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input reproduccion" type="radio" value="Bulbos" name="reproduccion" id="reproduccion7">
                                    <label class="form-check-label" for="reproduccion7">
                                    Bulbos
                                    </label>
                                </div>

                                <div class="d-flex justify-content-evenly mt-4">

                                    <button type='button' onclick="stepper.previous();"  class="btn btn-primary"><i class="bi bi-arrow-left me-2"></i>Anterior</button>
                                    <button id="enviar" type="button" class="btn btn-success"> <i class="bi bi-send-fill me-2"></i>Enviar</button>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

    <?php require_once('bin/component/scripts.php');?>
    
</body>
</html>