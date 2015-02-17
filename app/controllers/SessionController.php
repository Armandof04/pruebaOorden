<?php
 namespace prueba\Controllers;
 use prueba\Models as Modelos;


class SessionController extends ControllerBase
{
	public function indexAction()
    {   

	}

    /**
    * function startAction
    * inicia la sesion para logueo y recordatorio de usuario,
    * @param $usuario_id varchar recibe el id del usuario para iniciar sesion 
    * @param $password varchar recibe el password del usuario para iniciar sesion
    * @param $cookie varchar recibe 1 si el usuario quiere recordar login
    * @return void
    */
    public function startAction()
    {

        if ($this->request->isPost()) 
        {
            //Recibir los datos ingresados por el usuario
            $usuario_id = $this->request->getPost('usuario_id');
            $password = $this->request->getPost('password');
            $cookie = $this->request->getPost('cookie');

            //encripto password (no requerido)
            //$password = sha1($password);

            

            //Buscar el usuario en la base de datos
            $user = Modelos\Usuarios::findFirst([
                "usuario_id = :usuario_id: AND password = :password: AND activo = 'Y'",
                "bind" => array('usuario_id' => $usuario_id, 'password' => $password)
            ]);

           


            if ($user != false) 
            {   
                if($cookie == 1)
                {
                    //creamos la cookie remember-me y le damos 15 días de vida
                    $this->cookies->set('remember-me', $usuario_id, time() + 15 * 86400);
                }
                
                $this->session->set("username", $usuario_id);
             	$this->flash->success('Welcome '.$usuario_id);
                 //Redireccionar la ejecución si el usuario es valido
                return $this->response->redirect('index');
                die();
            }
            $this->flash->error('Wrong email/password');

                
        }
        else if ($this->cookies->has('remember-me'))  //Comprobamos si existe la cookie
        {
            $rememberMe = $this->cookies->get('remember-me'); //obtenemos la cookie  
            $value = $rememberMe->getValue(); //obtenemos el valor de la cookie
            $this->session->set("username", $value);
            $this->flash->success('Welcome '.$value);
            return $this->response->redirect('index'); //Redireccionar la ejecución si el usuario es valido
            die();
        }

        //Redireccionar a el forma de login nuevamente
        return $this->dispatcher->forward(array(
            'controller' => 'session',
            'action' => 'index'
        ));

    
    }



    /**
    * function removeAction
    * elimina la sesión username
    * @return void
    */
    public function removeAction()
    {
        //Remove a session variable
        $this->session->remove("username");
        $this->flash->success('Goodbye!');
        return $this->dispatcher->forward(['action'=>'index']);
    }
    
    /**
    * function removeAction
    * destruye todas las sesiones
    * @return void
    */
    public function destroyAction()
    {
        if($this->session->destroy())
        {
            //si existe la cookie la elimina
            if ($this->cookies->has('remember-me')) 
            {
                $this->cookies->set('remember-me', '', time() - 42000, '/');
            }
            $this->flash->success('Goodbye!');
            return $this->dispatcher->forward(['action'=>'index']);
        }

        else
        {
            echo "Hubo un error al procesar la petición, la sesion no cerro correctamente";
            die();
        }
    }

    
}

