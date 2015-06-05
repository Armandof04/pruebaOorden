<?php
 namespace prueba\Controllers;
 use prueba\Models as Modelos;

class IndexController extends ControllerBase
{

    /**
     * Default action. Set the private (authenticated) layout (layouts/private.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('private');
    }
   
    /**
    * function indexAction
    * Me permite ingresar al views index, si el usuario inicio sesion
    * @param $username varchar es el nombre del usuario que inicio sesion
    * @return void
    */
    public function indexAction()
    {	
    	if($this->session->has("username"))
   		{
       		if($usuario =  Modelos\Usuarios::findFirst($username))
            {
                $this->view->setVar('mostrarUsuario', $usuario);
            }    
        }
        else
        {
        	return $this->response->redirect('session');
        }


    } 		
}