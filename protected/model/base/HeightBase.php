<?php
Doo::loadCore('db/DooModel');

class HeightBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $consecutivo;

    /**
     * @var int Max length is 11.
     */
    public $id_trabajo;

    /**
     * @var int Max length is 11.
     */
    public $id_empleado_autoriza;

    /**
     * @var int Max length is 11.
     */
    public $id_empleado_autorizado;

    /**
     * @var longtext
     */
    public $firma_empleado_autoriza;

    /**
     * @var longtext
     */
    public $firma_empleado_autorizado;

    /**
     * @var datetime
     */
    public $hora_inicio;

    /**
     * @var datetime
     */
    public $hora_final;

    /**
     * @var char Max length is 1.
     */
    public $status;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var text
     */
    public $id_empleado_autoriza_fin;

    /**
     * @var text
     */
    public $firma_empleado_autorizado_fin;

    /**
     * @var varchar Max length is 45.
     */
    public $altura;

    public $_table = 'height';
    public $_primarykey = 'id';
    public $_fields = array('id','consecutivo','id_trabajo','id_empleado_autoriza','id_empleado_autorizado','firma_empleado_autoriza','firma_empleado_autorizado','hora_inicio','hora_final','status','deleted','created_at','id_empleado_autoriza_fin','firma_empleado_autorizado_fin','altura');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'consecutivo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'id_trabajo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_empleado_autoriza' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_empleado_autorizado' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'firma_empleado_autoriza' => array(
                        array( 'optional' ),
                ),

                'firma_empleado_autorizado' => array(
                        array( 'optional' ),
                ),

                'hora_inicio' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'hora_final' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'status' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'id_empleado_autoriza_fin' => array(
                        array( 'optional' ),
                ),

                'firma_empleado_autorizado_fin' => array(
                        array( 'optional' ),
                ),

                'altura' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}