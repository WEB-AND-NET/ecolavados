<?php
Doo::loadCore('db/DooModel');

class MrGuidelineBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $guideline;

    /**
     * @var varchar Max length is 45.
     */
    public $code;

    /**
     * @var int Max length is 11.
     */
    public $damage;

    /**
     * @var int Max length is 11.
     */
    public $deleted;

    public $_table = 'mr_guideline';
    public $_primarykey = 'id';
    public $_fields = array('id','guideline','code','damage','deleted');

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

                'code' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'damage' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
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