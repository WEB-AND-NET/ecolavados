<?php
Doo::loadCore('db/DooModel');

class RequestLogBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $email_subject;

    /**
     * @var text
     */
    public $email_body;

    /**
     * @var text
     */
    public $invoice_description;

    /**
     * @var int Max length is 11.
     */
    public $id_request;

    public $_table = 'request_log';
    public $_primarykey = 'id';
    public $_fields = array('id','email_subject','email_body','invoice_description','id_request');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'email_subject' => array(
                        array( 'optional' ),
                ),

                'email_body' => array(
                        array( 'optional' ),
                ),

                'invoice_description' => array(
                        array( 'optional' ),
                ),

                'id_request' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                )
            );
    }

}