<?php

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id','nombre','apellido','telefono','email'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El Nombre es Obligatorio";
        }

        if(!$this->apellido) {
            self::$errores[] = "El o Los Apellidos son Obligatorios";
        }

        if(!$this->email && !$this->telefono) {
            self::$errores[] = "Es Necesario tener al menos 1 Medio de Contacto";
        } elseif ($this->telefono && !$this->email) {
            if(!preg_match('/[0-9]{10}/',$this->telefono)) { //Expresión regular para telefono valido
                self::$errores[] = "Formato de Teléfono No Válido";
            } else {
                $this->email = null;
            }
        } elseif ($this->email && !$this->telefono) {
            //Expresion regular para email válido
            if(!preg_match('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',$this->email)) {   
                self::$errores[] = "Formato de Correo Electrónico No Válido";
            } else {
                $this->telefono = null;
            }
        } elseif ($this->email && $this->telefono) {
            if(!preg_match('/[0-9]{10}/',$this->telefono)) { //Expresión regular para telefono valido
                self::$errores[] = "Formato de Teléfono No Válido";
            }
            if(!preg_match('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^',$this->email)) {   
                self::$errores[] = "Formato de Correo Electrónico No Válido";
            }
        }

        return self::$errores;
    }
}