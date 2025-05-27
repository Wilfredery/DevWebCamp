(function() {
    
    const horas = document.querySelector('#horas');
    
    if(horas) {

        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');


        categoria.addEventListener('change', terminoBusqueda);
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));

        let busqueda = {
            //sI QUIERES QUE EL VALOR QUE ESTA AL MACENADO EN CATEGORIA SE VEA COMO UN ENTERO COLOCALE UN + Y YA.
            categoria_id : +categoria.value || '',
            dia          : +inputHiddenDia.value || '',
        }

        //Si al menos uno de los dos campos de busqueda esta vacio, se detiene la ejecucion.
        if(!Object.values(busqueda).includes('')) {

            ( async () => {
                await buscarEventos();

                //Resaltar la hora actual
                const horaSeleccionada = document.querySelector(`[data-hora-id="${inputHiddenHora.value}"]`);

                horaSeleccionada.classList.remove('horas__hora--deshabilitada');
                horaSeleccionada.classList.add('horas__hora--seleccionada');

                horaSeleccionada.onclick - seleccionarHora;
            })();

        }


        function terminoBusqueda(e) {
            busqueda[e.target.name] = e.target.value;

            //Reiniciar los campos ocultos y el selector de horas.
            inputHiddenHora.value = '';
            inputHiddenDia.value = '';
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');

            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            //Si al menos uno de los dos campos de busqueda esta vacio, se detiene la ejecucion.
            if(Object.values(busqueda).includes('')) {
                return;
            }

            buscarEventos();
        }

        //Luego de que ambos objetos de busqueda esten completados correctamente.
        //Esta funcon sera un API por ende es importante que sea async
        async function buscarEventos() {

            const { categoria_id, dia } = busqueda;
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            //Se hace la peticion(la variable de la url) a la API
            const respuesta = await fetch(url);
            const eventos = await respuesta.json();

            obtenerHorasDisponibles(eventos);
            
        }

        function obtenerHorasDisponibles(eventos) {
            //Reiniciar las horas
            const listadoHoras = document.querySelectorAll('#horas li'); 
            listadoHoras.forEach(li => {
                li.classList.add('horas__hora--deshabilitada');
            });

            //Comprobar eventos ya tomados y quitar la variable de deshabilitado.
            const horasTomadas = eventos.map(evento => evento.hora_id);
            
            const listadoHorasArray = Array.from(listadoHoras);

            //El signo de exclamacion fue utilizado para que en vez de traer lo mencionado que traiga los no mencionados o tomados.
            const resultado = listadoHorasArray.filter(li => !horasTomadas.includes(li.dataset.horaId))
            
            //Eliminando la clase de horas deshabilitada.
            resultado.forEach(li => {
                li.classList.remove('horas__hora--deshabilitada');
            });

            //En esta parte el not deja dichoq ue le traiga todo excepto la dicha clase.
            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');
            horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora));
        }

        function seleccionarHora(e) {

            //Si se selecciona multiples horas, que se guarde unicamente la ultima que se selecciono.
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');

            if(horaPrevia) {
                horaPrevia.classList.remove('horas__hora--seleccionada');
            }

            //Agregar clase de seleccionado
            e.target.classList.add('horas__hora--seleccionada');

            inputHiddenHora.value = e.target.dataset.horaId;

            //Llenar el campo oculto de dia.
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }
    }

})();