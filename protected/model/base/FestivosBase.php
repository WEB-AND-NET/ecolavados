<?php
Doo::loadCore('db/DooModel');

class FestivosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var date
     */
    public $fecha;

    /**
     * @var varchar Max length is 100.
     */
    public $descripcion;

    public $_table = 'festivos';
    public $_primarykey = 'id';
    public $_fields = array('id','fecha','descripcion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'fecha' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'descripcion' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                )
            );
    }

}