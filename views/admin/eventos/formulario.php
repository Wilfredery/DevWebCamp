<fieldset class="formulario__fieldset">
    
    <legend class="formulario__legend">Informacion del evento</legend>

    <div class="formulario__campo">

        <label for="nombre" class="formulario__label">Nombre del evento</label>

        <input type="text"
        class="formulario__input"
        id="nombre"
        name="nombre"
        placeholder="Nombre del evento"
        >
    </div>

    <div class="formulario__campo">

        <label for="descripcion" class="formulario__label">Descripcion del evento</label>

        <textarea
        class="formulario__textarea"
        id="descripcion"
        name="descripcion"
        placeholder="Descripcion del evento"
        rows="8"
        ></textarea>
    </div>

    <div class="formulario__campo">

        <label for="categoria" class="formulario__label">Categoria o tipo de evento</label>

        <select class="formulario__select" name="categoria_id" id="categoria">

            <option value="">-- Seleccionar ---</option>


            <?php foreach($categorias as $categoria) { ?>

                <option value="<?php echo $categoria->id; ?>"> <?php echo $categoria->nombre; ?></option>

            <?php } ?>

        </select>
    </div>

    <div class="formulario__campo">

        <label for="categoria" class="formulario__label">Seleccionar el dia</label>

        <div class="formulario__radio">

            <?php foreach($dias as $dia) { ?>

                <div>
                    <label for="<?php echo strtolower($dia->nombre); ?>"><?php echo $dia->nombre; ?></label>

                    <input type="radio"
                    id="<?php echo strtolower($dia->nombre); ?>"
                    name="dia"
                    value="<?php echo $dia->id; ?>"

                    />
                </div>

            <?php } ?>

        </div>

    </div>

    <div id="horas" class="formulario__campo">
        <form action="" class="formulario__label">Seleccionar hora</form>

        <ul class="horas">
            <?php foreach($horas as $hora) { ?>

                <li class="horas__hora"><?php echo $hora->hora; ?></li>

            <?php } ?>
        </ul>
    </div>

</fieldset>

<fieldset class="formulario__fieldset">

    <legend class="formulario__legend">Informacion extra</legend>

    <div class="formulario__campo">

        <label for="ponentes" class="formulario__label">Ponente</label>

        <input type="text"
        class="formulario__input"
        id="ponentes"
        placeholder="Buscar ponente"
        >
    </div>

    <div class="formulario__campo">

        <label for="disponibles" class="formulario__label">Lugares disponibles</label>

        <input type="number"
        min="1"
        class="formulario__input"
        id="disponibles"
        name="disponibles"
        placeholder="Ejemplo: 20"
        >
    </div>

</fieldset>