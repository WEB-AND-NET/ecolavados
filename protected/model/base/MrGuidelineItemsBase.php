<?php
Doo::loadCore('db/DooModel');

class MrGuidelineItemsBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $guideline;

    /**
     * @var int Max length is 11.
     */
    public $items;

    /**
     * @var int Max length is 11.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    public $_table = 'mr_guideline_items';
    public $_primarykey = 'id';
    public $_fields = array('id','guideline','items','deleted','created_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'guideline' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'items' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}