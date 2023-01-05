<?php
Doo::loadCore('db/DooModel');

class EntradaBase extends DooModel{

    /**
     * @var int Max length is 10.  unsigned zerofill.
     */
    public $id;

    /**
     * @var date
     */
    public $fecha;

    /**
     * @var int Max length is 11.
     */
    public $autorizacion_ingreso_id;

    /**
     * @var datetime
     */
    public $create_at;

    /**
     * @var datetime
     */
    public $update_at;

    /**
     * @var char Max length is 1.
     */
    public $delete;

    /**
     * @var varchar Max length is 1.
     */
    public $estado;

    /**
     * @var int Max length is 11.
     */
    public $status;

    /**
     * @var int Max length is 11.
     */
    public $last_cargo;

    /**
     * @var int Max length is 11.
     */
    public $posicion;

    /**
     * @var int Max length is 11.
     */
    public $ciudad;

    public $_table = 'entrada';
    public $_primarykey = 'id';
    public $_fields = array('id','fecha','autorizacion_ingreso_id','create_at','update_at','delete','estado','status','last_cargo','posicion','ciudad');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'fecha' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'autorizacion_ingreso_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'create_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'delete' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'estado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'status' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'last_cargo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'posicion' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'ciudad' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}