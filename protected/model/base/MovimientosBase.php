<?php
Doo::loadCore('db/DooModel');

class MovimientosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $cantidad;

    /**
     * @var varchar Max length is 45.
     */
    public $tipo;

    /**
     * @var decimal Max length is 10. ,0).
     */
    public $precio;

    /**
     * @var datetime
     */
    public $create_at;

    /**
     * @var datetime
     */
    public $update_at;

    /**
     * @var varchar Max length is 45.
     */
    public $deleted;

    /**
     * @var int Max length is 11.
     */
    public $productos_id;

    /**
     * @var text
     */
    public $details;

    public $_table = 'movimientos';
    public $_primarykey = 'id';
    public $_fields = array('id','cantidad','tipo','precio','create_at','update_at','deleted','productos_id','details');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'cantidad' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'precio' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'create_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'productos_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'details' => array(
                        array( 'optional' ),
                )
            );
    }

}