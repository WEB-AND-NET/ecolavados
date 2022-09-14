<?php
Doo::loadCore('db/DooModel');

class RequestItemEntradaBase extends DooModel{

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
    public $id_item_entrada;

    /**
     * @var int Max length is 11.
     */
    public $id_item_repair;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $precio;

    /**
     * @var int Max length is 11.
     */
    public $deleted;

    /**
     * @var varchar Max length is 45.
     */
    public $work_order;

    /**
     * @var varchar Max length is 3.
     */
    public $type;

    /**
     * @var varchar Max length is 100.
     */
    public $img;

    /**
     * @var int Max length is 11.
     */
    public $cantidad;

    public $_table = 'request_item_entrada';
    public $_primarykey = 'id';
    public $_fields = array('id','id_request','id_item_entrada','id_item_repair','precio','deleted','work_order','type','img','cantidad');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_request' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_item_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_item_repair' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'precio' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'work_order' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'img' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'cantidad' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}