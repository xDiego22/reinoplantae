<?php
namespace model;
use config\connect\connectDB as connectDB;
use SplQueue;
use PDO;
use Exception;

class inicioModel extends connectDB{
    
    public function buscarPlanta($habitat,$inflorescencia, $filogenia, $reproduccion) {


        try {
            $bd = $this->conexion();
            $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //plantas traidas de la base de datos
            $plantas = $this->consultaPlantas();

            $caracteristicasBusqueda = [
                "habitat" => $habitat,
                "inflorescencia" => $inflorescencia,
                "filogenia" => $filogenia,
                "reproduccion" => $reproduccion
            ];

            $cola = new SplQueue(); // Crear una nueva cola
            $visitados = []; // Array para rastrear nodos visitados

            foreach ($plantas as $planta) {
                $cola->enqueue([$planta['nombre'], []]); // El segundo elemento del array es el camino hasta este nodo
            }
        
            while (!$cola->isEmpty()) {
                list($nombrePlanta, $camino) = $cola->dequeue();
                $planta = $this->obtenerPlantaPorNombre($plantas,$nombrePlanta);
                
                // Verificar si la planta coincide con las características de búsqueda
                $coincide = true;
                foreach ($caracteristicasBusqueda as $caracteristica => $valor) {
                    // Verificar si la característica está presente y coincide con el valor deseado
                    if (!isset($planta[$caracteristica]) || $planta[$caracteristica] !== $valor) {
                        $coincide = false;
                        break;
                    }
                }
                
                if ($coincide) {
                    // Si encontramos una planta que coincide, devolvemos el nombre de la planta

                    http_response_code(200);
                    return $nombrePlanta;
                }
                
                // Si no coincide, agregamos los nodos vecinos (en este caso, todas las plantas) a la cola
                foreach ($plantas as $planta) {
                    $nombreVecino = $planta['nombre'];
                    if (!in_array($nombreVecino, $visitados)) {
                        $nuevoCamino = $camino;
                        $nuevoCamino[] = $nombreVecino;
                        $cola->enqueue([$nombreVecino, $nuevoCamino]);
                        $visitados[] = $nombreVecino;
                    }
                }
            }
            
            // Si no se encontró ninguna planta que coincida
            http_response_code(400);

            return 'La planta no existe';
        } catch (PDOException $e) {
            http_response_code(500);
            echo 'Error '.$e->getMessage() ;
        }
    }
    // Método para obtener una planta por su nombre
    private function obtenerPlantaPorNombre($plantas,$nombrePlanta) {
        foreach ($plantas as $planta) {
            if ($planta['nombre'] === $nombrePlanta) {
                return $planta;
            }
        }
        return null; // Si no se encuentra la planta
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

}