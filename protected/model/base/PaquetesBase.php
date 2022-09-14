<?php
Doo::loadCore('db/DooModel');

class PaquetesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $nombre;

    /**
     * @var varchar Max length is 45.
     */
    public $precio;

    /**
     * @var int Max length is 11.
     */
    public $clientes_id;

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
    public $deleted;

    public $_table = 'paquetes';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','precio','clientes_id','create_at','update_at','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'precio' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'clientes_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
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
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}