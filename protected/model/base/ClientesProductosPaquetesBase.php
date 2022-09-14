<?php
Doo::loadCore('db/DooModel');

class ClientesProductosPaquetesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $id_clientes_productos;

    /**
     * @var varchar Max length is 45.
     */
    public $id_paquete;

    /**
     * @var varchar Max length is 45.
     */
    public $deleted;

    public $_table = 'clientes_productos_paquetes';
    public $_primarykey = 'id';
    public $_fields = array('id','id_clientes_productos','id_paquete','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_clientes_productos' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'id_paquete' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}