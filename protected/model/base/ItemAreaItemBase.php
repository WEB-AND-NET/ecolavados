<?php
Doo::loadCore('db/DooModel');

class ItemAreaItemBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_item;

    /**
     * @var int Max length is 11.
     */
    public $id_item_area;

    /**
     * @var int Max length is 11.
     */
    public $deleted;

    public $_table = 'item_area_item';
    public $_primarykey = 'id';
    public $_fields = array('id','id_item','id_item_area','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_item' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_item_area' => array(
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