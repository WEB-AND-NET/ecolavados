<?php

/**
 * Description of ServiciosCliente
 * 
 * @author Carlos Meriño Iriarte <carlos.merino.iriarte@gmail.com>
 */
class Evidences extends FPDF {

    public function __construct() {

        parent::__construct('L', 'mm', 'a4');
        $this->SetTitle("EVIDENCES OF SERVICE");
    }

    function Body() {

    }

}