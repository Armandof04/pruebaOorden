<?php

namespace prueba\Controllers;
use prueba\Models as Modelos;

class OrganizacionesController extends \Phalcon\Mvc\Controller
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
    * muestro el contido de la tabla Organizaciones
    * @return void
    */
    public function indexAction()
    {
        //Manda llamar un metodo static
       $this->view->setVar("listaOrganizaciones", Modelos\Organizaciones::find(["cache"=>["key"=>"modelsCache"]]));
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

