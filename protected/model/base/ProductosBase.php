<?php
Doo::loadCore('db/DooModel');

class ProductosBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 300.
     */
    public $nombre;

    /**
     * @var int Max length is 11.
     */
    public $cantidad;

    /**
     * @var varchar Max length is 45.
     */
    public $unidad_medida;

    /**
     * @var int Max length is 10.
     */
    public $tipo;

    /**
     * @var varchar Max length is 45.
     */
    public $precio_compra;

    /**
     * @var varchar Max length is 2.
     */
    public $para_paquetes;

    /**
     * @var datetime
     */
    public $update_at;

    /**
     * @var datetime
     */
    public $create_at;

    /**
     * @var char Max length is 1.
     */
    public $deleted;

    /**
     * @var int Max length is 11.
     */
    public $grupo;

    /**
     * @var text
     */
    public $description;

    public $_table = 'productos';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','cantidad','unidad_medida','tipo','precio_compra','para_paquetes','update_at','create_at','deleted','grupo','description');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 300 ),
                        array( 'optional' ),
                ),

                'cantidad' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'unidad_medida' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 10 ),
                        array( 'optional' ),
                ),

                'precio_compra' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'para_paquetes' => array(
                        array( 'maxlength', 2 ),
                        array( 'optional' ),
                ),

                'update_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'create_at' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 1 ),
                        array( 'optional' ),
                ),

                'grupo' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'description' => array(
                        array( 'optional' ),
                )
            );
    }

}