<?php
Doo::loadCore('db/DooModel');

class MunicipiosBase extends DooModel{

    /**
     * @var int Max length is 6.
     */
    public $id;

    /**
     * @var varchar Max length is 255.
     */
    public $municipio;

    /**
     * @var int Max length is 1.  unsigned.
     */
    public $estado;

    /**
     * @var int Max length is 10.
     */
    public $departamento;

    public $_table = 'municipios';
    public $_primarykey = 'id';
    public $_fields = array('id','municipio','estado','departamento');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 6 ),
                        array( 'optional' ),
                ),

                'municipio' => array(
                        array( 'maxlength', 255 ),
                        array( 'notnull' ),
                ),

                'estado' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'departamento' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                )
            );
    }

}