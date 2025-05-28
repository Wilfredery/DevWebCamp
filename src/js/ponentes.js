(function() {

    const ponentesInputs = document.querySelector('#ponentes');

    if(ponentesInputs) {
        
        let ponentes = [];
        let ponentesFiltrados = []; 
        const listadoPonentes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('[name="ponente_id"]');

        obtenerPonentes();

        ponentesInputs.addEventListener('input', buscarPonentes);

        if(ponenteHidden.value) {

            (async() => {
                const ponente = await obtenerPonente(ponenteHidden.value);
                
                const { nombre, apellido } = ponente;


                //insertar en el html
                const ponenteDOM = document.createElement('LI');
                ponenteDOM.classList.add('listado-ponentes__ponente', 'listado-ponentes__ponente--seleccionado');
                ponenteDOM.textContent = `${nombre.trim()} ${apellido.trim()}`;

                listadoPonentes.appendChild(ponenteDOM);
            })();

        }

        async function obtenerPonentes() {
            const url = `/api/ponentes`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearPonentes(resultado);

        }

        async function obtenerPonente(id) {
            const url = `/api/ponente?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            return resultado;
        }

        //Creacion de una funcion para traer los componentes y sus elementos necesario, no es necesario que traiga toda la informacion. Simplemente se requiere el nombre y appelido.

        function formatearPonentes(arrayPonentes = []) {

            ponentes = arrayPonentes.map(ponente => {
                return {
                    id: ponente.id,
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    // Agregar otros campos necesarios
                }
            })
        }

        function buscarPonentes(e) {

            const busqueda = e.target.value;

            if(busqueda.length = 3) {
                //El i significa que no importa si es mayuscula o minuscula. Expresiones regulares.
                const expresion = new RegExp(busqueda, 'i');
                ponentesFiltrados = ponentes.filter(ponente => {
                    if(ponente.nombre.toLowerCase().search(expresion) != -1) {
                        return ponente;
                    }
                });

            }  else {
                ponentesFiltrados = [];
            }
            
            mostrarPonentes();
        }

        function mostrarPonentes() {

            while(listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if(ponentesFiltrados.length > 0) {

                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('LI');
                    ponenteHTML.classList.add('listado-ponentes__ponente');
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;
                    ponenteHTML.onclick = seleccionarPonente;

                    //Agregar al DOM
                    listadoPonentes.appendChild(ponenteHTML);
                });

            } else {
                const noResultados = document.createElement('LI');
                noResultados.classList.add('listado-ponentes__no-resultado');
                noResultados.textContent = 'No hay resultados';

                listadoPonentes.appendChild(noResultados);
            }
        }

        function seleccionarPonente(e) {
            const ponente = e.target;

            //Remover la clase anterior, o sea para que no se eleccione los dos sino solo 1.
            const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');

            if(ponentePrevio) {
                ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');
            }

            ponente.classList.add('listado-ponentes__ponente--seleccionado');

            ponenteHidden.value = ponente.dataset.ponenteId;
        }
    }

})();

