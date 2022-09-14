<?php
Doo::loadCore('db/DooModel');

class UsuariosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 20.
     */
    public $identificacion;

    /**
     * @var varchar Max length is 20.
     */
    public $usuario;

    /**
     * @var text
     */
    public $email;

    /**
     * @var varchar Max length is 300.
     */
    public $nombre;

    /**
     * @var varchar Max length is 40.
     */
    public $password;

    /**
     * @var tinyint Max length is 2.
     */
    public $role;

    /**
     * @var varchar Max length is 100.
     */
    public $imagen;

    /**
     * @var char Max length is 3.
     */
    public $tipo;

    /**
     * @var varchar Max length is 10.
     */
    public $dtype;

    /**
     * @var varchar Max length is 255.
     */
    public $dtoken;

    /**
     * @var varchar Max length is 255.
     */
    public $token_push;

    /**
     * @var int Max length is 10.
     */
    public $id_usuario;

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

    public $_table = 'usuarios';
    public $_primarykey = 'id';
    public $_fields = array('id','identificacion','usuario','email','nombre','password','role','imagen','tipo','dtype','dtoken','token_push','id_usuario','deleted','created_at','updated_at');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'identificacion' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'usuario' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'email' => array(
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 300 ),
                        array( 'notnull' ),
                ),

                'password' => array(
                        array( 'maxlength', 40 ),
                        array( 'notnull' ),
                ),

                'role' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                ),

                'imagen' => array(
                        array( 'maxlength', 100 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 3 ),
                        array( 'optional' ),
                ),

                'dtype' => array(
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'dtoken' => array(
                        array( 'maxlength', 255 ),
                        array( 'optional' ),
                ),

                'token_push' => array(
                        array( 'maxlength', 255 ),
                        array( 'optional' ),
                ),

                'id_usuario' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'created_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'updated_at' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                )
            );
    }

}