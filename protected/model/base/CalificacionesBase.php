<?php
Doo::loadCore('db/DooModel');

class CalificacionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 200.
     */
    public $descripcion;

    /**
     * @var varchar Max length is 1.
     */
    public $causes_log;

    /**
     * @var varchar Max length is 45.
     */
    public $goodorbad;

    /**
     * @var varchar Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $update_at;

    public $_table = 'calificaciones';
    public $_primarykey = 'id';
    public $_fields = array('id','descripcion','causes_log','goodorbad','deleted','created_at','update_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'descripcion' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'causes_log' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'goodorbad' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}