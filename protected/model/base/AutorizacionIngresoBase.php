<?php
Doo::loadCore('db/DooModel');

class AutorizacionIngresoBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $transportista;

    /**
     * @var varchar Max length is 45.
     */
    public $placa;

    /**
     * @var varchar Max length is 100.
     */
    public $conductor;

    /**
     * @var varchar Max length is 45.
     */
    public $state;

    /**
     * @var int Max length is 11.
     */
    public $tanques_id;

    /**
     * @var date
     */
    public $fecha_estimada;

    /**
     * @var date
     */
    public $fecha_salida;

    /**
     * @var varchar Max length is 20.
     */
    public $placa_salida;

    /**
     * @var varchar Max length is 200.
     */
    public $nombre_conductor_salida;

    /**
     * @var varchar Max length is 200.
     */
    public $empresa_salida;

    /**
     * @var longtext
     */
    public $autorizacion30;

    /**
     * @var longtext
     */
    public $autorizacion60;

    /**
     * @var int Max length is 11.
     */
    public $clientes_id;

    /**
     * @var varchar Max length is 45.
     */
    public $reference;

    /**
     * @var longtext
     */
    public $singeco;

    /**
     * @var longtext
     */
    public $singdrive;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $create_at;

    /**
     * @var datetime
     */
    public $update_at;

    /**
     * @var varchar Max length is 45.
     */
    public $color_client_send;

    /**
     * @var varchar Max length is 45.
     */
    public $numer_client_sed;

    /**
     * @var varchar Max length is 100.
     */
    public $name_client_send;

    /**
     * @var varchar Max length is 45.
     */
    public $type;

    /**
     * @var varchar Max length is 45.
     */
    public $reservation;

    /**
     * @var varchar Max length is 100.
     */
    public $reference_out;

    /**
     * @var varchar Max length is 2.
     */
    public $assing;

    /**
     * @var text
     */
    public $observation;

    /**
     * @var datetime
     */
    public $arrival;

    /**
     * @var varchar Max length is 100.
     */
    public $last_cargo_suggest;

    /**
     * @var varchar Max length is 100.
     */
    public $reference_get_out;

    /**
     * @var datetime
     */
    public $final_arrival;

    public $_table = 'autorizacion_ingreso';
    public $_primarykey = 'id';
    public $_fields = array('id','transportista','placa','conductor','state','tanques_id','fecha_estimada','fecha_salida','placa_salida','nombre_conductor_salida','empresa_salida','autorizacion30','autorizacion60','clientes_id','reference','singeco','singdrive','deleted','create_at','update_at','color_client_send','numer_client_sed','name_client_send','type','reservation','reference_out','assing','observation','arrival','last_cargo_suggest','reference_get_out','final_arrival');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'transportista' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'placa' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'conductor' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'state' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'tanques_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'fecha_estimada' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'fecha_salida' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'placa_salida' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'nombre_conductor_salida' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'empresa_salida' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'autorizacion30' => array(
                        array( 'optional' ),
                ),

                'autorizacion60' => array(
                        array( 'optional' ),
                ),

                'clientes_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'reference' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'singeco' => array(
                        array( 'optional' ),
                ),

                'singdrive' => array(
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'create_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'color_client_send' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'numer_client_sed' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'name_client_send' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'type' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'reservation' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'reference_out' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'assing' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'observation' => array(
                        array( 'optional' ),
                ),

                'arrival' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'last_cargo_suggest' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'reference_get_out' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'final_arrival' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                )
            );
    }

}