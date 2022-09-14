<?php
Doo::loadCore('db/DooModel');

class CalidadBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 45.
     */
    public $id_entrada;

    /**
     * @var varchar Max length is 45.
     */
    public $id_programacion;

    /**
     * @var varchar Max length is 45.
     */
    public $exterior;

    /**
     * @var varchar Max length is 45.
     */
    public $interior;

    /**
     * @var varchar Max length is 45.
     */
    public $valves;

    /**
     * @var varchar Max length is 45.
     */
    public $stains;

    /**
     * @var varchar Max length is 45.
     */
    public $surfaces;

    /**
     * @var varchar Max length is 45.
     */
    public $pitting;

    /**
     * @var longtext
     */
    public $area;

    /**
     * @var longtext
     */
    public $front;

    /**
     * @var longtext
     */
    public $rear;

    /**
     * @var text
     */
    public $observation;

    /**
     * @var datetime
     */
    public $date_init;

    /**
     * @var datetime
     */
    public $date_end;

    public $_table = 'calidad';
    public $_primarykey = 'id';
    public $_fields = array('id','id_entrada','id_programacion','exterior','interior','valves','stains','surfaces','pitting','area','front','rear','observation','date_init','date_end');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'id_programacion' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'exterior' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'interior' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'valves' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'stains' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'surfaces' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'pitting' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'area' => array(
                        array( 'optional' ),
                ),

                'front' => array(
                        array( 'optional' ),
                ),

                'rear' => array(
                        array( 'optional' ),
                ),

                'observation' => array(
                        array( 'optional' ),
                ),

                'date_init' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'date_end' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                )
            );
    }

}