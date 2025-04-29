<main class="auth">

    <h1 class="auth__heading"> <?php echo $titulo; ?> </h1>

    <p class="auth__texto"> Tú cuenta de DevWebCamp </p>

    <?php 
    
    include_once __DIR__ . '/../templates/alertas.php';
    
    ?>

    <?php if(isset($alertas['exito'])) { ?>

    <div class="acciones--centrar">
        <a href="/login" class="acciones__enlace">Iniciar sesion </a>
    </div>

    <?php } ?>

</main>