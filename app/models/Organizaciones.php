<?php
namespace prueba\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class Organizaciones extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $organizacion_id;

    /**
     *
     * @var string
     */
    public $nombre_corto;

    /**
     *
     * @var string
     */
    public $nombre_legal;

    /**
     *
     * @var integer
     */
    public $pais_id;

    /**
     *
     * @var string
     */
    public $logo;

    /**
     *
     * @var integer
     */
    public $tipo_id;

    /**
     *
     * @var integer
     */
    public $id_zona_horaria;

    /**
     *
     * @var string
     */
    public $direccion_fiscal;

    /**
     *
     * @var string
     */
    public $direccion_fisica;

    /**
     *
     * @var string
     */
    public $telefono;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var integer
     */
    public $moneda_base_id;

    /**
     *
     * @var integer
     */
    public $multimoneda;

    /**
     *
     * @var string
     */
    public $fin_ano_fiscal;

    /**
     *
     * @var string
     */
    public $base_impuesto;

    /**
     *
     * @var string
     */
    public $clave_fiscal;

    /**
     *
     * @var integer
     */
    public $nombre_clave_fiscal_id;

    /**
     *
     * @var string
     */
    public $formato_cuentas;

    /**
     *
     * @var integer
     */
    public $periodo_fiscal_id;

    /**
     *
     * @var string
     */
    public $fecha_bloqueo_general;

    /**
     *
     * @var string
     */
    public $fecha_bloqueo_restringido;

    /**
     *
     * @var string
     */
    public $nombre_ccosto_1;

    /**
     *
     * @var string
     */
    public $nombre_ccosto_2;

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

     public function initialize()
      {
        $this->hasMany('organizacion_id', 'prueba\Models\Sucursales', 'organizacion_id',  ['alias' => 'Sucursales']);
        $this->hasMany('organizacion_id', 'prueba\Models\UsuarioPermisos', 'organizacion_id',  ['alias' => 'UsuarioPermisos']);
      }

}

