
<main class="auth">


    <h1 class="auth__heading"> <?php echo $titulo; ?> </h1>

    <p class="auth__texto"> Registrate en DevWebCamp </p>

    <?php
        require_once __DIR__ . "/../templates/alertas.php";
    ?>

    <form method="POST" action="/registro" class="formulario">

        <div class="formulario__campo">
            <label for="nombre" class="formulario__label">Nombre</label>

            <input type="text"
            class="formulario__input"
            name="nombre"
            placeholder="Tu nombre"
            id="nombre"
            value="<?php echo s($usuario->nombre); ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="apellido" class="formulario__label">Apellido</label>

            <input type="text"
            class="formulario__input"
            name="apellido"
            placeholder="Tu apellido"
            id="apellido"
            value="<?php echo s($usuario->apellido); ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>

            <input type="email"
            class="formulario__input"
            name="email"
            placeholder="Tu email"
            id="email"
            value="<?php echo s($usuario->email); ?>"
            >
        </div>

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Password</label>

            <input type="password"
            class="formulario__input"
            name="password"
            placeholder="Tu password"
            id="password"
            >
        </div>

        <div class="formulario__campo">
            <label for="password2" class="formulario__label">Repetir password</label>

            <input type="password"
            class="formulario__input"
            name="password2"
            placeholder="Volver a colocar tu password"
            id="password2"
            >
        </div>

        <input type="submit" 
        class="formulario__submit" 
        value="Crear cuenta"
        >
    
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar sesion</a>
        <a href="/olvide" class="acciones__enlace">Olvide mi password</a>
    </div>

</main>