import Swal from "sweetalert2";

(function() {

    let eventos = [];
    const resumen = document.querySelector('#registro-resumen');
    if(resumen) { //Sino esta esto nos marcara undefined al momento de ir a otra pagina.
        
        const eventosBoton = document.querySelectorAll('.evento__agregar');

        const formularioRegistro = document.querySelector('#registro');
        formularioRegistro.addEventListener('submit', submitFormulario);

        eventosBoton.forEach(boton => {
            boton.addEventListener('click', seleccionarEvento);
        });

        mostrarEventos();

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

            } else {
                const noRegistro = document.createElement('P');
                noRegistro.textContent = 'No hay eventos, agrega hasta 5 del lado izquierdo.';
                noRegistro.classList.add('registro__texto');
                resumen.appendChild(noRegistro);
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

        async function submitFormulario(evento) {
            evento.preventDefault(); //Envio de datos a traves de fetchAPI

            //obtener el regalo
            const regaloId = document.querySelector('#regalo').value;

            //sacar los id de los eventos
            const eventosId = eventos.map(evento => evento.id);
            
            //Si es 0, el arreglo esta vacio, El || por si se cumple una u otra condicion
            if(eventosId.length === 0 || regaloId === '') {
                Swal.fire({
                    title: '¡POR FAVOR!',
                    text: 'Elegir al menos 1 evento y 1 regalo.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                return;
            }

            // OBJETO de formDATA
            const datos = new FormData();
            datos.append('eventos', eventosId);
            datos.append('regalo.id', regaloId);

            const url = '/finalizarRegistro/conferencias';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            })
            const resultado = await respuesta.json();
            console.log(resultado);
            if(resultado.resultado) {
                Swal.fire({
                    title: "Registro Exitoso!",
                    icon: "success",
                    draggable: true

                    //Desde que el usuario presione el boton que ejecute la vaina
                }).then( () => location.href = `/boleto?id=${resultado.token}` )

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Hubo un error!",

                    //Desde que el usuario presione el boton que ejecute la vaina
                    //Esto logrando que si tomamos un evento y llga a cero antes de nosotros tomarlo recargara la pagina.
                }).then( () => location.reload()); //Esto manda a recargar esta pagina
            }
        }
    }
})();