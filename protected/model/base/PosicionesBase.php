<?php
Doo::loadCore('db/DooModel');

class PosicionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 2.
     */
    public $posicion;

    public $_table = 'posiciones';
    public $_primarykey = 'id';
    public $_fields = array('id','posicion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'posicion' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                )
            );
    }

}