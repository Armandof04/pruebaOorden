<?php
namespace prueba\Models;
class UsuarioPermisos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $usuario_id;

    /**
     *
     * @var integer
     */
    public $organizacion_id;

    /**
     *
     * @var string
     */
    public $permiso_id;



    public function initialize()
    {
       $this->belongsTo('organizacion_id', 'prueba\Models\Organizaciones', 'organizacion_id', ['alias' => 'Organizaciones']);
      $this->belongsTo('usuario_id', 'prueba\Models\Usuarios', 'usuario_id', ['alias' => 'Usuarios']);
    }

}
