<?php
Doo::loadCore('db/DooModel');

class EmpleadosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre;

    /**
     * @var varchar Max length is 100.
     */
    public $apellido;

    /**
     * @var varchar Max length is 45.
     */
    public $identificacion;

    /**
     * @var int Max length is 11.
     */
    public $cargo;

    /**
     * @var varchar Max length is 1200.
     */
    public $direccion;

    /**
     * @var varchar Max length is 45.
     */
    public $tipo_de_sangre;

    /**
     * @var varchar Max length is 1000.
     */
    public $atencion_en_emergencia;

    /**
     * @var varchar Max length is 100.
     */
    public $eps;

    /**
     * @var varchar Max length is 45.
     */
    public $arl;

    /**
     * @var varchar Max length is 45.
     */
    public $telefono;

    /**
     * @var varchar Max length is 45.
     */
    public $contacto_en_emergencia;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre_contacto_emergencia;

    /**
     * @var varchar Max length is 45.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var varchar Max length is 45.
     */
    public $update_at;

    public $_table = 'empleados';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','apellido','identificacion','cargo','direccion','tipo_de_sangre','atencion_en_emergencia','eps','arl','telefono','contacto_en_emergencia','nombre_contacto_emergencia','deleted','created_at','update_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'apellido' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'identificacion' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'cargo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'direccion' => array(
                        array( 'maxlength', 1200 ),
                        array( 'optional' ),
                ),

                'tipo_de_sangre' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'atencion_en_emergencia' => array(
                        array( 'maxlength', 1000 ),
                        array( 'optional' ),
                ),

                'eps' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'arl' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'telefono' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'contacto_en_emergencia' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'nombre_contacto_emergencia' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}