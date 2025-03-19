# Aplicación de búsqueda de cursos y exámenes

Esta aplicación de consola permite buscar clases y exámenes en una base de datos de cursos online de idiomas. La búsqueda se realiza utilizando al menos las tres primeras letras del nombre del recurso.

## Características

- Búsqueda de clases y exámenes por nombre
- Diferenciación entre tipos de recursos (clases y exámenes)
- Muestra ponderación de las clases (de 0 a 5)
- Muestra tipo de examen (selección, pregunta y respuesta, completación)

## Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Composer

## Instalación

1. Clonar el repositorio
2. Instalar dependencias:
   ```
   composer install
   ```
3. Configurar la base de datos:
   - Crear una base de datos MySQL
   - Configurar los parámetros de conexión en `config/database.php`
   - Ejecutar los scripts SQL en la carpeta `resources/`
4. Dar permisos de ejecución al script de consola:
   ```
   chmod +x bin/console
   ```

## Uso

```
php bin/console search <término de búsqueda>
```

Ejemplo:
```
php bin/console search trabajo
```

Salida:
```
Clase: Vocabulario sobre Trabajo en Inglés | 5.0/5
Clase: Conversaciones de Trabajo en Inglés | 5.0/5
Examen: Trabajos y ocupaciones en Inglés | Selección
```

## Estructura del proyecto

La aplicación sigue una arquitectura de capas inspirada en Domain-Driven Design:

- `/bin`: Archivos ejecutables
- `/config`: Archivos de configuración
- `/src`: Código fuente de la aplicación
  - `/Command`: Comandos de la aplicación (interfaz de usuario)
  - `/Domain`: Lógica de negocio
    - `/Model`: Entidades y objetos de valor
    - `/Repository`: Interfaces para acceso a datos
    - `/Service`: Servicios de dominio
  - `/Infrastructure`: Implementaciones técnicas
    - `/Database`: Conexión a la base de datos
    - `/Repository`: Implementaciones concretas de repositorios
- `/tests`: Pruebas unitarias
- `/resources`: Archivos de recursos (SQL, etc.)

## Arquitectura

La aplicación utiliza una arquitectura en capas con los siguientes patrones:
- **Patrón Repository**: Abstrae el acceso a datos
- **Patrón Command**: Encapsula las solicitudes como objetos
- **Patrón Service**: Centraliza la lógica de negocio
- **Patrón Singleton**: Para la conexión a la base de datos

## Estándares utilizados

- PSR-4 para autoloading
- PSR-1 y PSR-2 para el estilo de código
- PHPDoc para la documentación del código

## Pruebas

Para ejecutar las pruebas unitarias:
```
composer test
```