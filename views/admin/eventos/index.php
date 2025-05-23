<h1 class="dashboard__heading"><?php echo $titulo; ?></h1>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"> Agregar evento</i>
    </a>
</div>

<div class="dashboard__contenedor">

    <?php  if(!empty($eventos)) { ?>
        <table class="tabla">

            <thead class="tabla__thead">
                <tr>
                    <th scope="col" class="tabla__th">Eventos</th>
                    <th scope="col" class="tabla__th">Tipo</th>
                    <th scope="col" class="tabla__th">Dia y hora</th>
                    <th scope="col" class="tabla__th">Ponente</th>
                    
                    <!-- //Boton eliminar o editar. -->
                    <th scope="col" class="tabla__th"></th> 
                </tr>

            </thead>

            <tbody class="tabla__tbody">

                <?php foreach($eventos as $evento) { ?>

                    <tr class="tabla__tr">
                        <td class="tabla__td">
                            <?php echo $evento->nombre;?>
                        </td>

                        <td class="tabla__td">
                            <?php echo $evento->categoria->nombre;?>
                        </td>

                        <td class="tabla__td">
                            <?php echo $evento->dia->nombre . ", " .$evento->hora->hora;?>
                        </td>

                        <td class="tabla__td">
                            <?php echo $evento->ponente->nombre .", " .$evento->ponente->apellido;?>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>


        </table>


    <?php } else { ?>
        <p class="text-center">No existe un eventosaun.</p>

    <?php } ?>

</div>

<?php 

        echo $paginacion;

?>