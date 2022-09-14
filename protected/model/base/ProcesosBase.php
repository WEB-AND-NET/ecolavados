<?php
Doo::loadCore('db/DooModel');

class ProcesosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 100.
     */
    public $nombre;

    /**
     * @var varchar Max length is 1.
     */
    public $certificate;

    /**
     * @var datetime
     */
    public $create_at;

    /**
     * @var datetime
     */
    public $update_at;

    /**
     * @var varchar Max length is 1.
     */
    public $deleted;

    public $_table = 'procesos';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','certificate','create_at','update_at','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'certificate' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'create_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}