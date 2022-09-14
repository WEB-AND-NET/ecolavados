<?php
Doo::loadCore('db/DooModel');

class LogsStatusBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var varchar Max length is 45.
     */
    public $status;

    /**
     * @var datetime
     */
    public $fecha;

    /**
     * @var varchar Max length is 100.
     */
    public $cause;

    public $_table = 'logs_status';
    public $_primarykey = 'id';
    public $_fields = array('id','id_entrada','status','fecha','cause');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'status' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'fecha' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'cause' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                )
            );
    }

}