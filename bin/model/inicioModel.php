<?php
namespace model;
use config\connect\connectDB as connectDB;
use SplQueue;
use PDO;
use Exception;

class inicioModel extends connectDB{
    
    public function buscarPlanta($habitat,$inflorescencia, $filogenia, $reproduccion) {

        try {
            if($this->validar($habitat,$inflorescencia, $filogenia, $reproduccion)){
                
                $bd = $this->conexion();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                //plantas traidas de la base de datos
                $plantas = $this->consultaPlantas();

                // Array para almacenar las plantas coincidentes
                $plantasCoincidentes = [];
    
                $cola = new SplQueue(); // Crear una nueva cola
                $visitados = []; // Array para rastrear nodos visitados
    
                foreach ($plantas as $planta) {
                    $cola->enqueue([$planta['nombre'], []]); // El segundo elemento del array es el camino hasta este nodo
                }
            
                while (!$cola->isEmpty()) {

                    list($nombrePlanta, $camino) = $cola->dequeue();
                    //obtiene cada planta de la lista para comprobar si coinciden las caracteristicas
                    $planta = $this->obtenerPlantaPorNombre($plantas,$nombrePlanta);
                    
                    if (isset($planta['habitat']) && $planta['habitat'] === $habitat &&
                        isset($planta['inflorescencia']) && $planta['inflorescencia'] === $inflorescencia &&
                        isset($planta['filogenia']) && $planta['filogenia'] === $filogenia &&
                        isset($planta['reproduccion']) && $planta['reproduccion'] === $reproduccion) {
                        // Agregar la planta al array asociativo de plantas coincidentes
                        $plantasCoincidentes[$nombrePlanta] = $planta;
                    }
                    
                    // Si no coincide, agregamos los nodos vecinos (en este caso, todas las plantas) a la cola
                    
                    $nombreVecino = $planta['nombre'];
                    if (!in_array($nombreVecino, $visitados)) {
                        $nuevoCamino = $camino;
                        $nuevoCamino[] = $nombreVecino;
                        $cola->enqueue([$nombreVecino, $nuevoCamino]);
                        $visitados[] = $nombreVecino;
                    }
                    
                }
                
                if (!empty($plantasCoincidentes)) {
                    // Si se encontraron plantas coincidentes, enviarlas al frontend
                    http_response_code(200);
                    return json_encode($plantasCoincidentes);
                } else{
                    // Si no se encontró ninguna planta que coincida
                    http_response_code(404);
                    return 'La planta no existe';
                }
            }else{
                http_response_code(400);
                return 'Datos Invalidos';
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo 'Error '.$e->getMessage() ;
        }
    }
    // Método para obtener una planta de la lista de todas las plantas por su nombre
    private function obtenerPlantaPorNombre($plantas,$nombrePlanta) {
        foreach ($plantas as $planta) {
            if ($planta['nombre'] === $nombrePlanta) {
                return $planta;
            }
        }
        return null; // Si no se encuentra la planta
    }

    public function agregarPlanta($nombre,$habitat,$inflorescencia, $filogenia, $reproduccion){
        try {
            if($this->validar($habitat,$inflorescencia, $filogenia, $reproduccion) and preg_match_all('/^[0-9A-Za-záéíóúÁÉÍÓÚñÑ ]{1,30}$/',$nombre)){
                
                if($this->existe($nombre,$habitat,$inflorescencia, $filogenia, $reproduccion)){

                    $bd = $this->conexion();
                    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                    $idCaracteristicas = $this->idCaracteristicas($habitat,$inflorescencia, $filogenia, $reproduccion);
    
                    $sql = 'INSERT INTO plantas (id_habitat, id_reproduccion, id_filogenia, id_inflorescencia, nombre) VALUES (?, ?, ?, ?, ?)';
        
                    $stmt = $bd->prepare($sql);
                    
                    $stmt->execute(array(
                        $idCaracteristicas['habitat'],
                        $idCaracteristicas['reproduccion'],
                        $idCaracteristicas['filogenia'],
                        $idCaracteristicas['inflorescencia'],
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
        } catch (PDOException $e) {
            http_response_code(500);
            echo 'Error '.$e->getMessage() ;
        }
    }

    public function consultaPlantas(){
        try {
            $bd = $this->conexion();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT plantas.nombre as nombre, habitats.habitat as habitat,inflorescencia.tipo as inflorescencia,filogenia.tipo as filogenia,reproduccion.descripcion as reproduccion FROM plantas, reproduccion, filogenia, habitats, inflorescencia WHERE plantas.id_habitat = habitats.id AND plantas.id_inflorescencia = inflorescencia.id AND plantas.id_filogenia = filogenia.id AND plantas.id_reproduccion = reproduccion.id --';

            $stmt = $bd->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        }catch (PDOException $e) {
            http_response_code(500);
            return null;
        }
    }

    private function idCaracteristicas($habitat,$inflorescencia, $filogenia, $reproduccion){
        try {
            if($this->validar($habitat,$inflorescencia, $filogenia, $reproduccion)){
                
                $bd = $this->conexion();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT habitats.id as 'habitat', reproduccion.id as 'reproduccion', filogenia.id as 'filogenia', inflorescencia.id as 'inflorescencia' FROM  reproduccion, filogenia, habitats, inflorescencia 
                WHERE habitats.habitat = ? 
                AND inflorescencia.tipo = ? 
                AND filogenia.tipo = ?
                AND reproduccion.descripcion = ?";
    
                $stmt = $bd->prepare($sql);
                
                $stmt->execute(array($habitat,$inflorescencia, $filogenia, $reproduccion));

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                http_response_code(200);
                return $resultado;
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return false;
        }
    }

    private function validar($habitat,$inflorescencia, $filogenia, $reproduccion) {

        //VALORES PERMITIDOS    
        $valoresHabitat = array("Agua Dulce", "Agua Salada","Desierto","Tundra","Selva","Sabana","Bosque","Pradera","Pantano");
        $valoresInflorescencia = array("Flotante", "Sumergida","Espiciforme","Racemosa","Cimosa","Capituliforme");
        $valoresFilogenia = array("Angiospermas", "Gimnospermas");
        $valoresReproduccion = array("Semilla", "Division","Esquejes","Polen","Fecundacion","Estolones","Bulbos");

        
        if (!in_array($habitat, $valoresHabitat)) {
            return false; // Si algún valor no está en el arreglo de valores válidos, retornar false
        }
        if (!in_array($inflorescencia, $valoresInflorescencia)) {
            return false; // Si algún valor no está en el arreglo de valores válidos, retornar false
        }
        if (!in_array($filogenia, $valoresFilogenia)) {
            return false; // Si algún valor no está en el arreglo de valores válidos, retornar false
        }
        if (!in_array($reproduccion, $valoresReproduccion)) {
            return false; // Si algún valor no está en el arreglo de valores válidos, retornar false
        }
        
        return true; // Si todos los valores están en el arreglo de valores válidos, retornar true
    }

    private function existe($nombre,$habitat,$inflorescencia, $filogenia, $reproduccion){
        try {
            if($this->validar($habitat,$inflorescencia, $filogenia, $reproduccion)){
                
                $bd = $this->conexion();
                $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT COUNT(*) FROM plantas, reproduccion, filogenia, habitats, inflorescencia 
                WHERE plantas.nombre = ?
                AND habitats.habitat = ? 
                AND inflorescencia.tipo = ? 
                AND filogenia.tipo = ?
                AND reproduccion.descripcion = ?";
    
                $stmt = $bd->prepare($sql);
                
                $stmt->execute(array($nombre,$habitat,$inflorescencia, $filogenia, $reproduccion));

                $resultado = $stmt->fetchColumn();

                return ($resultado > 0) ? false : true;
            }
        } catch (PDOException $e) {
            http_response_code(500);
            return 'ERROR: '.$e->getMessage();
        }
    }

}