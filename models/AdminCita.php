<?php

namespace Model;

class AdminCita extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'hora', 'cliente', 'dni', 'email', 'telefono', 'servicio', 'precio'];

    public $id;
    public $hora;
    public $cliente;
    public $dni;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? null;
        $this->cliente = $args['cliente'] ?? null;
        $this->dni = $args['dni'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->telefono = $args['telefono'] ?? null;
        $this->servicio = $args['servicio'] ?? null;
        $this->precio = $args['precio'] ?? null;
    }
}