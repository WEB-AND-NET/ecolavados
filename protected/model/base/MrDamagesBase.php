<?php
Doo::loadCore('db/DooModel');

class MrDamagesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $request_code;

    /**
     * @var varchar Max length is 100.
     */
    public $damage;

    /**
     * @var int Max length is 11.
     */
    public $deleted;

    public $_table = 'mr_damages';
    public $_primarykey = 'id';
    public $_fields = array('id','request_code','damage','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'request_code' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'damage' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}