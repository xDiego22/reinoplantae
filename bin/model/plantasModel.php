<?php
namespace model;

use config\connect\connectDB as connectDB;
use PDO;
use Exception;

class plantasModel extends connectDB {
    
    public function obtenerPlantas() {
        try {
            $conexion = $this->conexion(); 
            $query = "SELECT 
            p.nombre AS nombre,
            h.habitat AS habitats,
            r.descripcion AS reproduccion,
            f.tipo AS filogenia,
            i.tipo AS inflorescencia
        FROM 
            plantas p
            LEFT JOIN habitats h ON p.id_habitat = h.id
            LEFT JOIN reproduccion r ON p.id_reproduccion = r.id
            LEFT JOIN filogenia f ON p.id_filogenia = f.id
            LEFT JOIN inflorescencia i ON p.id_inflorescencia = i.id;
        "; 
            $statement = $conexion->prepare($query);
            $statement->execute();
            $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $e) {
            echo "Error al obtener las plantas: " . $e->getMessage();
            return array(); 
        }
    }    
}
