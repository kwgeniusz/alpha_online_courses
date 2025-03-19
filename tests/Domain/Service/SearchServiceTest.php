<?php

namespace Tests\Domain\Service;

use App\Domain\Service\SearchService;
use App\Domain\Repository\ResourceRepositoryInterface;
use App\Domain\Model\Course;
use App\Domain\Model\Exam;
use PHPUnit\Framework\TestCase;

class SearchServiceTest extends TestCase
{
    /**
     * Prueba la funcionalidad de búsqueda con un término válido
     */
    public function testSearchWithValidTerm()
    {
        // Crear mock de repositorio
        $mockRepository = $this->createMock(ResourceRepositoryInterface::class);
        $mockRepository->expects($this->once())
            ->method('searchByName')
            ->with('tra')
            ->willReturn([
                new Course(1, 'Vocabulario sobre Trabajo en Inglés', 5.0),
                new Exam(2, 'Trabajos y ocupaciones en Inglés', 'selección')
            ]);
        
        // Crear instancia de servicio de búsqueda
        $searchService = new SearchService($mockRepository);
        
        // Ejecutar búsqueda
        $results = $searchService->search('tra');
        
        // Verificar resultados
        $this->assertCount(2, $results);
        $this->assertInstanceOf(Course::class, $results[0]);
        $this->assertInstanceOf(Exam::class, $results[1]);
    }
    
    /**
     * Prueba la validación de longitud mínima del término de búsqueda
     */
    public function testSearchWithInvalidTerm()
    {
        // Crear mock de repositorio
        $mockRepository = $this->createMock(ResourceRepositoryInterface::class);
        
        // Crear instancia de servicio de búsqueda
        $searchService = new SearchService($mockRepository);
        
        // Esperar excepción
        $this->expectException(\InvalidArgumentException::class);
        
        // Ejecutar búsqueda con término inválido
        $searchService->search('ab');
    }
}