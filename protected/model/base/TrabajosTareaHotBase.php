<?php
Doo::loadCore('db/DooModel');

class TrabajosTareaHotBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_trabajo;

    /**
     * @var int Max length is 11.
     */
    public $id_tarea_principal;

    /**
     * @var int Max length is 11.
     */
    public $id_tarea;

    /**
     * @var varchar Max length is 45.
     */
    public $deleted;

    /**
     * @var timestamp
     */
    public $create_time;

    /**
     * @var timestamp
     */
    public $update_time;

    public $_table = 'trabajos_tarea_hot';
    public $_primarykey = 'id';
    public $_fields = array('id','id_trabajo','id_tarea_principal','id_tarea','deleted','create_time','update_time');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_trabajo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_tarea_principal' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_tarea' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'create_time' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'update_time' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}