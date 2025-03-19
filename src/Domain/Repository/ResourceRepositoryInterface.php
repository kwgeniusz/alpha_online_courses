<?php

namespace App\Domain\Repository;

/**
 * Interfaz para repositorios de recursos educativos
 */
interface ResourceRepositoryInterface
{
    /**
     * Busca recursos por nombre (mínimo 3 letras)
     * 
     * @param string $searchTerm Término de búsqueda
     * @return array Arreglo de recursos encontrados
     */
    public function searchByName(string $searchTerm): array;
}