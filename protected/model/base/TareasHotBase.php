<?php
Doo::loadCore('db/DooModel');

class TareasHotBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 500.
     */
    public $nombre;

    /**
     * @var varchar Max length is 1.
     */
    public $principal;

    /**
     * @var varchar Max length is 3.
     */
    public $numero;

    /**
     * @var varchar Max length is 10.
     */
    public $defaul;

    /**
     * @var datetime
     */
    public $create_at;

    public $_table = 'tareas_hot';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','principal','numero','defaul','create_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 500 ),
                        array( 'optional' ),
                ),

                'principal' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'numero' => array(
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'defaul' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'create_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}