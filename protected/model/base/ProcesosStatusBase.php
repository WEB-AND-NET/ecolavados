<?php
Doo::loadCore('db/DooModel');

class ProcesosStatusBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_proceso;

    /**
     * @var int Max length is 11.
     */
    public $id_status;

    /**
     * @var int Max length is 11.
     */
    public $id_next_status;

    public $_table = 'procesos_status';
    public $_primarykey = 'id';
    public $_fields = array('id','id_proceso','id_status','id_next_status');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_proceso' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_status' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_next_status' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}