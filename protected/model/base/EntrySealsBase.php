<?php
Doo::loadCore('db/DooModel');

class EntrySealsBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $entry;

    /**
     * @var varchar Max length is 200.
     */
    public $image;

    /**
     * @var varchar Max length is 300.
     */
    public $observation;

    public $_table = 'entry_seals';
    public $_primarykey = 'id';
    public $_fields = array('id','entry','image','observation');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'entry' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'image' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'observation' => array(
                        array( 'maxlength', 300 ),
                        array( 'optional' ),
                )
            );
    }

}