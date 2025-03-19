<?php

namespace App\Command;

use App\Domain\Service\SearchService;

/**
 * Comando para búsqueda de recursos
 */
class SearchCommand
{
    /**
     * Servicio de búsqueda
     * 
     * @var SearchService
     */
    private SearchService $searchService;
    
    /**
     * Constructor del comando
     * 
     * @param SearchService $searchService Servicio de búsqueda
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }
    
    /**
     * Ejecuta el comando de búsqueda
     * 
     * @param string $searchTerm Término de búsqueda
     * @return void
     */
    public function execute(string $searchTerm): void
    {
        try {
            $results = $this->searchService->search($searchTerm);
            
            if (empty($results)) {
                echo "No se encontraron resultados para: \"$searchTerm\"" . PHP_EOL;
                return;
            }
            
            foreach ($results as $result) {
                echo $result->toString() . PHP_EOL;
            }
        } catch (\InvalidArgumentException $e) {
            echo "Error: " . $e->getMessage() . PHP_EOL;
        } catch (\Exception $e) {
            echo "Error inesperado: " . $e->getMessage() . PHP_EOL;
        }
    }
}