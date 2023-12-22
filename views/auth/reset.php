<h1 class="nombre-pagina">Reestablecer Password</h1>
<p class="descripcion-pagina">Por Favor coloca tu nuevo Password</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<?php
if($error) return;
?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Tu Nuevo Password"        
            autocomplete="off"
        />
    </div>
    <input type="submit" class="boton" value="Guardar Nuevo Password">

</form>

<div class="acciones">
    <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/signup">¿Aún no tienes cuenta? Crear una</a>
</div>