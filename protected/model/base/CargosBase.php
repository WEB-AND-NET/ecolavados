<?php
Doo::loadCore('db/DooModel');

class CargosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 100.
     */
    public $cargo;

    public $_table = 'cargos';
    public $_primarykey = 'id';
    public $_fields = array('id','cargo');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'cargo' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                )
            );
    }

}