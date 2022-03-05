<?php

namespace Model;

Class Admin extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','email','password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;
    }

    public function validar() {
        if (!$this->email) {
            self::$errores[] = 'El Correo Electrónico es Obligatorio';
        }

        if (!$this->password) {
            self::$errores[] = 'La Contraseña es Obligatoria';
        }

        return self::$errores;
    }

    public function existeUsuario() {
        //Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        // vardumpFormateado($query);
        $resultado = self::$db->query($query);
        // vardumpFormateado($resultado);

        if(!$resultado->num_rows) {
            self::$errores[] = 'El Usuario no Existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();
        // vardumpFormateado($usuario);

        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado) {
            self::$errores[] = 'La Contraseña es Incorrecta';
            return;
        }
        return $autenticado;
    }

    public function autenticarUsuario() {
        session_start();

        //Llenar el arreglo de sesión
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}