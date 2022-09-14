<?php
Doo::loadCore('db/DooModel');

class RolesBase extends DooModel{

    /**
     * @var tinyint Max length is 2.
     */
    public $id;

    /**
     * @var varchar Max length is 40.
     */
    public $role;

    /**
     * @var varchar Max length is 200.
     */
    public $descripcion;

    public $_table = 'roles';
    public $_primarykey = 'id';
    public $_fields = array('id','role','descripcion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'role' => array(
                        array( 'maxlength', 40 ),
                        array( 'notnull' ),
                ),

                'descripcion' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                )
            );
    }

}