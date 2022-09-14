<?php
Doo::loadCore('db/DooModel');

class RolesOpcionesBase extends DooModel{

    /**
     * @var tinyint Max length is 2.
     */
    public $role_id;

    /**
     * @var varchar Max length is 5.
     */
    public $opcion;

    /**
     * @var char Max length is 1.
     */
    public $acceso;

    public $_table = 'roles_opciones';
    public $_primarykey = 'opcion';
    public $_fields = array('role_id','opcion','acceso');

    public function getVRules() {
        return array(
                'role_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'opcion' => array(
                        array( 'maxlength', 5 ),
                        array( 'notnull' ),
                ),

                'acceso' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}