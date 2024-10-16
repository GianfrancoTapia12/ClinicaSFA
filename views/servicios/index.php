<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Especialidades médicas:</p>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
?>

<ul class="list-group">
    <?php foreach($servicios as $servicio){ ?>
        <li class="list-group-item">
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Medico: <span><?php echo $servicio->medico; ?></span></p>
            <p>Consultorio: <span><?php echo $servicio->consultorio; ?></span></p>
            <p>Precio: <span><?php echo $servicio->precio; ?></span></p>

            <div class="d-flex justify-content-between">
                <a class="btn btn-primary" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>

                <form action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" value="Borrar" class="btn btn-danger"> 
                </form>
            </div>
        </li>
    <?php }?>    
</ul>