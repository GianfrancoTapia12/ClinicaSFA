<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llenar el siguiente formulario para crear una cuenta</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form class="formulario" method="POST" action="crear-cuenta">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Tu nombre"
            value="<?php echo s($usuario->nombre); ?>"

        />
    </div>
    <div class="campo">
        <label for="apellidos">Apellidos</label>
        <input 
            type="text"
            id="apellidos"
            name="apellidos"
            placeholder="Tus Apellidos"
            value="<?php echo s($usuario->apellidos); ?>"
            
        />
    </div>
    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="Tu Telefono"
            value="<?php echo s($usuario->telefono); ?>"
            
        />
    </div>
    <div class="campo">
        <label for="dni">DNI</label>
        <input 
            type="text"
            id="dni"
            name="dni"
            placeholder="Tu Dni"
            value="<?php echo s($usuario->dni); ?>"
            
        />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            name="email"
            placeholder="Tu E-mail"
            value="<?php echo s($usuario->email); ?>"
            
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Tu Password"
            
        />
    </div>

    <input type="submit" value="Crear cuenta" class="boton">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
    <a href="/olvide">¿Olvidastes tu password?</a>  
</div>