<h1 class="dashboard__heading"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/ponentes">
        <i class="fa-solid fa-circle-arrow-left"> Volver</i>
    </a>
</div>

<div class="dashboard__formulario">
    <?php 
    
    include_once __DIR__ . '/../../templates/alertas.php';
    
    ?>

    <fomr method="POST" action="/admin/ponentes/crear" class="formulario" enctype="multipart/form-data">

        <?php include_once __DIR__ . '/formulario.php';  ?>

        <input class="formulario__submit formulario__submit--registrar type="submit"
        value="Registrar ponente">
    </fomr>
</div>