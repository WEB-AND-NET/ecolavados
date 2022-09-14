<?php
Doo::loadCore('db/DooModel');

class StatusBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $status_name;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

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
    public $color;

    public $_table = 'status';
    public $_primarykey = 'id';
    public $_fields = array('id','status_name','deleted','create_at','update_at','color');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'status_name' => array(
                        array( 'optional' ),
                ),

                'deleted' => array(
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

                'color' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}