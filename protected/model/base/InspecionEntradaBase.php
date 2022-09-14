<?php
Doo::loadCore('db/DooModel');

class InspecionEntradaBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $obvservacion;

    /**
     * @var int Max length is 11.
     */
    public $entrada_id;

    public $_table = 'inspecion_entrada';
    public $_primarykey = 'id';
    public $_fields = array('id','obvservacion','entrada_id');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'notnull' ),
                ),

                'obvservacion' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'entrada_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}