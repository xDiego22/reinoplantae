<?php
use model\plantasModel as plantasModel;   

use config\components\configSystem as configSystem;

$config = new configSystem;


if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}

if (is_file($config->_Dir_View_().$pagina.$config->_VIEW_())) {

	$objeto = new plantasModel(); 

    if(isset($_POST['accion'])){			
 
        $accion = $_POST['accion'];

        if($accion === 'consultar'){
            echo $objeto->obtenerPlantas();
            
        }
        if($accion === 'registrar'){

            $nombre = $_POST['nombre'];
            $habitat = $_POST['habitat'];
            $inflorescencia = $_POST['inflorescencia'];
            $filogenia = $_POST['filogenia'];
            $reproduccion = $_POST['reproduccion'];
            
            echo $objeto->registrar($nombre,$habitat,$filogenia,$inflorescencia,$reproduccion);
            
        }
        if($accion === 'modificar'){

            $nombre = $_POST['nombre'];
            $habitat = $_POST['habitat'];
            $inflorescencia = $_POST['inflorescencia'];
            $filogenia = $_POST['filogenia'];
            $reproduccion = $_POST['reproduccion'];

            echo $objeto->modificar($nombre,$habitat,$filogenia,$inflorescencia,$reproduccion);
            
        }
        if($accion === 'eliminar'){

            $id = $_POST['id'];
        
            echo $objeto->eliminar($id);
            
        }

        exit;
	}
    $inflorescencia = $objeto->listaInflorescencia();
    $habitat = $objeto->listaHabitat();
    $reproduccion = $objeto->listaReproduccion();
    $filogenia = $objeto->listaFilogenia();

    require_once($config->_Dir_View_().$pagina.$config->_VIEW_());
} else {
    echo "pagina en construccion";
}