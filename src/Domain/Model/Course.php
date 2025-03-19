<?php

namespace App\Domain\Model;

/**
 * Clase que representa una clase de idioma
 */
class Course extends Resource
{
    /**
     * Ponderación de la clase (de 0 a 5)
     * 
     * @var float
     */
    private float $rating;
    
    /**
     * Constructor de la clase
     * 
     * @param int $id Identificador único
     * @param string $name Nombre de la clase
     * @param float $rating Ponderación de la clase
     */
    public function __construct(int $id, string $name, float $rating)
    {
        parent::__construct($id, $name);
        $this->rating = $rating;
    }
    
    /**
     * Obtiene la ponderación de la clase
     * 
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }
    
    /**
     * Obtiene el tipo de recurso
     * 
     * @return string
     */
    public function getType(): string
    {
        return 'Clase';
    }
    
    /**
     * Obtiene la representación en formato string
     * 
     * @return string
     */
    public function toString(): string
    {
        return sprintf(
            '%s: %s | %.1f/5',
            $this->getType(),
            $this->getName(),
            $this->getRating()
        );
    }
}