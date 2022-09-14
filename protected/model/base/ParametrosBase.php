<?php
Doo::loadCore('db/DooModel');

class ParametrosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var char Max length is 3.
     */
    public $territorial;

    /**
     * @var char Max length is 4.
     */
    public $resolucion_hab;

    /**
     * @var char Max length is 2.
     */
    public $ano_hab;

    /**
     * @var int Max length is 4.
     */
    public $ano_actual;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $cons_cliente;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $cons_planilla;

    /**
     * @var int Max length is 5.  unsigned zerofill.
     */
    public $cons_ruta;

    /**
     * @var int Max length is 4.  unsigned zerofill.
     */
    public $cons_factura;

    /**
     * @var int Max length is 11.
     */
    public $iva;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $valor_residuos;

    public $_table = 'parametros';
    public $_primarykey = 'id';
    public $_fields = array('id','territorial','resolucion_hab','ano_hab','ano_actual','cons_cliente','cons_planilla','cons_ruta','cons_factura','iva','valor_residuos');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'territorial' => array(
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'resolucion_hab' => array(
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'ano_hab' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'ano_actual' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'cons_cliente' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'cons_planilla' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'cons_ruta' => array(
                        array( 'integer' ),
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'cons_factura' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                ),

                'iva' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'valor_residuos' => array(
                        array( 'float' ),
                        array( 'optional' ),
                )
            );
    }

}