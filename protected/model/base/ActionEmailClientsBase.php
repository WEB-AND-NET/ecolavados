<?php
Doo::loadCore('db/DooModel');

class ActionEmailClientsBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_client;

    /**
     * @var int Max length is 11.
     */
    public $id_action_email;

    /**
     * @var text
     */
    public $email;

    public $_table = 'action_email_clients';
    public $_primarykey = 'id';
    public $_fields = array('id','id_client','id_action_email','email');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_client' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_action_email' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'email' => array(
                        array( 'optional' ),
                )
            );
    }

}