<?php
Doo::loadCore('db/DooModel');

class ItemsCalificacionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_item;

    /**
     * @var int Max length is 11.
     */
    public $id_calificacion;

    /**
     * @var int Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $deleted_at;

    public $_table = 'items_calificaciones';
    public $_primarykey = 'id';
    public $_fields = array('id','id_item','id_calificacion','deleted','created_at','deleted_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_item' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_calificacion' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'deleted_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}