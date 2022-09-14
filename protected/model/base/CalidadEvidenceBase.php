<?php
Doo::loadCore('db/DooModel');

class CalidadEvidenceBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 200.
     */
    public $imagen;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    public $_table = 'calidad_evidence';
    public $_primarykey = 'id';
    public $_fields = array('id','imagen','id_entrada');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'imagen' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}