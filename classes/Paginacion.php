<?php 

    namespace Classes;

    class Paginacion {
        public $pagina_actual;
        public $registros_por_pagina;
        public $total_registros;

        public function __construct($pagina_actual=1, $registros_por_pagina = 10, $total_registros = 0) {
            
            $this->pagina_actual = (int) $pagina_actual;
            $this->registros_por_pagina = (int) $registros_por_pagina;
            $this->total_registros = (int) $total_registros;
        }

        //Cantidad de contenido que se va a mostrar en cada pagina
        public function offset() {
            return $this->registros_por_pagina * ($this->pagina_actual - 1);
        }

        public function totalPagina() {
            //sE ENFOCA DE REDONDEAR HACIA ARRIBA
            return ceil($this->total_registros / $this->registros_por_pagina);
        }

        public function pagina_anterior() {
            $anterior = $this->pagina_actual - 1;

            return ($anterior > 0) ? $anterior : false;
        }

        public function pagina_siguiente() {
            $siguiente = $this->pagina_actual + 1;
            return ($siguiente <= $this->totalPagina()) ? $siguiente : false;
        }

        public function enlace_anterior() {

            $html = '';

            if($this->pagina_anterior()) {
                $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page=" . $this->pagina_anterior() . "\">&laquo; Anterior</a>";
            }

            return $html;
        }

        public function enlace_siguiente() {

            $html = '';

            if($this->pagina_siguiente()) {
                $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page=" . $this->pagina_siguiente() . "\">Siguiente &raquo;</a>";
            }

            return $html;
        }

        public function numeropagina() {
            $html = '';

            for($i = 1; $i <= $this->totalPagina(); $i++) {

                if($i === $this->pagina_actual) {

                    $html .= "<span class=\"paginacion__enlace paginacion__enlace--actual\">$i</span>";

                } else {
                    $html .= "<a class=\"paginacion__enlace paginacion__enlace--numero\" href=\"?page=". $i ."\">$i</a>";
                }

            }
            
            return $html;
        }

        public function paginacion() {
            $html = '';

            if($this->total_registros > 1) {
                $html .= '<div class="paginacion">';
                $html .= $this->enlace_anterior();
                $html .= $this->numeropagina();
                $html .= $this->enlace_siguiente();
                

                $html .= '</div>';
            }

            return $html;
        }
        
    }

?>