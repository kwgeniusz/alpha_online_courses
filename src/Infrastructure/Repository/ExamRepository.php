<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Exam;
use App\Domain\Repository\ResourceRepositoryInterface;
use PDO;

/**
 * Repositorio para la entidad Exam
 */
class ExamRepository implements ResourceRepositoryInterface
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
     * Busca exámenes por nombre (mínimo 3 letras)
     * 
     * @param string $searchTerm Término de búsqueda
     * @return array Arreglo de exámenes encontrados
     */
    public function searchByName(string $searchTerm): array
    {
        $stmt = $this->connection->prepare(
            'SELECT id, name, type FROM exams 
             WHERE name LIKE :searchTerm 
             ORDER BY name ASC'
        );
        
        $stmt->execute([
            'searchTerm' => "%$searchTerm%"
        ]);
        
        $exams = [];
        while ($row = $stmt->fetch()) {
            $exams[] = new Exam(
                (int)$row['id'],
                $row['name'],
                $row['type']
            );
        }
        
        return $exams;
    }
}