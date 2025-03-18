#!/usr/bin/env php
<?php

// Autoload classes
require __DIR__ . '/../vendor/autoload.php';

use App\Command\SearchCommand;
use App\Infrastructure\Database\DatabaseConnection;
use App\Infrastructure\Repository\CourseRepository;
use App\Infrastructure\Repository\ExamRepository;
use App\Domain\Service\SearchService;

// Validar argumentos de entrada
if ($argc < 3 || $argv[1] !== 'search') {
    echo "Uso: php bin/console search <término de búsqueda>" . PHP_EOL;
    exit(1);
}

// Obtener término de búsqueda
$searchTerm = $argv[2];

try {
    // Inicializar conexión a base de datos
    $connection = DatabaseConnection::getInstance();
    
    // Inicializar repositorios
    $courseRepository = new CourseRepository($connection);
    $examRepository = new ExamRepository($connection);
    
    // Inicializar servicio de búsqueda
    $searchService = new SearchService($courseRepository, $examRepository);
    
    // Inicializar y ejecutar comando de búsqueda
    $searchCommand = new SearchCommand($searchService);
    $searchCommand->execute($searchTerm);
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    exit(1);
}