<?php

namespace Model;


/**
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string $telefono
 * @property string $dni
 * @property string $admin
 * @property string $confirmado
 * @property string $token
 * @property string $password
 */
class Usuario extends ActiveRecord{
    //BD
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellidos', 'email','telefono',
    'dni','admin','confirmado','token','password'];

    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $dni;
    public $admin;
    public $confirmado;
    public $token;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id']?? null;
        $this->nombre = $args['nombre']?? '';
        $this->apellidos = $args['apellidos']?? '';
        $this->email = $args['email']?? '';
        $this->telefono = $args['telefono']?? '';
        $this->dni = $args['dni']?? '';
        $this->admin = $args['admin']?? '0';
        $this->confirmado = $args['confirmado']?? '0';
        $this->token = $args['token']?? '';
        $this->password = $args['password']?? '';

    }

    //mensaje de validacion para crear una cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre es obligatorio';
        }
        if(!$this->apellidos){
            self::$alertas['error'][] = 'Los Apellidos son obligatorios';
        }
        if(!$this->telefono){
            self::$alertas['error'][] = 'El Telefono es obligatorio';
        }
        if(!$this->dni){
            self::$alertas['error'][] = 'El DNI es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
 
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'El password debe contener almenos 6 caracteres';
        }

        return self::$alertas;
    }

    public function validarLogin(){
        if( !$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if( !$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail(){
        if( !$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }
        if(strlen($this->password) < 6 ){
            self::$alertas['error'][] = 'El Password debe tener almenos 6 caracteres';
        }

        return self::$alertas;
    }

    //Revisa si el usuario ya existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$alertas['error'][] = 'El usuario ya esta registrado';
        }
        
        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password){

        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado){
            self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmado';
        }else{
            return true;
        }
    }

}