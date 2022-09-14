<?php
Doo::loadCore('db/DooModel');

class TrabajosProcesosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_trabajo;

    /**
     * @var int Max length is 11.
     */
    public $id_proceso;

    public $_table = 'trabajos_procesos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_trabajo','id_proceso');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_trabajo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_proceso' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}