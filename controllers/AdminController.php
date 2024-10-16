<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        //session_start();

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);


        if (!checkdate($fechas[1], $fecha[2], $fecha[0])) {
            header('Location: /404');
        }



        //Consultar la base de datos
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellidos) as cliente, ";
        $consulta .=  " usuarios.dni, usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '${fecha}' ";

        $citas = AdminCita::SQL($consulta);
        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha


        ], 'layoutAdmin'); // Indicamos que se use el layout administrativo

    }

    public static function dashboard(Router $router)
    {
                // Asegurarse de que el usuario esté autenticado
                isAdmin(); // Esta función ya debería estar validando la sesión.

                // Obtener el nombre del administrador desde la sesión
                $nombre = $_SESSION['nombre'] ?? 'Administrador'; // Aquí usamos el valor de la sesión
        
                // Datos ficticios para el dashboard
                $totalCitas = 120;
                $totalIngresos = 3400;
                $servicioPopular = "Consulta General";
                $citasHoy = 5;
        
                // Renderizar la vista del dashboard
                $router->render('admin/dashboard', [
                    'nombre' => $nombre,
                    'totalCitas' => $totalCitas,
                    'totalIngresos' => $totalIngresos,
                    'servicioPopular' => $servicioPopular,
                    'citasHoy' => $citasHoy
                ], 'layoutAdmin'); // Usando el layout admin
    }
}
