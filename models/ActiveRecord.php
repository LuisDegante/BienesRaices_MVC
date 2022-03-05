<?php

namespace Model;

class ActiveRecord {

    //Base de Datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];

    //Definiendo conexión a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }

    public function crear() {
        // echo "Guardando en la Base de Datos";

        //Sanitizando los datos
        $atributos = $this->sanitizarAtributos();
        //vardumpFormateado($atributos);

        //Insertar en la Base de Datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        // vardumpFormateado($query);

        $resultado = self::$db->query($query);
        // vardumpFormateado($resultado);
        return $resultado;
    }

    public function actualizar() {
        // vardumpFormateado('Actualizando');
        //Sanitizando los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        // vardumpFormateado(join(', ',$valores));
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ',$valores);
        $query .=  " WHERE id= '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";
        // vardumpFormateado($query);

        $resultado = self::$db->query($query);
        
        return $resultado;
    }

    //Eliminar un registro
    public function eliminar() {
        // vardumpFormateado("Eliminando la " . $this->id);
        //ELIMINANDO LA PROPIEDAD
        $query = "DELETE FROM " . static::$tabla . " WHERE id= '" . self::$db->escape_string($this->id) . "' LIMIT 1";
        // vardumpFormateado($query);
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?delete=1');
        }
    }

    //Identificar y unir los atributos de la Base de Datos
    public function atributos() {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if($columna === 'id') continue;            
            $atributos[$columna] = $this->$columna;
        }
        // vardumpFormateado($atributos);
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        // vardumpFormateado($sanitizado);
        return $sanitizado;
    }

    //Validando que los campos no estén vacíos
    public static function getErrores() {
        return static::$errores;
    }

    //Subida de archivos de imagen al servidor
    public function setImagen($imagen) {
        // vardumpFormateado($this->imagen);
        //Eliminar la imagen anterior 
        if($this->id) {
            $this->borrarImagen();
        }
        if($imagen) {
            //Asignar al atrubito de imagen el nombre de la imagen
            $this->imagen = $imagen;
        }
    }

    //Eliminando archivos del servidor
    public function borrarImagen() {
        // vardumpFormateado("Elimimando imagen");
        //Comprobar si el archivo existe
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        // vardumpFormateado($existeArchivo);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    //Listar todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        // vardumpFormateado($query);
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Listar un número específico de registros
    public static function getEspecifico($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        // vardumpFormateado($query);
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Busca un registro por su ID
    public static function find($id) {
        // vardumpFormateado($id);
        //Consulta para obtener los datos de la propiedad
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        // vardumpFormateado($resultado);
        return array_shift($resultado);
    }


    public static function consultarSQL($query) {
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // vardumpFormateado($array);

        // Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;

    }

    protected static function crearObjeto($registro) {
        $objeto = new static;
        // vardumpFormateado($objeto);

        foreach ($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        // vardumpFormateado($objeto);
        return $objeto;
    }

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        // vardumpFormateado($args);
        foreach($args as $key => $value) {
            if(property_exists($this,$key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}