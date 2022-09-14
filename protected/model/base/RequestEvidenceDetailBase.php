<?php
Doo::loadCore('db/DooModel');

class RequestEvidenceDetailBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_request_evidence;

    /**
     * @var varchar Max length is 100.
     */
    public $image;

    /**
     * @var datetime
     */
    public $description;

    public $_table = 'request_evidence_detail';
    public $_primarykey = 'id';
    public $_fields = array('id','id_request_evidence','image','description');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_request_evidence' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'image' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'description' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}