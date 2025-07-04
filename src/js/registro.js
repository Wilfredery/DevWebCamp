import Swal from "sweetalert2";

(function() {

    let eventos = [];
    const resumen = document.querySelector('#registro-resumen');
    const eventosBoton = document.querySelectorAll('.evento__agregar');

    eventosBoton.forEach(boton => {
        boton.addEventListener('click', seleccionarEvento);
    });

    function seleccionarEvento(evento) {

        if(eventos.length < 5) {
            eventos = [...eventos, {
                id: evento.target.dataset.id,
                //Para tomar el titulo donde se esta dando click
                titulo: evento.target.parentElement.querySelector('.evento__nombre').textContent.trim()
            }];

            //Deshabilitar el evento para evitar la duplicacion de registros.
            console.log(eventos);
            evento.target.disabled = true;
            
            mostrarEventos();

        } else {
            Swal.fire({
                title: 'Límite alcanzado',
                text: 'Solo se puede un máximo de 5 eventos en el "Tu registro"',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
        }

    }

    function mostrarEventos() {

        limpiarEventos();
        if(eventos.length > 0) {
            eventos.forEach(evento => {
                const eventoDOM = document.createElement('DIV');
                eventoDOM.classList.add('registro__evento');

                const titulo = document.createElement('H3');
                titulo.classList.add('registro__nombre');
                titulo.textContent = evento.titulo;

                //Agregar boton para eliminar el evento
                const botonEliminar = document.createElement('BUTTON');
                botonEliminar.classList.add('registro__eliminar');
                botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                botonEliminar.onclick = function() {
                    eliminarEvento(evento.id);
                }

                //renderizar en el html
                eventoDOM.appendChild(titulo);
                resumen.appendChild(eventoDOM);
                eventoDOM.appendChild(botonEliminar);
            });
        }
    }

    function eliminarEvento(id) {
        eventos = eventos.filter(evento => evento.id !== id);
        //Al eliminar de TU REGISTRo que se vuelva a visualizar para volver agregar si es necesario nuevamenete a tu registro.
        const botonAgregar = document.querySelector(`[data-id="${id}"]`);
        botonAgregar.disabled = false; //Agregar a su estado para volver a presionar el boton de agregar.
        mostrarEventos();
    }

    function limpiarEventos() {
        while(resumen.firstChild) {
            resumen.removeChild(resumen.firstChild);

        }
    }
})();