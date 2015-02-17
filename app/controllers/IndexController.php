<?php
 namespace prueba\Controllers;
 use prueba\Models as Modelos;

class IndexController extends ControllerBase
{
   
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