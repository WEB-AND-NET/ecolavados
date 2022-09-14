<?php
Doo::loadCore('db/DooModel');

class ProgramacionBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var datetime
     */
    public $fecha_inicio;

    /**
     * @var datetime
     */
    public $fecha_fin;

    /**
     * @var int Max length is 11.
     */
    public $request_activity;

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

    /**
     * @var int Max length is 11.
     */
    public $proceso;

    /**
     * @var varchar Max length is 100.
     */
    public $observacion;

    public $_table = 'programacion';
    public $_primarykey = 'id';
    public $_fields = array('id','id_entrada','fecha_inicio','fecha_fin','request_activity','deleted','created_at','update_at','proceso','observacion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
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

                'request_activity' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
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
                ),

                'proceso' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'observacion' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                )
            );
    }

}