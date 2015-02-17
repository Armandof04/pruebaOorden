<?php

namespace prueba\Controllers;
use prueba\Models as Modelos;

class OrganizacionesController extends \Phalcon\Mvc\Controller
{
    /**
    * function indexAction
    * muestro el contido de la tabla Organizaciones
    * @return void
    */
    public function indexAction()
    {
        //Manda llamar un metodo static
       $this->view->setVar("listaOrganizaciones", Modelos\Organizaciones::find(["cache"=>["key"=>"modelsCache"]]));
    }

    /**
    * function addAction
    * agrega el usuario a la base de datos Usuarios
    * @return void
    */
    
    public function addAction()
    {
    		
    	//if(count($_POST)>=1)
    	//print_r($_POST); die();

    	// recupero los datos enviados por el formulario
    	if($this->request->isPost())
    	{    

            if ($this->security->checkToken())
            {  

                //The token is ok			
            	//recibo la variable agregando que tipo es          		
            	$organizacion_id =$this->request->getPost('organizacion_id','string');
        		$nombre_corto =$this->request->getPost('nombre_corto','string');
        		$nombre_legal =$this->request->getPost('nombre_legal','string');
        		$pais_id =$this->request->getPost('pais_id','string');
        		$logo =$this->request->getPost('logo','string');
        		$tipo_id =$this->request->getPost('tipo_id','string');
        		$id_zona_horaria =$this->request->getPost('id_zona_horaria','string');
        		$direccion_fiscal =$this->request->getPost('direccion_fiscal','string');
        		$direccion_fisica =$this->request->getPost('direccion_fisica','string');
        		$telefono =$this->request->getPost('telefono','string');
        		$email =$this->request->getPost('email','string');
        		$moneda_base =$this->request->getPost('moneda_base_id','string');
        		$multimoneda =$this->request->getPost('multimoneda','string');
        		$fin_ano =$this->request->getPost('fin_ano_fiscal','string');
        		$base_impuesto =$this->request->getPost('base_impuesto','string');
        		$clave_fiscal =$this->request->getPost('clave_fiscal','string');
        		$nombre_clave =$this->request->getPost('nombre_clave_fiscal_id','string');
        		$formato_cuentas =$this->request->getPost('formato_cuentas','string');
        		$periodo_fiscal =$this->request->getPost('periodo_fiscal_id','string');
        		$fecha_bloqueo_general =$this->request->getPost('fecha_bloqueo_general','string');
        		$fecha_bloqueo_restringido =$this->request->getPost('fecha_bloqueo_restringido','string');
        		$ccosto_1 =$this->request->getPost('nombre_ccosto_1','string');
        		$ccosto_2 =$this->request->getPost('nombre_ccosto_2','string');
       	
            	//	echo $nombre;die();

            	// como voy a crear un nuevo registro tengo que crear una nueva instancia
            	// si realizo una actualizacion no es necesario crea una nueva instancia
            	$organizacion = new  Modelos\Organizaciones();

            	//al campo nombre_legal se le asigna el valor de $nombre
            	$organizacion->organizacion_id= $organizacion_id;
            	$organizacion->nombre_corto= $nombre_corto;
        		$organizacion->nombre_legal= $nombre_legal;
        		$organizacion->pais_id= $pais_id;
        		$organizacion->logo= $logo;
           		$organizacion->tipo_id= $tipo_id;
           		$organizacion->id_zona_horaria= $id_zona_horaria;
           		$organizacion->direccion_fiscal= $direccion_fiscal;
           		$organizacion->direccion_fisica= $direccion_fisica;
           		$organizacion->telefono= $telefono;
           		$organizacion->email= $email;
           		$organizacion->moneda_base_id= $moneda_base;
           		$organizacion->multimoneda= $multimoneda;
           		$organizacion->fin_ano_fiscal= $fin_ano;
           		$organizacion->base_impuesto= $base_impuesto;
           		$organizacion->clave_fiscal= $clave_fiscal;
           		$organizacion->nombre_clave_fiscal_id= $nombre_clave;
           		$organizacion->formato_cuentas= $formato_cuentas;
           		$organizacion->periodo_fiscal_id= $periodo_fiscal;
           		$organizacion->fecha_bloqueo_general= $fecha_bloqueo_general;
           		$organizacion->fecha_bloqueo_restringido= $fecha_bloqueo_restringido;
           		$organizacion->nombre_ccosto_1= $ccosto_1;
           		$organizacion->nombre_ccosto_2= $ccosto_2;

           		//guardo la  datos recibidos del formulario
           		if($organizacion->save())
           		{
           			echo 'si se guardo';
           				
           			return $this->dispatcher->forward(['action'=>'index']);
           		}
           		else
       	    	{
       	    	    echo 'No se guardo<br>';
       	    		//print_r($organizacion->getMessages());
        	    	    
                    //Creo un arreglo para que me muestre todos los errores
       	    		foreach ($organizacion->getMessages() as $error) 
       	    		{
       	    			echo "error: ". $error.'<br>';
       	    		}
       	    	}
       	 	}	
    		//	die();
    	}
    }

    /**
    * function editAction
    * Modifica la organizacion de la bd
    * @param $id varchar recibe la id de la organizacion a modificar
    * @return void
    */

    public function editAction($id)
    {
    	if($infoRecord =  Modelos\Organizaciones::findFirst($id))
    	{
    		$this->view->setVar('viewRecord', $infoRecord);
            if($this->request->isPost())
            {
                if ($this->security->checkToken())
                {  
                    $organizacion_id =$this->request->getPost('organizacion_id','string');
                    $infoRecord->nombre_corto =$this->request->getPost('nombre_corto','string');
                    $infoRecord->nombre_legal =$this->request->getPost('nombre_legal','string');
                    $infoRecord->pais_id =$this->request->getPost('pais_id','string');
                    $infoRecord->logo =$this->request->getPost('logo','string');
                    $infoRecord->tipo_id =$this->request->getPost('tipo_id','string');
                    $infoRecord->id_zona_horaria =$this->request->getPost('id_zona_horaria','string');
                    $infoRecord->direccion_fiscal =$this->request->getPost('direccion_fiscal','string');
                    $infoRecord->direccion_fisica =$this->request->getPost('direccion_fisica','string');
                    $infoRecord->telefono =$this->request->getPost('telefono','string');
                    $infoRecord->email =$this->request->getPost('email','string');
                    $infoRecord->moneda_base =$this->request->getPost('moneda_base_id','string');
                    $infoRecord->multimoneda =$this->request->getPost('multimoneda','string');
                    $infoRecord->fin_ano =$this->request->getPost('fin_ano_fiscal','string');
                    $infoRecord->base_impuesto =$this->request->getPost('base_impuesto','string');
                    $infoRecord->clave_fiscal =$this->request->getPost('clave_fiscal','string');
                    $infoRecord->nombre_clave =$this->request->getPost('nombre_clave_fiscal_id','string');
                    $infoRecord->formato_cuentas =$this->request->getPost('formato_cuentas','string');
                    $infoRecord->periodo_fiscal =$this->request->getPost('periodo_fiscal_id','string');
                    $infoRecord->fecha_bloqueo_general =$this->request->getPost('fecha_bloqueo_general','string');
                    $infoRecord->fecha_bloqueo_restringido =$this->request->getPost('fecha_bloqueo_restringido','string');
                    $infoRecord->ccosto_1 =$this->request->getPost('nombre_ccosto_1','string');
                    $infoRecord->ccosto_2 =$this->request->getPost('nombre_ccosto_2','string');

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
    * Modifica la organizacion de la bd
    * @param $id varchar recibe la id de la organizacion a eliminar
    * @return void
    */

    public function deleteAction($id)
    {
		  if($record =  Modelos\Organizaciones::findFirst($id))
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

