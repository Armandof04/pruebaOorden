<?php
namespace prueba\Controllers;
use prueba\Models as Modelos;
use Phalcon\Queue\Beanstalk\Extended as BeanstalkExtended;

class UsuariosController extends \Phalcon\Mvc\Controller
{
     /**
     * function indexAction
     * muestro el contido de la tabla Usuarios
     * @return void
     */

    public function indexAction()
    {
        $this->view->setVar("listaUsuarios", Modelos\Usuarios::find(["cache"=>["key"=>"cacheUs"]]));// Manda llamar un metodo static
    }

    /**
     * function addAction
     * agrega el usuario a la base de datos Usuarios
     * @return void
     */

    public function addAction()
    {
    	
    	//recupero los datos enviados por el formulario
    	if($this->request->isPost())
    	{    				
            // Recibo la variable agregando que tipo es
    	    $usuario_id =$this->request->getPost('usuario_id','string');
			$email =$this->request->getPost('email','string');
		    $nombre =$this->request->getPost('nombre','string');
		    $password =$this->request->getPost('password','string');
		    $activo =$this->request->getPost('activo','string');
		    $fecha_registro =$this->request->getPost('fecha_registro','string');
		    $fecha_login =$this->request->getPost('fecha_login','string');
		    $intento_de_session =$this->request->getPost('intento_de_session','string');
		    $ultimo_intento_session =$this->request->getPost('ultimo_intento_session','string');
		    $tiempo_session =$this->request->getPost('tiempo_session','string');
		    $usuario_activacion_key =$this->request->getPost('usuario_activacion_key','string');
		    $usuario_activacoin_email =$this->request->getPost('usuario_activacoin_email','string');
		    $usuario_activacoin_contrasena =$this->request->getPost('usuario_activacoin_contrasena','string');
    			
   			//como voy a crear un nuevo registro tengo que crear una nueva instancia
   			//si realizo una actualizacion no es necesario crea una nueva instancia
   			$usuarios = new Modelos\Usuarios();

   			//al campo nombre_legal se le asigna el valor de $nombre
   			$usuarios->usuario_id= $usuario_id;
   			$usuarios->email= $email;
   			$usuarios->nombre= $nombre;
   			$usuarios->password= $password;
   			$usuarios->activo= $activo;
   			$usuarios->fecha_registro= $fecha_registro;
   			$usuarios->fecha_login= $fecha_login;
   			$usuarios->intento_de_session= $intento_de_session;
   			$usuarios->ultimo_intento_session= $ultimo_intento_session;
   			$usuarios->tiempo_session= $tiempo_session;
   			$usuarios->usuario_activacion_key= $usuario_activacion_key;
   			$usuarios->usuario_activacoin_email= $usuario_activacoin_email;
   			$usuarios->usuario_activacoin_contrasena= $usuario_activacoin_contrasena;

    	    //guardo la  datos recibidos del formulario
    		if($usuarios->save())
    		{
    			echo 'si se guardo';
    		    return $this->dispatcher->forward(['action'=>'index']);
    		}
    		else
			{
   				echo 'No se guardo<br>';
  				//print_r($organizacion->getMessages());

   	           //Creo un arreglo para que me muestre todos los errores
   				foreach ($usuarios->getMessages() as $error) 
   				{
   					echo "error: ". $error.'<br>';
   				}
   			}	 			
    			die();
   		}
   	}

    /**
    * function editAction
    * Modifica el usuario de la bd
    * @param $id varchar recibe la id del usuario a modificar
    * @return regresa al index
    */

    public function editAction($id)
    {
        if($infoRecord = Modelos\Usuarios::findFirst($id))
        {
    	   $this->view->setVar('viewRecord', $infoRecord);
    		
            if($this->request->isPost())
    		{
    			if ($this->security->checkToken())
    			{
    				//compruebo que el token se reciba correctamente
    				//print_r($this->security->checkToken());
    				//die();
    				//The token is ok
                     
    				$infoRecord->usuario_id =$this->request->getPost('usuario_id','string');
    				$infoRecord->email =$this->request->getPost('email','string');
    				$infoRecord->nombre =$this->request->getPost('nombre','string');
    				$infoRecord->password =$this->request->getPost('password','string');
    				$infoRecord->activo =$this->request->getPost('activo','string');
    		     	$infoRecord->fecha_registro =$this->request->getPost('fecha_registro','string');
    				$infoRecord->fecha_login =$this->request->getPost('fecha_login','string');
    				$infoRecord->intento_de_session =$this->request->getPost('intento_de_session','string');
    				$infoRecord->ultimo_intento_session =$this->request->getPost('ultimo_intento_session','string');
    				$infoRecord->tiempo_session =$this->request->getPost('tiempo_session','string');
    				$infoRecord->usuario_activacion_key =$this->request->getPost('usuario_activacion_key','string');
    				$infoRecord->usuario_activacoin_email =$this->request->getPost('usuario_activacoin_email','string');
    				$infoRecord->usuario_activacoin_contrasena =$this->request->getPost('usuario_activacoin_contrasena','string');
    					
    			   if($infoRecord->save())
    				{
    				   return $this->dispatcher->forward(['action'=>'index']);
    				}
    				else
    				{
    				   print_r($infoRecord->getMessages()); die();
    				}
    			}
    		} 
        }
	}

    /**
    * function deleteAction
    * Elimina el usuario de la bd
    * @param $id varchar recibe la id del usuario a eliminar
    * @return regresa al index
    */

   	public function deleteAction($id)
   	{
    	if($record = Modelos\Usuarios::findFirst($id))
    	{
    		$this->view->setVar('mensaje', 'Eliminado');
    		if($record->delete())
    		{
    			return $this->dispatcher->forward(['action'=>'index']);
    		}
        	else 
            {
            	print_r($record->getMessages()); die();
        	}
        }
    }

    /**
    * function emailAction
    * envia un correo al usuario, el cual lo manda a un queue para poder enviar el correo en 2do plano, 
    * @param $id varchar recibe la id del usuario a enviar el correo
    * @param $email varchar correo del usuario
    * @return void
    */
       
    public function emailAction($id)
    {
        if($usuario = Modelos\Usuarios::findFirst($id))
        {
            $this->view->setVar('mostrar', $usuario);
        }
        
        if($this->request->isPost())
        {               
        //recibo la variable agregando que tipo es
        $email =$this->request->getPost('email','string');
        $username =$this->request->getPost('username','string');
        $mensaje =$this->request->getPost('mensaje','string');
            
             
        $beanstalk = new BeanstalkExtended(array(
            'host'=> 'localHost',
            'prefix' => 'correos',
        ));

        // Guarde la información de envio de Email en la base de datos y enviarlo a post-proceso
        $beanstalk->putInTube('envioEmail', $email);

        //envio un correo de confirmacion al cliente,  
        //actualmente esta desactivado, ya que se envia el correo al tasks, mainTask
        /* if( $this->getDI()->getMail()->send
            (
                array($email => $email),
                'Correo',
                'confirmation',
                array( 'confirmUrl' => '/confirm/' . $email.'/'. $email)
            ) )
            {*/
                return $this->response->redirect('usuarios');
            // }
            }
          
        }

}

?>