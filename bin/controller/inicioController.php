<?php
use model\inicioModel as inicioModel;   

use config\components\configSystem as configSystem;

$config = new configSystem;


if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}

if (is_file($config->_Dir_View_().$pagina.$config->_VIEW_())) {

	$objeto = new inicioModel(); 

    if(isset($_POST['accion'])){			
 
        $accion = $_POST['accion'];

        if($accion == 'busqueda'){
            
            $habitat = $_POST['habitat'];
            $inflorescencia = $_POST['inflorescencia'];
            $filogenia = $_POST['filogenia'];
            $reproduccion = $_POST['reproduccion'];

            echo $objeto->buscarPlanta($habitat,$inflorescencia,$filogenia,$reproduccion);
            exit;
        }		
        if($accion == 'agregar'){
            
            $nombre = $_POST['nombre'];
            $habitat = $_POST['habitat'];
            $inflorescencia = $_POST['inflorescencia'];
            $filogenia = $_POST['filogenia'];
            $reproduccion = $_POST['reproduccion'];

            echo $objeto->agregarPlanta($nombre,$habitat,$inflorescencia,$filogenia,$reproduccion);
            exit;
        }		

	}
    
    require_once($config->_Dir_View_().$pagina.$config->_VIEW_());
} else {
    echo "pagina en construccion";
}