<h1 class="nombre-pagina">Nuevo servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir una nueva especialidad</p>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/servicios/crear" method="post" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>

</form>