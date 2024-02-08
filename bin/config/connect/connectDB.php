<?php 
	namespace config\connect;
	use config\components\configSystem as configSystem;
	use \PDO;

	class connectDB extends configSystem{

		protected $conexion;
		private $usuario;
		private $password;
		private $local;
		private $nameDB;

		public function __construct(){

			$this->usuario = parent::_USER_();
			$this->password = parent::_PASS_();
			$this->local = parent::_LOCAL_();
			$this->nameDB = parent::_BD_();
			$this->conexionDB();
		}

		protected function conexionDB(){
			try{
				$this->conexion = new \PDO("mysql:host={$this->local};dbname={$this->nameDB}", $this->usuario , $this->password);
			}catch (PDOException $e) {
				print "¡Error!: " . $e->getMessage() . "<br/>";
				die();
		}
	}
	
 }
