<?php
Doo::loadCore('db/DooModel');

class DetallePaquetesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $paquetes_id;

    /**
     * @var int Max length is 11.
     */
    public $productos_id;

    /**
     * @var decimal Max length is 10. ,2).
     */
    public $cantidad;

    /**
     * @var decimal Max length is 10. ,2).
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
     * @var char Max length is 1.
     */
    public $delete;

    public $_table = 'detalle_paquetes';
    public $_primarykey = 'id';
    public $_fields = array('id','paquetes_id','productos_id','cantidad','precio','create_at','update_at','delete');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'paquetes_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'productos_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'cantidad' => array(
                        array( 'float' ),
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

                'delete' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}