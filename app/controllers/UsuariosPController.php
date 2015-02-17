<?php

namespace prueba\Controllers;
use prueba\Models as Modelos;

class UsuariosPController extends \Phalcon\Mvc\Controller
{

    /**
    * function indexAction
    * muestra los registros de la tabla Usuario_Permisos 
    */

    public function indexAction()
    {
      	//Manda llamar un metodo static
       	$this->view->setVar("listaUsuarios", Modelos\UsuarioPermisos::find());
    }

    /**
    * function addAction
    * agrega un registro, regitrando el ID de organizacion al que corresponde
    * @param $id varchar recibe la id de la Organizacion al cual el usuario tendra permiso
    * @return void
    */
    public function addAction($id)
    {
        //Manda llamar un metodo static                                    
        $this->view->setVar("listaPermisos", Modelos\Usuarios::find());
    
        if($this->request->isPost())
        {               
            //recibo la variable agregando que tipo es                          
            $usuario_id =$this->request->getPost('usuario_id','string');
            $organizacion_id =$id;
    
            // como voy a crear un nuevo registro tengo que crear una nueva instancia
            // si realizo una actualizacion no es necesario crea una nueva instancia
        
            $usuarioPermisos = new Modelos\UsuarioPermisos();
            $usuarioPermisos->usuario_id= $usuario_id;
            $usuarioPermisos->organizacion_id= $organizacion_id;
        
            //guardo la  datos recibidos del formulario
            if($usuarioPermisos->save())
            {
                echo 'si se guardo';
                return $this->dispatcher->forward(['action'=>'index']);
            }
            else
            {
                echo 'No se guardo<br>';
                
                //Creo un arreglo para que me muestre todos los errores
                foreach ($usuarioPermisos->getMessages() as $error) 
                {
                    echo "error: ". $error.'<br>';
                }
            }
            die();
        }
                            
    }
    /**
    * function deleteAction
    * Elimina el permiso al usuario de la organizacion
    * @param $id varchar recibe la id del usuario que va a eliminar de la tabla permisos
    * @return void
    */
    public function deleteAction($id)
    {
        if($eliminar = UsuarioPermisos::findFirst($id))
        {
            $this->view->setVar('mensaje', 'Eliminado');

            if($eliminar->delete())
            {
                return $this->dispatcher->forward(['action'=>'index']);
            }
            else
            {
                print_r($eliminar->getMessages()); die();
            }
        }
    }

}

