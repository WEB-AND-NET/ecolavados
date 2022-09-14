<?php
Doo::loadCore('db/DooModel');

class ProductosRelacionBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_producto;

    /**
     * @var double Max length is 11. ,2).
     */
    public $cantidad;

    /**
     * @var int Max length is 11.
     */
    public $id_producto_a;

    /**
     * @var int Max length is 1.
     */
    public $deleted;

    public $_table = 'productos_relacion';
    public $_primarykey = 'id';
    public $_fields = array('id','id_producto','cantidad','id_producto_a','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_producto' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'cantidad' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'id_producto_a' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}