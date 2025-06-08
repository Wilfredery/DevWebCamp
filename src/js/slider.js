import Swiper, { FreeMode, Navigation }from 'swiper';
import 'swiper/css';        //Importa los estilos de Swiper  
import 'swiper/css/navigation'; //Importa los estilos de navegación de Swiper
import 'swiper/css/free-mode';  //Importa los estilos de modo libre de Swiper

document.addEventListener('DOMContentLoaded', function() {

    if(document.querySelector('.slider')) {

        const opciones = {
            slidesPerView: 3, //La cantidad que se va  amostrar en la pantalla
            spaceBetween: 15, //El espacio entre cada slide
            FreeMode: true, //Permite que se pueda desplazar el slider sin que se detenga en cada slide

            navigation: { //Permite que se pueda navegar entre los slides
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },

            breakpoints: { //Permite que se pueda adaptar el slider a diferentes tamaños de pantalla

                //Los numeros son los px de ancho de pantalla
                0: {
                    slidesPerView: 1,
                    spaceBetween: 5
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 30
                }
            }
        }

        Swiper.use([FreeMode, Navigation]); //Se importan los modulos de Swiper
        new Swiper('.slider', opciones)
    }


})