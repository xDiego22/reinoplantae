<?php 

	namespace bin\controller;

	use config\components\configSystem as configSystem;

	class frontController extends configSystem{
		private $directory;
		private $pagina;
		private $controlador;

		public function __construct($request){
			if (isset($request["pagina"])) {
				$this->pagina = $request["pagina"];
                $system = new configSystem();
                $this->directory = $system->_Dir_Control_();
                $this->controlador = $system->_Control_();
				$this->validarpagina();
			}else{
                die("<script>window.location='?pagina=inicio'</script>");
			}
		}

		private function validarpagina(){
			$pattern = preg_match_all("/^[a-zA-Z0-9-@\/.=:_#$]{1,700}$/", $this->pagina);
			if ($pattern == 1) {
				$this->_loadPage($this->pagina);
			}else{
				die('La url ingresada es inválida');
			}
		}

		private function _loadPage($pagina){
			if(file_exists($this->directory.$pagina.$this->controlador)){
				require_once($this->directory.$pagina.$this->controlador);
			} else{
				if(file_exists($this->directory.$pagina.$this->controlador)){
					die("<script>window.location='?pagina=inicio'</script>");
                }else{
                    die("pagina en construccion");
                }
		    }
	    }
}
?>