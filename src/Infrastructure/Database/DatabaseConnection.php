<?php

namespace App\Infrastructure\Database;

use PDO;
use PDOException;

/**
 * Clase para manejar la conexión a la base de datos
 */
class DatabaseConnection
{
    /**
     * Instancia de la conexión PDO
     * 
     * @var PDO|null
     */
    private static ?PDO $instance = null;

    /**
     * Obtiene una instancia de conexión PDO (Singleton)
     * 
     * @return PDO Instancia de conexión a la base de datos
     * @throws PDOException Si ocurre un error en la conexión
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../../../config/database.php';
            
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['database'],
                $config['charset']
            );
            
            try {
                self::$instance = new PDO(
                    $dsn,
                    $config['username'],
                    $config['password'],
                    $config['options']
                );
            } catch (PDOException $e) {
                throw new PDOException('Error al conectar con la base de datos: ' . $e->getMessage());
            }
        }
        
        return self::$instance;
    }
    
    /**
     * Previene la creación de instancias de esta clase
     */
    private function __construct()
    {
    }
    
    /**
     * Previene la clonación de esta instancia
     */
    private function __clone()
    {
    }
}