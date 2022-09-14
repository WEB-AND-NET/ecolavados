<?php
Doo::loadCore('db/DooModel');

class UnidadesMedidaBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $nombre;

    /**
     * @var varchar Max length is 45.
     */
    public $acronimo;

    /**
     * @var varchar Max length is 45.
     */
    public $deleted;

    public $_table = 'unidades_medida';
    public $_primarykey = 'id';
    public $_fields = array('id','nombre','acronimo','deleted');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nombre' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'acronimo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'deleted' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}