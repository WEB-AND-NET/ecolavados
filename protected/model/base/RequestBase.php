<?php
Doo::loadCore('db/DooModel');

class RequestBase extends DooModel{

    /**
     * @var int Max length is 11.  unsigned zerofill.
     */
    public $id;

    /**
     * @var text
     */
    public $descripcion;

    /**
     * @var int Max length is 11.
     */
    public $cliente_id;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var varchar Max length is 45.
     */
    public $state;

    /**
     * @var varchar Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $updated_at;

    /**
     * @var varchar Max length is 45.
     */
    public $created_at;

    /**
     * @var varchar Max length is 100.
     */
    public $img;

    public $_table = 'request';
    public $_primarykey = 'id';
    public $_fields = array('id','descripcion','cliente_id','id_entrada','state','deleted','updated_at','created_at','img');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'descripcion' => array(
                        array( 'optional' ),
                ),

                'cliente_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'state' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'img' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                )
            );
    }

}