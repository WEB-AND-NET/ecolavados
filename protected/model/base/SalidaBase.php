<?php
Doo::loadCore('db/DooModel');

class SalidaBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_autorizacion;

    /**
     * @var int Max length is 11.
     */
    public $id_tanque;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var int Max length is 11.
     */
    public $id_cliente;

    /**
     * @var text
     */
    public $observacion;

    /**
     * @var varchar Max length is 45.
     */
    public $fecha_salida;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var varchar Max length is 200.
     */
    public $reference;

    public $_table = 'salida';
    public $_primarykey = 'id';
    public $_fields = array('id','id_autorizacion','id_tanque','id_entrada','id_cliente','observacion','fecha_salida','created_at','reference');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_autorizacion' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_tanque' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_cliente' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'observacion' => array(
                        array( 'optional' ),
                ),

                'fecha_salida' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'reference' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                )
            );
    }

}