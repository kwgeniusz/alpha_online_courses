<?php

namespace App\Domain\Model;

/**
 * Clase abstracta que representa un recurso educativo
 */
abstract class Resource
{
    /**
     * Identificador único del recurso
     * 
     * @var int
     */
    protected int $id;
    
    /**
     * Nombre del recurso
     * 
     * @var string
     */
    protected string $name;
    
    /**
     * Constructor de la clase
     * 
     * @param int $id Identificador único
     * @param string $name Nombre del recurso
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
    
    /**
     * Obtiene el ID del recurso
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * Obtiene el nombre del recurso
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Método abstracto para obtener la representación en formato string
     * 
     * @return string
     */
    abstract public function toString(): string;
    
    /**
     * Método abstracto para obtener el tipo de recurso
     * 
     * @return string
     */
    abstract public function getType(): string;
}