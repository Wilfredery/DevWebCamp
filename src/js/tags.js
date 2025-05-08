(function() {

    document.addEventListener('DOMContentLoaded', function() {
        
        const tagsInput = document.querySelector('#tags_input');

        if(tagsInput) {
    
            const tagsDiv = document.querySelector('#tags');
            const tagsInputHidden = document.querySelector('[name="tags"]');
    
            let tags = [];
    
            //Recuperar del input oculto
            if(tagsInputHidden.value !== '') {
                tags = tagsInputHidden.value.split(','); //Lo coloca deforma string con comas.
                mostrarTag();
            }
    
            //ESCUCHAR LOS CAMBIOS EN EL INPUT
            tagsInput.addEventListener('keypress', guardarTag);
    
            function guardarTag(event) {
                
                if(event.key === ',') {
    
                    if(event.target.value.trim() === '' || event.target.value === 1) {
                        return;
                    }
    
                    event.preventDefault(); //Evitar el comportamiento por defecto del input
                    //Comprobar que el input no esté vacío
                    tags = [...tags, event.target.value.trim()];
                    tagsInput.value = ''; //Limpiar el input
                    
                    mostrarTag();
    
    
                }
            }
    
            function mostrarTag() {
                tagsDiv.textContent = ''; //Limpiar el div de los tags
                tags.forEach(tag => {
                    const etiqueta = document.createElement('LI');
                    etiqueta.classList.add('formulario__tag');
                    etiqueta.textContent = tag;
                    etiqueta.ondblclick = eliminarTag; //Eliminar el tag al hacer doble click
    
                    tagsDiv.appendChild(etiqueta);
                });
    
                actualizarInputHidden();
            }
    
            function eliminarTag(event) {
                event.target.remove(); //Eliminar el tag del DOM
    
                tags = tags.filter(tag => tag !== event.target.textContent); //Eliminar el tag del array
                actualizarInputHidden();
            }
    
            function actualizarInputHidden() {
                tagsInputHidden.value = tags.toString();
            }
        }
    })

})(); //IIFE