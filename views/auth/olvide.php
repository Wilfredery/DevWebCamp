
<main class="auth">


    <h1 class="auth__heading"> <?php echo $titulo; ?> </h1>

    <p class="auth__texto"> Recupera tu acceso a DevWebCamp </p>

    <form action="" class="formulario">

        <div class="formulario__campo">
            <label for="email" class="formulario__label">Email</label>

            <input type="email"
            class="formulario__input"
            name="email"
            placeholder="Tu email"
            id="email"
            >
        </div>

        <input type="submit" 
        class="formulario__submit" 
        value="Enviar"
        >
    
    </form>

    <div class="acciones">
        <a href="/login" class="acciones__enlace">Iniciar sesion</a>
        <a href="/olvide" class="acciones__enlace">Olvide mi password</a>
    </div>

</main>