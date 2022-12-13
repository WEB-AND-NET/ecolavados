<?php
Doo::loadCore('db/DooModel');

class TokensBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $token;

    /**
     * @var datetime
     */
    public $fechaCreacion;

    /**
     * @var varchar Max length is 40.
     */
    public $modulo;

    /**
     * @var varchar Max length is 10.
     */
    public $numModulo;

    /**
     * @var int Max length is 11.
     */
    public $estado;

    public $_table = 'tokens';
    public $_primarykey = 'id';
    public $_fields = array('id','token','fechaCreacion','modulo','numModulo','estado');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'token' => array(
                        array( 'notnull' ),
                ),

                'fechaCreacion' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'modulo' => array(
                        array( 'maxlength', 40 ),
                        array( 'optional' ),
                ),

                'numModulo' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}