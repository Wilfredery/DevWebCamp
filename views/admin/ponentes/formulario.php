<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion personal</legend>

    <div class="formulario__campo">

        <label for="nombre" class="formulario__label">Nombre</label>

        <input type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Nombre del ponente"
        value="<?php echo $ponente->nombre ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">

    <label for="apellido" class="formulario__label">Apellido</label>

        <input type="text"
        class="formulario__input"
        id="apellido"
        name="apellido"
        placeholder="apellido del ponente"
        value="<?php echo $ponente->apellido ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">

    <label for="ciudad" class="formulario__label">Ciudad</label>

        <input type="text"
        class="formulario__input"
        id="ciudad"
        name="ciudad"
        placeholder="ciudad del ponente"
        value="<?php echo $ponente->ciudad ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">

    <label for="pais" class="formulario__label">Pais</label>

        <input type="text"
        class="formulario__input"
        id="pais"
        name="pais"
        placeholder="pais del ponente"
        value="<?php echo $ponente->pais ?? ''; ?>"
        >
    </div>

    <div class="formulario__campo">

<label for="imagen" class="formulario__label">Imagen</label>

    <input type="file"
    class="formulario__input formulario__input--file"
    id="imagen"
    name="imagen"
    >
</div>
</fieldset>

<fieldset class="formulario__fieldset">

    <legend for="tags_input" class="formulario__legend">informacion extra (separadas por comas)</legend>

    <div class="formulario__campo">

        <label for="pais" class="formulario__label">Areas de experiencias</label>

        <input type="text"
        class="formulario__input"
        id="tags_input"
        placeholder="Ej Node.js, php, css, laravel, UX/UI"
        >
    </div>

    <div id="tags" class="formulario__listado">

        <input type="hidden" 
        name="tags"  
        value="<?php echo $ponente->tags ?? ''; ?>">
    </div>

</fieldset>

<fieldset class="formulario__fieldset">

    <legend for="tags_input" class="formulario__legend">Redes sociales</legend>

    <div class="formulario__campo">

        <div class="formulario__contenedor-icono">

            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>

            <input type="text"
            class="formulario__input--sociales"
            placeholder="Facebook"
            name="redes[facebook]"
            value="<?php echo $ponente->facebook ?? ''; ?>"
            >
            </div>

    </div>

    <div class="formulario__campo">

    <div class="formulario__contenedor-icono">

        <div class="formulario__icono">
            <i class="fa-brands fa-x"></i>
        </div>

        <input type="text"
        class="formulario__input--sociales"
        placeholder="x"
        name="redes[x]"
        value="<?php echo $ponente->x ?? ''; ?>"
        >
        </div>

    </div>

    <div class="formulario__campo">

    <div class="formulario__contenedor-icono">

        <div class="formulario__icono">
            <i class="fa-brands fa-youtube"></i>
        </div>

        <input type="text"
        class="formulario__input--sociales"
        placeholder="Youtube"
        name="redes[youtube]"
        value="<?php echo $ponente->youtube ?? ''; ?>"
        >
        </div>

    </div>

    <div class="formulario__campo">

    <div class="formulario__contenedor-icono">

        <div class="formulario__icono">
            <i class="fa-brands fa-instagram"></i>
        </div>

        <input type="text"
        class="formulario__input--sociales"
        placeholder="IG"
        name="redes[instagram]"
        value="<?php echo $ponente->instagram ?? ''; ?>"
        >
        </div>

    </div>
    
    <div class="formulario__campo">

    <div class="formulario__contenedor-icono">

        <div class="formulario__icono">
            <i class="fa-brands fa-tiktok"></i>
        </div>

        <input type="text"
        class="formulario__input--sociales"
        placeholder="Tiktok"
        name="redes[tiktok]"
        value="<?php echo $ponente->tiktok ?? ''; ?>"
        >
        </div>

    </div>

    <div class="formulario__campo">

    <div class="formulario__contenedor-icono">

        <div class="formulario__icono">
            <i class="fa-brands fa-github"></i>
        </div>

        <input type="text"
        class="formulario__input--sociales"
        placeholder="Github"
        name="redes[github]"
        value="<?php echo $ponente->github ?? ''; ?>"
        >
        </div>

    </div>
</fieldset>