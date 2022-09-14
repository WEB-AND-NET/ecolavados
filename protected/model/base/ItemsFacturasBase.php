<?php
Doo::loadCore('db/DooModel');

class ItemsFacturasBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $id_entrada;

    /**
     * @var text
     */
    public $service;

    /**
     * @var text
     */
    public $description;

    /**
     * @var varchar Max length is 200.
     */
    public $wo;

    /**
     * @var int Max length is 11.
     */
    public $quantity;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $price;

    /**
     * @var decimal Max length is 11. ,2).
     */
    public $total;

    /**
     * @var varchar Max length is 45.
     */
    public $n_facture;

    /**
     * @var varchar Max length is 45.
     */
    public $amortizacion;

    /**
     * @var date
     */
    public $minimo;

    /**
     * @var varchar Max length is 45.
     */
    public $tipo;

    /**
     * @var varchar Max length is 45.
     */
    public $closed;
    
    public $id_item_request;

    public $_table = 'items_facturas';
    public $_primarykey = 'id';
    public $_fields = array('id','id_entrada','service','description','wo','quantity','price','total','n_facture','amortizacion','minimo','tipo','closed','id_item_request');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'id_entrada' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'service' => array(
                        array( 'optional' ),
                ),

                'description' => array(
                        array( 'optional' ),
                ),

                'wo' => array(
                        array( 'maxlength', 200 ),
                        array( 'optional' ),
                ),

                'quantity' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'price' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'total' => array(
                        array( 'float' ),
                        array( 'optional' ),
                ),

                'n_facture' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'amortizacion' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'minimo' => array(
                        array( 'date' ),
                        array( 'optional' ),
                ),

                'tipo' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                ),

                'closed' => array(
                        array( 'maxlength', 45 ),
                        array( 'optional' ),
                )
            );
    }

}