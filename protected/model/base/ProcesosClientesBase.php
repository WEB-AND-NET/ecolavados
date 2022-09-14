<?php
Doo::loadCore('db/DooModel');

class ProcesosClientesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var datetime
     */
    public $create_at;

    /**
     * @var datetime
     */
    public $update_at;

    /**
     * @var varchar Max length is 1.
     */
    public $deleted;

    /**
     * @var int Max length is 11.
     */
    public $procesos_id;

    /**
     * @var int Max length is 11.
     */
    public $clientes_id;

    /**
     * @var int Max length is 11.
     */
    public $usuarios_id;

    /**
     * @var decimal Max length is 10. ,0).
     */
    public $valor;

    public $_table = 'procesos_clientes';
    public $_primarykey = 'id';
    public $_fields = array('id','create_at','update_at','deleted','procesos_id','clientes_id','usuarios_id','valor');

    public function getVRules() {
        return array(
                'id' => array(
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
                ),

                'procesos_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'clientes_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'usuarios_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'float' ),
                        array( 'optional' ),
                )
            );
    }

}