<main class="auth">

    <?php 

    require_once __DIR__ . '/../templates/alertas.php';

    ?>

    <?php  if($token_valido) { ?> 

        <h1 class="auth__heading"> <?php echo $titulo; ?> </h1>

        <p class="auth__texto"> Elegir tu nuevo password </p>

    <form method="POST" class="formulario">

        <div class="formulario__campo">
            <label for="password" class="formulario__label">Nuevo password</label>

            <input type="password"
            class="formulario__input"
            name="password"
            placeholder="Tu password"
            id="password"
            >
        </div>

        <input type="submit" 
        class="formulario__submit" 
        value="Enviar"
        >
    
    </form>

    <?php } ?>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar sesion</a>
        <a href="/olvide" class="acciones__enlace">Olvide mi password</a>
    </div>

</main>