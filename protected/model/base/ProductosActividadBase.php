<?php
Doo::loadCore('db/DooModel');

class ProductosActividadBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_producto;

    /**
     * @var int Max length is 11.
     */
    public $numero;

    /**
     * @var varchar Max length is 200.
     */
    public $texto;

    /**
     * @var int Max length is 11.
     */
    public $tiempo;

    public $_table = 'productos_actividad';
    public $_primarykey = 'id';
    public $_fields = array('id','id_producto','numero','texto','tiempo');

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

                'numero' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'texto' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'tiempo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}