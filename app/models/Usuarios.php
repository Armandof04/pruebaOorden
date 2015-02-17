<?php
namespace prueba\Models;
use Phalcon\Mvc\Model\Validator\Email as Email;

class Usuarios extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $usuario_id;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $activo;

    /**
     *
     * @var string
     */
    public $fecha_registro;

    /**
     *
     * @var string
     */
    public $fecha_login;

    /**
     *
     * @var integer
     */
    public $intento_de_session;

    /**
     *
     * @var integer
     */
    public $ultimo_intento_de_session;

    /**
     *
     * @var integer
     */
    public $tiempo_session;

    /**
     *
     * @var string
     */
    public $usuario_activacion_key;

    /**
     *
     * @var string
     */
    public $usuario_activacoin_email;

    /**
     *
     * @var string
     */
    public $usuario_activacoin_contrasena;

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
        $this->hasMany('usuario_id', 'prueba\Models\UsuarioPermisos', 'usuario_id', ['alias' => 'UsuariosPermisos']);
      }
}
