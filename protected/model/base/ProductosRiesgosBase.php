<?php
Doo::loadCore('db/DooModel');

class ProductosRiesgosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_producto;

    /**
     * @var varchar Max length is 10.
     */
    public $riesgo;

    public $_table = 'productos_riesgos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_producto','riesgo');

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

                'riesgo' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                )
            );
    }

}