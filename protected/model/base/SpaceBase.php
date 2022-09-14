<?php
Doo::loadCore('db/DooModel');

class SpaceBase extends DooModel{

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
     * @var text
     */
    public $firma_empleado_autoriza;

    /**
     * @var text
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
     * @var char Max length is 1.
     */
    public $informado;

    /**
     * @var char Max length is 1.
     */
    public $medidor_calibrado;

    /**
     * @var char Max length is 1.
     */
    public $atmosfera;

    /**
     * @var varchar Max length is 5.
     */
    public $ch4;

    /**
     * @var varchar Max length is 5.
     */
    public $h2s;

    /**
     * @var varchar Max length is 5.
     */
    public $c2;

    /**
     * @var varchar Max length is 5.
     */
    public $co;

    /**
     * @var varchar Max length is 45.
     */
    public $otro;

    /**
     * @var varchar Max length is 2.
     */
    public $riesgos_otros;

    /**
     * @var varchar Max length is 2.
     */
    public $otros_riesgos;

    public $_table = 'space';
    public $_primarykey = 'id';
    public $_fields = array('id','consecutivo','id_trabajo','id_empleado_autoriza','id_empleado_autorizado','firma_empleado_autoriza','firma_empleado_autorizado','hora_inicio','hora_final','status','deleted','created_at','informado','medidor_calibrado','atmosfera','ch4','h2s','c2','co','otro','riesgos_otros','otros_riesgos');

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

                'informado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'medidor_calibrado' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'atmosfera' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'ch4' => array(
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'h2s' => array(
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'c2' => array(
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'co' => array(
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'otro' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'riesgos_otros' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'otros_riesgos' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                )
            );
    }

}