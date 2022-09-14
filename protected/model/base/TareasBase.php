<?php
Doo::loadCore('db/DooModel');

class TareasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 2000.
     */
    public $nombre;

    /**
     * @var char Max length is 2.
     */
    public $numero;

    /**
     * @var char Max length is 1.
     */
    public $principal;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $updated_at;

    public $_table = 'tareas';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','numero','principal','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 2000 ),
                        array( 'optional' ),
                ),

                'numero' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'principal' => array(
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

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}