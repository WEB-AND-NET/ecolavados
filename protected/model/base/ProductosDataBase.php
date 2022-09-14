<?php
Doo::loadCore('db/DooModel');

class ProductosDataBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_producto;

    /**
     * @var varchar Max length is 45.
     */
    public $dificultad;

    /**
     * @var text
     */
    public $caracteristicas;

    /**
     * @var text
     */
    public $mal;

    /**
     * @var text
     */
    public $problemas;

    /**
     * @var varchar Max length is 1.
     */
    public $use_vapor;

    /**
     * @var varchar Max length is 5.
     */
    public $t_max;

    /**
     * @var varchar Max length is 20.
     */
    public $interior;

    /**
     * @var varchar Max length is 20.
     */
    public $duracion;

    public $_table = 'productos_data';
    public $_primarykey = 'id';
    public $_fields = array('id','id_producto','dificultad','caracteristicas','mal','problemas','use_vapor','t_max','interior','duracion');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_producto' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'dificultad' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'caracteristicas' => array(
                        array( 'optional' ),
                ),

                'mal' => array(
                        array( 'optional' ),
                ),

                'problemas' => array(
                        array( 'optional' ),
                ),

                'use_vapor' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                't_max' => array(
                        array( 'maxlength', 5 ),
                        array( 'optional' ),
                ),

                'interior' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                ),

                'duracion' => array(
                        array( 'maxlength', 20 ),
                        array( 'optional' ),
                )
            );
    }

}