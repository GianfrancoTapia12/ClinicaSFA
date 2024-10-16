<?php

namespace Model;

class Servicio extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'medico', 'consultorio', 'precio'];

    public $id;
    public $nombre;
    public $medico;
    public $consultorio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->medico = $args['medico'] ?? null;
        $this->consultorio = $args['consultorio'] ?? null;
        $this->precio = $args['precio'] ?? null;
    }

    public function validar()
    {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del servicio es obligatorio';
        } 
        if(!$this->medico){
            self::$alertas['error'][] = 'El nombre del medico es obligatorio';
        } 
        if(!is_numeric($this->consultorio)){
            self::$alertas['error'][] = 'El numero de consultorio no es valido';
        } 
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = 'El precio no es valido';
        } 
        return self::$alertas;
    }
}