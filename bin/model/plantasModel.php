<?php
namespace model;

use config\connect\connectDB as connectDB;
use PDO;
use Exception;

class plantasModel extends connectDB {
    
    public function obtenerPlantas() {
        try {

            $datos = array();
            $bd = $this->conexion(); 
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT p.id_planta as id, p.nombre AS nombre,h.habitat AS habitat, r.descripcion AS reproduccion, f.tipo AS filogenia, i.tipo AS inflorescencia, h.id as id_habitat, r.id as id_reproduccion, f.id as id_filogenia, i.id as id_inflorescencia FROM plantas p
            LEFT JOIN habitats h ON p.id_habitat = h.id
            LEFT JOIN reproduccion r ON p.id_reproduccion = r.id
            LEFT JOIN filogenia f ON p.id_filogenia = f.id
            LEFT JOIN inflorescencia i ON p.id_inflorescencia = i.id"; 

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $opciones = "<button type='button' class='btn btn-primary mb-1 me-1' data-bs-toggle='modal' data-bs-target='#modal_gestion' onclick='modalmodificar(this)' id='boton_modificar'><i class='bi bi-pencil-fill'></i></button><button type='button' class='btn btn-danger mb-1 ' onclick='elimina(this)'><i class='bi bi-x-lg'></i></button>";


            foreach($resultado as $fila){
                $subarray=array();
                $subarray['id'] = $fila['id'];
                $subarray['nombre'] = $fila['nombre'];
                $subarray['habitat'] = $fila['habitat'];
                $subarray['reproduccion'] = $fila['reproduccion'];
                $subarray['filogenia'] = $fila['filogenia'];
                $subarray['inflorescencia'] = $fila['inflorescencia'];
                $subarray['id_habitat'] = $fila['id_habitat'];
                $subarray['id_filogenia'] = $fila['id_filogenia'];
                $subarray['id_inflorescencia'] = $fila['id_inflorescencia'];
                $subarray['id_reproduccion'] = $fila['id_reproduccion'];
                $subarray['opciones'] = $opciones;

                $datos[] = $subarray;
            }
            $json = array(
                "data" => $datos
            );
				
            http_response_code(200);
			return json_encode($json);
        } catch (Exception $e) {
            http_response_code(500);
            echo "Error al obtener las plantas: " . $e->getMessage(); 
        }
    }

    public function registrar($nombre, $habitat, $filogenia, $inflorescencia, $reproduccion){
        try {
            if($this->validar($nombre, $habitat, $filogenia, $inflorescencia, $reproduccion)){
                if(!$this->existe($nombre)){
                    $bd = $this->conexion(); 
                    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                    $sql = 'INSERT INTO plantas (id_habitat, id_reproduccion, id_filogenia, id_inflorescencia, nombre) VALUES (?, ?, ?, ?, ?)';
                
                    $stmt = $bd->prepare($sql);
                    
                    $stmt->execute(array(
                        $habitat,
                        $reproduccion,
                        $filogenia,
                        $inflorescencia,
                        $nombre
                    ));
        
                    http_response_code(200);
                    return 'Registro Exitoso';
                }else{
                    http_response_code(500);
                    return "La planta ya existe";
                }
            }else{
                http_response_code(400);
                return 'Datos Invalidos';
            }
			
        } catch (Exception $e) {
            http_response_code(500);
            return "Error " . $e->getMessage(); 
        }
    }
    public function modificar($nombre, $habitat, $filogenia, $inflorescencia, $reproduccion){
        try {
            if($this->validar($nombre, $habitat, $filogenia, $inflorescencia, $reproduccion)){
                if($this->existe($nombre)){
                    $bd = $this->conexion(); 
                    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                    $sql = 'UPDATE plantas SET 
                    id_habitat = ?, 
                    id_reproduccion = ?, 
                    id_filogenia = ?, 
                    id_inflorescencia = ?, 
                    nombre = ?
                    where nombre = ?';
                
                    $stmt = $bd->prepare($sql);
                    
                    $stmt->execute(array(
                        $habitat,
                        $reproduccion,
                        $filogenia,
                        $inflorescencia,
                        $nombre,
                        $nombre
                    ));
        
                    http_response_code(200);
                    return 'Modificacion Exitosa';
                }else{
                    http_response_code(400);
                    return "La planta no existe";
                }
            }else{
                http_response_code(400);
                return 'Datos Invalidos';
            }
			
        } catch (Exception $e) {
            http_response_code(500);
            return "Error " . $e->getMessage(); 
        }
    }

    public function eliminar($id){
		
        if(preg_match_all('/^[0-9]{1,10}$/',$id)){
            
            if($this->existeId($id)){
                
                try{
                    $bd = $this->conexion();
                    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = 'DELETE from plantas where id_planta = ?';

                    $stmt = $bd->prepare($sql);
                    
                    $stmt->execute(array($id));		

                    if ($stmt) {
                        http_response_code(200);
                        return "Eliminado correctamente";
                    }
                    else{
                        http_response_code(400);
                        return "no eliminado";
                    }
                    
                }catch(Exception $e) {
                    http_response_code(500);
                    return $e->getMessage();
                }
            }
            else {
                http_response_code(400);
                return "planta no registrada";
            }
        }
        else{
            http_response_code(400);
            return "Datos Invalidos";
        }
		
	}
    
    public function listaHabitat(){
        try {

            $bd = $this->conexion(); 
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id, habitat as habitat FROM habitats"; 

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
			if($resultado){

				$respuesta = '';
				//ciclo foreach se usa casi siempre para recorrer los resultados de las consultas
				foreach($resultado as $r){
					$respuesta = $respuesta."<option value=".$r['id']. 
					">".$r['habitat']."</option>";
				}
				return $respuesta;
			}
			else {
				return '';
			}
        } catch (Exception $e) {
            return "Error " . $e->getMessage(); 
        }
    }
    public function listaInflorescencia(){
        try {

            $bd = $this->conexion(); 
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id, tipo as inflorescencia FROM inflorescencia"; 

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
			if($resultado){

				$respuesta = '';
				//ciclo foreach se usa casi siempre para recorrer los resultados de las consultas
				foreach($resultado as $r){
					$respuesta = $respuesta."<option value=".$r['id']. 
					">".$r['inflorescencia']."</option>";
				}
				return $respuesta;
			}
			else {
				return '';
			}
        } catch (Exception $e) {
            return "Error " . $e->getMessage(); 
        }
    }
    public function listaFilogenia(){
        try {

            $bd = $this->conexion(); 
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id, tipo as filogenia FROM filogenia"; 

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
			if($resultado){

				$respuesta = '';
				//ciclo foreach se usa casi siempre para recorrer los resultados de las consultas
				foreach($resultado as $r){
					$respuesta = $respuesta."<option value=".$r['id']. 
					">".$r['filogenia']."</option>";
				}
				return $respuesta;
			}
			else {
				return '';
			}
        } catch (Exception $e) {
            return "Error " . $e->getMessage(); 
        }
    }
    public function listaReproduccion(){
        try {

            $bd = $this->conexion(); 
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT id, descripcion as reproduccion FROM reproduccion"; 

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
			if($resultado){

				$respuesta = '';
				//ciclo foreach se usa casi siempre para recorrer los resultados de las consultas
				foreach($resultado as $r){
					$respuesta = $respuesta."<option value=".$r['id']. 
					">".$r['reproduccion']."</option>";
				}
				return $respuesta;
			}
			else {
				return '';
			}
        } catch (Exception $e) {
            return "Error " . $e->getMessage(); 
        }
    }

    private function validar($nombre,$habitat,$inflorescencia, $filogenia, $reproduccion) {

        
        if(!preg_match_all('/^[0-9A-Za-záéíóúÁÉÍÓÚñÑ ]{1,30}$/',$nombre)){
            return false; 
        }
        if(!preg_match_all('/^[0-9]{1,10}$/',$habitat)){
            return false; 
        }
        if(!preg_match_all('/^[0-9]{1,10}$/',$filogenia)){
            return false; 
        }
        if(!preg_match_all('/^[0-9]{1,10}$/',$inflorescencia)){
            return false; 
        }
        if(!preg_match_all('/^[0-9]{1,10}$/',$reproduccion)){
            return false; 
        }
        
        return true; 
    }

    private function existe($nombre){
        try {
            //if($this->validar($nombre)){
                
                $bd = $this->conexion();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM plantas
                WHERE nombre = ? ";
    
                $stmt = $bd->prepare($sql);
                
                $stmt->execute(array($nombre));

                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);;

                if ($resultado) {
                    http_response_code(200);
                    return true;
                }else{
                    http_response_code(500);
                    return false;
                }
            //}
        } catch (PDOException $e) {
            http_response_code(500);
            return 'ERROR: '.$e->getMessage();
        }
    }
    private function existeId($id){
        try {
            if(preg_match_all('/^[0-9]{1,10}$/',$id)){
                
                $bd = $this->conexion();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM plantas
                WHERE id_planta = ? ";
    
                $stmt = $bd->prepare($sql);
                
                $stmt->execute(array($id));

                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);;

                if ($resultado) {
                    http_response_code(200);
                    return true;
                }else{
                    http_response_code(500);
                    return false;
                }
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return 'ERROR: '.$e->getMessage();
        }
    }
}
