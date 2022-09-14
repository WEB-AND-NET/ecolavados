<?php
Doo::loadCore('db/DooModel');

class ActionEmailBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $action;

    public $_table = 'action_email';
    public $_primarykey = 'id';
    public $_fields = array('id','action');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'action' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}