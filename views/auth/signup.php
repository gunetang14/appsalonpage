<h1 class="nombre-pagina">Crear una Cuenta</h1>
<p>Llena el siguiente formulario para crear una cuenta</p>

<?php
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" method="POST" action="/signup">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre"
            placeholder="Tu Nombre"
            value="<?php echo s($usuario->nombre);  ?>"
            autocomplete="off"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text" 
            name="apellido" 
            id="apellido"
            placeholder="Tu Apellido"
            value="<?php echo s($usuario->apellido);  ?>"
            autocomplete="off"
        />
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input 
            type="tel" 
            name="telefono" 
            id="telefono"
            placeholder="Tu Teléfono"
            value="<?php echo s($usuario->telefono);  ?>"
            autocomplete="off"
        />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email"
            placeholder="Tu Email"
            value="<?php echo s($usuario->email);  ?>"
            autocomplete="off"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password" 
            name="password" 
            id="password"
            placeholder="Tu Password"
            autocomplete="off"
        />
    </div>
    <input type="submit" value="Crear Cuenta" class="boton">

</form>

<div class="acciones">
    <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/forgot">¿Olvidaste tu Password?</a>
</div>