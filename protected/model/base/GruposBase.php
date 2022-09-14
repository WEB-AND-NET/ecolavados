<?php
Doo::loadCore('db/DooModel');

class GruposBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 100.
     */
    public $name;

    /**
     * @var varchar Max length is 2.
     */
    public $deleted;

    public $_table = 'grupos';
    public $_primarykey = 'id';
    public $_fields = array('id','name','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'name' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                )
            );
    }

}