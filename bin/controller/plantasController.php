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


	}
    
    require_once($config->_Dir_View_().$pagina.$config->_VIEW_());
} else {
    echo "pagina en construccion";
}