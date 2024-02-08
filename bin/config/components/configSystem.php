<?php 

	namespace config\components;

	define("_URL_", "http://localhost/diego/plantae/");
	define("_BD_", "bdplantae");
	define("_PASS_", "");
	define("_USER_", "root");
	define("_LOCAL_", "localhost");
	define("DIRECTORY_CONTROLLER", "bin/controller/");
	define("DIRECTORY_MODEL", "bin/model/");
	define("DIRECTORY_VIEW", "view/");
	define("MODEL", "Model.php");
	define("CONTROLLER", "Controller.php");
	define("VIEW", "View.php");


	class configSystem {
		public function _int(){
			if(!file_exists("bin/controller/frontController.php")){
				return "Error configSystem";
			}
		}

		public function _URL_(){
			return _URL_;
		}
		public function _BD_(){
			return _BD_;
		}
		public function _PASS_(){
			return _PASS_;
		}
		public function _USER_(){
			return _USER_;
		}
		public function _LOCAL_(){
			return _LOCAL_;
		}
		public function _Dir_Control_(){
			return DIRECTORY_CONTROLLER; 
		}
		public function _Dir_Model_(){
			return DIRECTORY_MODEL; 
		}
		public function _Dir_View_(){
			return DIRECTORY_VIEW; 
		}
		public function _MODEL_(){
			return MODEL;
		}
		public function _Control_(){
			return CONTROLLER;
		}
		public function _VIEW_(){
			return VIEW;
		}
	}

 ?>