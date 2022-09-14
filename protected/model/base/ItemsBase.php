<?php
Doo::loadCore('db/DooModel');

class ItemsBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $descripcion;

    /**
     * @var varchar Max length is 45.
     */
    public $principal;

    /**
     * @var varchar Max length is 45.
     */
    public $depende;

    /**
     * @var varchar Max length is 1.
     */
    public $editable;

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

    public $_table = 'items';
    public $_primarykey = 'id';
    public $_fields = array('id','descripcion','principal','depende','editable','create_at','update_at','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'descripcion' => array(
                        array( 'optional' ),
                ),

                'principal' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'depende' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'editable' => array(
                        array( 'maxlength', 1 ),
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
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                )
            );
    }

}