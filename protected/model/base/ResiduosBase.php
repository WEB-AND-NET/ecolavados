<?php
Doo::loadCore('db/DooModel');

class ResiduosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 10.  unsigned.
     */
    public $id_entrada;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $volumen;

    /**
     * @var char Max length is 1.
     */
    public $facturar;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $update_at;

    public $_table = 'residuos';
    public $_primarykey = 'id';
    public $_fields = array('id','id_entrada','volumen','facturar','created_at','update_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'volumen' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'facturar' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}