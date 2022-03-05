<?php

namespace Model;

class Blog extends ActiveRecord {
    protected static $tabla = 'blog';
    protected static $columnasDB = ['id','titulo','fecha_creacion','creador','texto_blog','imagen'];

    public $id;
    public $titulo;
    public $fecha_creacion;
    public $creador;
    public $texto_blog;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->fecha_creacion = $args['fecha_creacion'] ?? '';
        $this->creador = $args['creador'] ?? '';
        $this->texto_blog = $args['texto_blog'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = "El Título es Obligatorio";
        }

        if(!$this->fecha_creacion) {
            self::$errores[] = "La Fecha de Creación es Obligatoria";
        }

        if(!$this->creador) {
            self::$errores[] = "El Creador es Obligatorio, Ó colocar Anónimo";
        }

        if(!$this->texto_blog) {
            self::$errores[] = "Es necesario que haya texto del Blog";
        }

        if(!$this->imagen) {
            self::$errores[] = "La Imagen es Obligatoria";
        }

        return self::$errores;
    }
}