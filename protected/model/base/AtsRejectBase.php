<?php
Doo::loadCore('db/DooModel');

class AtsRejectBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $id_ats;

    /**
     * @var varchar Max length is 45.
     */
    public $id_tarra;

    public $_table = 'ats_reject';
    public $_primarykey = 'id';
    public $_fields = array('id','id_ats','id_tarra');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_ats' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'id_tarra' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}