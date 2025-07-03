(function() {

    let eventos = [];

    const eventosBoton = document.querySelectorAll('.evento__agregar');
    eventosBoton.forEach(boton => {
        boton.addEventListener('click', agregarEvento);
    });

    function agregarEvento(evento) {

        eventos = [...eventos, {
            id: evento.target.dataset.id,
            //Para tomar el titulo donde se esta dando click
            titulo: evento.target.parentElement.querySelector('.evento__nombre').textContent.trim()
        }]
        
        //Deshabilitar el evento para evitar la duplicacion de registros.
        console.log(eventos);
        evento.target.disabled = true;
        
    }
})();