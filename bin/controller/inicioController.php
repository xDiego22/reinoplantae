<?php
use model\inicioModel as inicio;

use config\components\configSystem as configSystem;

$config = new configSystem;


if (!is_file($config->_Dir_Model_().$pagina.$config->_MODEL_())) {
    echo "Falta definir la clase " . $pagina;
    exit;
}

if (is_file($config->_Dir_View_().$pagina.$config->_VIEW_())) {

    
    
    require_once($config->_Dir_View_().$pagina.$config->_VIEW_());
} else {
    echo "pagina en construccion";
}