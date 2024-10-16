

<div class="form-group">
    <label for="nombre">Nombre:</label>
    <input 
        type="text"
        id="nombre"
        class="form-control"
        placeholder="Nombre Servicio"
        name="nombre"
        value="<?php echo $servicio->nombre; ?>"
    />
</div>

<div class="form-group">
    <label for="medico">Medico:</label>
    <input 
        type="text"
        id="medico"
        class="form-control"
        placeholder="Nombre Medico"
        name="medico"
        value="<?php echo $servicio->medico; ?>"
    />
</div>

<div class="form-group">
    <label for="consultorio">Consultorio:</label>

    <input 
        type="number"
        id="consultorio"
        class="form-control"
        placeholder="Numero de consultorio"
        name="consultorio"
        value="<?php echo $servicio->consultorio; ?>"
    />
</div>

<div class="form-group">
    <label for="precio">Precio:</label>
    <input 
        type="number"
        id="precio"
        class="form-control"
        placeholder="Precio"
        name="precio"
        value="<?php echo $servicio->precio; ?>"
    />
</div>

<input type="submit" class="btn btn-primary" value="Guardar Servicio">