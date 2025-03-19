<?php

namespace App\Domain\Service;

use App\Domain\Repository\ResourceRepositoryInterface;

/**
 * Servicio para búsqueda de recursos
 */
class SearchService
{
    /**
     * Arreglo de repositorios de recursos
     * 
     * @var array
     */
    private array $repositories;
    
    /**
     * Constructor del servicio
     * 
     * @param ResourceRepositoryInterface ...$repositories Repositorios de recursos
     */
    public function __construct(ResourceRepositoryInterface ...$repositories)
    {
        $this->repositories = $repositories;
    }
    
    /**
     * Busca recursos por nombre (mínimo 3 letras)
     * 
     * @param string $searchTerm Término de búsqueda
     * @return array Arreglo de recursos encontrados
     * @throws \InvalidArgumentException Si el término de búsqueda es demasiado corto
     */
    public function search(string $searchTerm): array
    {
        if (strlen($searchTerm) < 3) {
            throw new \InvalidArgumentException(
                'El término de búsqueda debe tener al menos 3 caracteres'
            );
        }
        
        $results = [];
        foreach ($this->repositories as $repository) {
            $results = array_merge($results, $repository->searchByName($searchTerm));
        }
        
        return $results;
    }
}