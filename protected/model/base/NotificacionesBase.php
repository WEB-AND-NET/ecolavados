<?php
Doo::loadCore('db/DooModel');

class NotificacionesBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $notificacion;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var char Max length is 1.
     */
    public $leida;

    /**
     * @var datetime
     */
    public $create;

    public $_table = 'notificaciones';
    public $_primarykey = 'id';
    public $_fields = array('id','notificacion','id_entrada','leida','create');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'notificacion' => array(
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'leida' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'create' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}