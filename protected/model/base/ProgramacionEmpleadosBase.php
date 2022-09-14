<?php
Doo::loadCore('db/DooModel');

class ProgramacionEmpleadosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_programacion;

    /**
     * @var int Max length is 11.
     */
    public $id_empleado;

    /**
     * @var datetime
     */
    public $fecha_inicio;

    /**
     * @var datetime
     */
    public $fecha_fin;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var char Max length is 1.
     */
    public $cerrado;

    /**
     * @var text
     */
    public $observacion;

    public $_table = 'programacion_empleados';
    public $_primarykey = 'id';
    public $_fields = array('id','id_programacion','id_empleado','fecha_inicio','fecha_fin','created_at','cerrado','observacion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_programacion' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_empleado' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'fecha_inicio' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'fecha_fin' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'cerrado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'observacion' => array(
                        array( 'optional' ),
                )
            );
    }

}