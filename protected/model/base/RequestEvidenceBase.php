<?php
Doo::loadCore('db/DooModel');

class RequestEvidenceBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var int Max length is 11.
     */
    public $id_request;

    /**
     * @var varchar Max length is 45.
     */
    public $id_programacion;

    /**
     * @var text
     */
    public $observacion;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $updated_at;

    public $_table = 'request_evidence';
    public $_primarykey = 'id';
    public $_fields = array('id','id_entrada','id_request','id_programacion','observacion','created_at','updated_at');

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

                'id_request' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_programacion' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'observacion' => array(
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}