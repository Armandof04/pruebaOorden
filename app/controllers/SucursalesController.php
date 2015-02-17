<?php
namespace prueba\Controllers;
use prueba\Models as Modelos;
class SucursalesController extends \Phalcon\Mvc\Controller
{

    /**
    * function indexAction
    * muestra la tabla Sucursales
    */
    public function indexAction()
    {
    	//Manda llamar un metodo static
    	$this->view->setVar("listaSucursales", Modelos\Sucursales::find(["cache"=>["key"=>"cacheSuc"]]));
    }

    /**
    * function addAction
    * agrega un nuevo registro en la tabla Sucursales
    * @return void
    */
    public function addAction()
    {
    	//recupero los datos enviados por el formulario
		if($this->request->isPost())
    	{    			
            if ($this->security->checkToken())
            {   
                //The token is ok
           		
            	$sucursal_id =$this->request->getPost('sucursal_id','string');
   			    $organizacion_id =$this->request->getPost('organizacion_id','string');
   			    $clave =$this->request->getPost('clave','string');
   			    $nombre =$this->request->getPost('nombre','string');
   			    $direccion =$this->request->getPost('direccion','string');
   			    $default =$this->request->getPost('default','string');
   			    $sucursalescol =$this->request->getPost('sucursalescol','string');
         		
            	//como voy a crear un nuevo registro tengo que crear una nueva instancia
            	//si realizo una actualizacion no es necesario crea una nueva instancia
            	$sucursales = new Modelos\Sucursales();
            	
                //al campo nombre_legal se le asigna el valor de $nombre
            	$sucursales->sucursal_id= $sucursal_id;
            	$sucursales->organizacion_id= $organizacion_id;
            	$sucursales->clave= $clave;
            	$sucursales->nombre= $nombre;
            	$sucursales->direccion= $direccion;
            	$sucursales->default= $default;
            	$sucursales->sucursalescol= $sucursalescol;

            	//guardo la  datos recibidos del formulario
            	if($sucursales->save())
            	{
            		echo 'si se guardo';
            		return $this->dispatcher->forward(['action'=>'index']);
            	}
            	else
        	    {
        	    	echo 'No se guardo<br>';
        	    	//print_r($organizacion->getMessages());
        	    
                    //Creo un arreglo para que me muestre todos los errores
        	    	foreach ($sucursales->getMessages() as $error) 
        	    	{
        	    		echo "error: ". $error.'<br>';
        	    	}
        	    }
        	 			
            }
            die();
    	}
    }

    /**
    * function editAction
    * modifica los valores del registro de la tabla Sucursales
    * @param $id varchar recibe la id del registro a modificar
    * @return void
    */
    public function editAction($id)
	{
   		if($infoRecord = Modelos\Sucursales::findFirst($id))
		{
			$this->view->setVar('viewRecord', $infoRecord);
			
            if ($this->security->checkToken())
			{   
                //The token is ok

				$infoRecord->sucursal_id =$this->request->getPost('sucursal_id','string');
				$infoRecord->organizacion_id =$this->request->getPost('organizacion_id','string');
				$infoRecord->clave =$this->request->getPost('clave','string');
				$infoRecord->nombre =$this->request->getPost('nombre','string');
				$infoRecord->direccion =$this->request->getPost('direccion','string');
				$infoRecord->default =$this->request->getPost('default','string');
                $infoRecord->sucursalescol =$this->request->getPost('sucursalescol','string');

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

    /**
    * function deleteAction
    * elimina un registro de la tabla Sucursales
    * @param $id varchar recibe la id del registro a eliminar
    * @return void
    */
   	public function deleteAction($id)
   	{
   		if($record = Modelos\Sucursales::findFirst($id))
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

}

