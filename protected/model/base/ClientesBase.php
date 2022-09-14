<?php
Doo::loadCore('db/DooModel');

class ClientesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $identificacion;

    /**
     * @var varchar Max length is 200.
     */
    public $nombre;

    /**
     * @var varchar Max length is 200.
     */
    public $celular;

    /**
     * @var text
     */
    public $email;

    /**
     * @var char Max length is 1.
     */
    public $tipo;

    /**
     * @var varchar Max length is 100.
     */
    public $direccion;

    /**
     * @var varchar Max length is 200.
     */
    public $c_nombre;

    /**
     * @var varchar Max length is 200.
     */
    public $c_celular;

    /**
     * @var text
     */
    public $c_email;

    /**
     * @var char Max length is 1.
     */
    public $tipo_tarifa;

    /**
     * @var varchar Max length is 200.
     */
    public $dias_habiles;

    /**
     * @var int Max length is 10.
     */
    public $id_usuario;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $updated_at;

    /**
     * @var text
     */
    public $departamento;

    /**
     * @var text
     */
    public $ciudad;

    public $_table = 'clientes';
    public $_primarykey = 'id';
    public $_fields = array('id','identificacion','nombre','celular','email','tipo','direccion','c_nombre','c_celular','c_email','tipo_tarifa','dias_habiles','id_usuario','deleted','created_at','updated_at','departamento','ciudad');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'identificacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'celular' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'email' => array(
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'direccion' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'c_nombre' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'c_celular' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'c_email' => array(
                        array( 'optional' ),
                ),

                'tipo_tarifa' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'dias_habiles' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'id_usuario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'departamento' => array(
                        array( 'optional' ),
                ),

                'ciudad' => array(
                        array( 'optional' ),
                )
            );
    }

}