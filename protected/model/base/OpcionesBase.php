<?php
Doo::loadCore('db/DooModel');

class OpcionesBase extends DooModel{

    /**
     * @var varchar Max length is 5.
     */
    public $codigo;

    /**
     * @var varchar Max length is 60.
     */
    public $menuitem;

    /**
     * @var varchar Max length is 5.
     */
    public $depende;

    /**
     * @var char Max length is 1.
     */
    public $submenu;

    /**
     * @var varchar Max length is 50.
     */
    public $url;

    /**
     * @var varchar Max length is 50.
     */
    public $toolbar;

    /**
     * @var tinyint Max length is 2.
     */
    public $orden;

    public $_table = 'opciones';
    public $_primarykey = 'codigo';
    public $_fields = array('codigo','menuitem','depende','submenu','url','toolbar','orden');

    public function getVRules() {
        return array(
                'codigo' => array(
                        array( 'maxlength', 5 ),
                        array( 'notnull' ),
                ),

                'menuitem' => array(
                        array( 'maxlength', 60 ),
                        array( 'notnull' ),
                ),

                'depende' => array(
                        array( 'maxlength', 5 ),
                        array( 'notnull' ),
                ),

                'submenu' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'url' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'toolbar' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'orden' => array(
                        array( 'integer' ),
                        array( 'maxlength', 2 ),
                        array( 'notnull' ),
                )
            );
    }

}