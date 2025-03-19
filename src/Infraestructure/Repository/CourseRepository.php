<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Course;
use App\Domain\Repository\ResourceRepositoryInterface;
use PDO;

/**
 * Repositorio para la entidad Course
 */
class CourseRepository implements ResourceRepositoryInterface
{
    /**
     * Conexión a la base de datos
     * 
     * @var PDO
     */
    private PDO $connection;
    
    /**
     * Constructor de la clase
     * 
     * @param PDO $connection Conexión a la base de datos
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    
    /**
     * Busca clases por nombre (mínimo 3 letras)
     * 
     * @param string $searchTerm Término de búsqueda
     * @return array Arreglo de clases encontradas
     */
    public function searchByName(string $searchTerm): array
    {
        $stmt = $this->connection->prepare(
            'SELECT id, name, rating FROM courses 
             WHERE name LIKE :searchTerm 
             ORDER BY name ASC'
        );
        
        $stmt->execute([
            'searchTerm' => "%$searchTerm%"
        ]);
        
        $courses = [];
        while ($row = $stmt->fetch()) {
            $courses[] = new Course(
                (int)$row['id'],
                $row['name'],
                (float)$row['rating']
            );
        }
        
        return $courses;
    }
}