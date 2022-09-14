<?php
Doo::loadCore('db/DooModel');

class EjecucionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $facturar;

    /**
     * @var datetime
     */
    public $fecha;

    /**
     * @var int Max length is 11.
     */
    public $procesos_id;

    /**
     * @var int Max length is 10.
     */
    public $entrada_id;

    public $_table = 'ejecuciones';
    public $_primarykey = 'id';
    public $_fields = array('id','facturar','fecha','procesos_id','entrada_id');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'facturar' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'fecha' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'procesos_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'entrada_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                )
            );
    }

}