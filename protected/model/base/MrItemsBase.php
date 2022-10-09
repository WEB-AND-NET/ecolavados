<?php
Doo::loadCore('db/DooModel');

class MrItemsBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $guideline;

    /**
     * @var text
     */
    public $request_code;

    /**
     * @var varchar Max length is 45.
     */
    public $code;

    /**
     * @var varchar Max length is 45.
     */
    public $mr;

    /**
     * @var varchar Max length is 45.
     */
    public $deleted;

    public $_table = 'mr_items';
    public $_primarykey = 'id';
    public $_fields = array('id','guideline','request_code','code','mr','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'guideline' => array(
                        array( 'optional' ),
                ),

                'request_code' => array(
                        array( 'optional' ),
                ),

                'code' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'mr' => array(
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