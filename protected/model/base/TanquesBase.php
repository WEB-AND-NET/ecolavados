<?php
Doo::loadCore('db/DooModel');

class TanquesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var date
     */
    public $make_date;

    /**
     * @var varchar Max length is 45.
     */
    public $serial;

    /**
     * @var varchar Max length is 45.
     */
    public $test30;

    /**
     * @var varchar Max length is 45.
     */
    public $test60;

    /**
     * @var varchar Max length is 1.
     */
    public $deleted;

    /**
     * @var varchar Max length is 45.
     */
    public $create_at;

    /**
     * @var varchar Max length is 45.
     */
    public $update_at;

    /**
     * @var int Max length is 11.
     */
    public $clientes_id;

    /**
     * @var int Max length is 11.
     */
    public $usuarios_id;

    /**
     * @var varchar Max length is 200.
     */
    public $last_cargo;

    public $_table = 'tanques';
    public $_primarykey = 'id';
    public $_fields = array('id','make_date','serial','test30','test60','deleted','create_at','update_at','clientes_id','usuarios_id','last_cargo');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'make_date' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'serial' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'test30' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'test60' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'create_at' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
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

                'last_cargo' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                )
            );
    }

}