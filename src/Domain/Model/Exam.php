<?php

namespace App\Domain\Model;

/**
 * Clase que representa un examen de idioma
 */
class Exam extends Resource
{
    /**
     * Tipo de examen
     * 
     * @var string
     */
    private string $examType;
    
    /**
     * Constructor de la clase
     * 
     * @param int $id Identificador único
     * @param string $name Nombre del examen
     * @param string $examType Tipo de examen
     */
    public function __construct(int $id, string $name, string $examType)
    {
        parent::__construct($id, $name);
        $this->examType = $examType;
    }
    
    /**
     * Obtiene el tipo de examen
     * 
     * @return string
     */
    public function getExamType(): string
    {
        return $this->examType;
    }
    
    /**
     * Obtiene el tipo de recurso
     * 
     * @return string
     */
    public function getType(): string
    {
        return 'Examen';
    }
    
    /**
     * Obtiene la representación en formato string
     * 
     * @return string
     */
    public function toString(): string
    {
        return sprintf(
            '%s: %s | %s',
            $this->getType(),
            $this->getName(),
            $this->getExamType()
        );
    }
}