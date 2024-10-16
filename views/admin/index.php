<div class="container-fluid">

    <h2 class="text-primary">Panel de administracion</h2>
    <h4>Buscar citas:</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="fecha" class="mr-2">Fecha</label>
                    <input
                        type="date"
                        id="fecha"
                        name="fecha"
                        class="form-control"
                        value="<?php echo $fecha; ?>" />
                </div>
            </form>
        </div>
    </div>
    <!-- Mensaje si no hay citas  -->
    <?php if (count($citas) === 0): ?>
        <div class="alert alert-warning">
            <h4>No hay citas en esta fecha</h4>
        </div>
    <?php endif; ?>

    <!-- Listado de Citas -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <ul class="list-group">
                <?php
                $idCita = 0;
                foreach ($citas as $key => $cita) {

                    if ($idCita !== $cita->id) {
                        $total = 0;
                ?>
                        <li class="list-group-item">
                            <p><strong>ID:</strong> <span><?php echo $cita->id; ?></span></p>
                            <p><strong>Hora:</strong> <span><?php echo $cita->hora; ?></span></p>
                            <p><strong>Cliente:</strong> <span><?php echo $cita->cliente; ?></span></p>
                            <p><strong>DNI:</strong> <span><?php echo $cita->dni; ?></span></p>
                            <p><strong>Email:</strong> <span><?php echo $cita->email; ?></span></p>
                            <p><strong>Teléfono:</strong> <span><?php echo $cita->telefono; ?></span></p>

                            <h3>Servicios</h3>
                        <?php
                        $idCita = $cita->id;
                    } //Fin de if 
                    $total += $cita->precio;
                        ?>
                        <p class="mb-2"><?php echo $cita->servicio . " " . $cita->precio; ?></p>

                        <?php
                        $actual = $cita->id;
                        $proximo = $citas[$key + 1]->id ?? 0;

                        if (esUltimo($actual, $proximo)) { ?>
                            <p class="font-weight-bold">Total: <span>S/ <?php echo $total; ?></p>

                            <!-- Botón de eliminar -->
                            <form action="/api/eliminar" method="POST">
                                <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                                <input type="submit" class="btn btn-danger" value="Eliminar">
                            </form>
                        </li>
                <?php }
                    } //fIN DE FOREACH
                ?>
            </ul>
        </div>
    </div>
</div>

<?php
$script = "<script src='build/js/buscador.js'></script>";
echo $script;
?>