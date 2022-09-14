<?php
Doo::loadCore('db/DooModel');

class LimpiezaBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 200.
     */
    public $sellos;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var text
     */
    public $sing;

    /**
     * @var longblob
     */
    public $img;

    public $_table = 'limpieza';
    public $_primarykey = 'id';
    public $_fields = array('id','sellos','id_entrada','sing','img');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'sellos' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'sing' => array(
                        array( 'optional' ),
                ),

                'img' => array(
                        array( 'optional' ),
                )
            );
    }

}