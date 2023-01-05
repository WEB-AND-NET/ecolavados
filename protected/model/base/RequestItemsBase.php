<?php
Doo::loadCore('db/DooModel');

class RequestItemsBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_request;

    /**
     * @var int Max length is 11.
     */
    public $id_damage;

    /**
     * @var int Max length is 11.
     */
    public $id_service;

    /**
     * @var int Max length is 11.
     */
    public $id_area;

    /**
     * @var int Max length is 11.
     */
    public $id_item_area;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $material;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $hours;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $total;

    /**
     * @var char Max length is 1.
     */
    public $aproved;

    /**
     * @var varchar Max length is 200.
     */
    public $remarks;

    public $_table = 'request_items';
    public $_primarykey = 'id';
    public $_fields = array('id','id_request','id_damage','id_service','id_area','id_item_area','material','hours','total','aproved','remarks');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'id_request' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_damage' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_service' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_area' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_item_area' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'material' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'hours' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'total' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'aproved' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'remarks' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                )
            );
    }

}