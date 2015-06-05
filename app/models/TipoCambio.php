<?php
namespace prueba\Models;

class TipoCambio extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $fuente;

    /**
     *
     * @var string
     */
    public $moneda_origen;

    /**
     *
     * @var double
     */
    public $monto_origen;

    /**
     *
     * @var string
     */
    public $moneda_destino;

    /**
     *
     * @var double
     */
    public $monto_destino;

    /**
     *
     * @var string
     */
    public $fecha;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'fuente' => 'fuente', 
            'moneda_origen' => 'moneda_origen', 
            'monto_origen' => 'monto_origen', 
            'moneda_destino' => 'moneda_destino', 
            'monto_destino' => 'monto_destino', 
            'fecha' => 'fecha'
        );
    }

}
