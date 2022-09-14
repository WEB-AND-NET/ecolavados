<?php
Doo::loadCore('db/DooModel');

class ItemsEntradaBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $items_id;

    /**
     * @var text
     */
    public $valor;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var varchar Max length is 1.
     */
    public $causes_log;

    /**
     * @var text
     */
    public $img;

    public $_table = 'items_entrada';
    public $_primarykey = 'id';
    public $_fields = array('id','items_id','valor','id_entrada','causes_log','img');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'items_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'valor' => array(
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'causes_log' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'img' => array(
                        array( 'optional' ),
                )
            );
    }

}