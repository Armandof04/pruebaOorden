<?php

namespace prueba\Controllers;
use prueba\Models as Modelos;

class TipoCController extends \Phalcon\Mvc\Controller
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
    * muestra los registros de la tabla Usuario_Permisos 
    */

    public function indexAction()
    {
        //Manda llamar un metodo static
        $this->view->setVar("tipoCambio", Modelos\TipoCambio::find());
    }

    /**
    * function addAction
    * agrega un registro, regitrando el ID de organizacion al que corresponde
    * @param $id varchar recibe la id de la Organizacion al cual el usuario tendra permiso
    * @return void
    */
    public function addAction()
    {
           
              
      $url = 'http://www.banxico.org.mx/rsscb/rss?BMXC_canal=fix&BMXC_idioma=es'; 
      $xml = simpleXML_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA); 
      if($xml ===  FALSE) 
      { 
          echo "No se puede conectar con el servidor RSS";

      } 
      else 
      { 
         // print_r($xml);
        //MX: 15.4003 MXN = 1 USD 2015-03-12 BM FIX
          echo "\n".$xml->item->title."\n";
          $divisa_destino = substr($xml->item->title, 0, 2);
          $monto_destino = substr($xml->item->title, 4, 7); 

          $divisa_origen = substr($xml->item->title, -21, 3);
          $monto_origen = substr($xml->item->title, 18, 1);

          $fechaA = substr($xml->item->title, 24, 10);
     
          $fecha = strtotime ( '+1 day' , strtotime ( $fechaA ) ) ; //sumo un dia a la fecha, ya que el SAT los datos los obtiene del día anterior
          $fecha = date ( 'Y-m-j' , $fecha );

        //Verifico que no exista el tipo de cambio con las mismas divisas y fecha
          $consulta = Modelos\TipoCambio::query()
            ->where("fecha = :fecha:")
            ->andWhere("moneda_origen = :divisaO:")
            ->andWhere("moneda_destino = :divisaD:")
            ->bind(["fecha" => "2015-03-13", "divisaO" => "USD", "divisaD" => "MX"])
            ->execute();
            if (count($consulta) == 0)
            {

                $tipoCambio = new Modelos\TipoCambio();
                $tipoCambio->moneda_origen= $divisa_origen;
                $tipoCambio->monto_origen= $monto_origen;
                $tipoCambio->moneda_destino= $divisa_destino;
                $tipoCambio->monto_destino= $monto_destino;
                $tipoCambio->fecha= $fecha;

        //guardo la  datos recibidos del formulario
                if($tipoCambio->save())
                {
                    echo 'si se guardo';
                    return $this->dispatcher->forward(['action'=>'index']);
                }
            }
            else
            {
                print_r("\nYa existe el tipo de cambio");
                die();
            }

             

       } 
                            
    }    /**
    * function deleteAction
    * Elimina el permiso al usuario de la organizacion
    * @param $id varchar recibe la id del usuario que va a eliminar de la tabla permisos
    * @return void
    */
        public function deleteAction($id)
    {
        if($record = Modelos\TipoCambio::findFirst($id))
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



    //obtenemos todos los usuarios con id > 1
    public function consultaAction()
    {
    $consulta = Modelos\TipoCambio::query()
    ->where("fecha = :fecha:")
    ->andWhere("moneda_origen = :divisaO:")
    ->andWhere("moneda_destino = :divisaD:")
    ->bind(["fecha" => "2015-03-13", "divisaO" => "USD", "divisaD" => "MX"])
    ->execute();
    if (count($consulta) == 0)
    {
        echo "No existen registros";
    } 
    else{
        echo "___ID ", $consulta[0]->monto_destino, "<br>";    
    }
    
    }

    public function testAction()
    {
        echo "hola mundo";
    }

}

