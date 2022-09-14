<?php
Doo::loadCore('db/DooModel');

class TiposProductosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $tipo;

    /**
     * @var datetime
     */
    public $update_at;

    /**
     * @var datetime
     */
    public $create_at;

    /**
     * @var varchar Max length is 1.
     */
    public $deleted;

    /**
     * @var varchar Max length is 2.
     */
    public $para_clientes;

    public $_table = 'tipos_productos';
    public $_primarykey = 'id';
    public $_fields = array('id','tipo','update_at','create_at','deleted','para_clientes');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'create_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'para_clientes' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                )
            );
    }

}