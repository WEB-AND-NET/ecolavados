<?php
Doo::loadCore('db/DooModel');

class ClientesProductosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $clientes_id;

    /**
     * @var int Max length is 11.
     */
    public $productos_id;

    /**
     * @var int Max length is 11.
     */
    public $servicio_id;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $precio;

    /**
     * @var char Max length is 1.
     */
    public $moneda;

    /**
     * @var varchar Max length is 45.
     */
    public $dias_libre;

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
     * @var varchar Max length is 1.
     */
    public $invoice_always;

    public $_table = 'clientes_productos';
    public $_primarykey = 'id';
    public $_fields = array('id','clientes_id','productos_id','servicio_id','precio','moneda','dias_libre','create_at','update_at','deleted','invoice_always');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'clientes_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'productos_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'servicio_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'precio' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'moneda' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'dias_libre' => array(
                        array( 'maxlength', 45 ),
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

                'invoice_always' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}