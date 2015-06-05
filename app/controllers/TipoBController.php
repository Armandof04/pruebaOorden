<?php

namespace prueba\Controllers;
use prueba\Models as Modelos;

class TipoBController extends \Phalcon\Mvc\Controller
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
    * function addExAction
    * agrega un registro, regitrando el tipo de cambio de www.ex.com
    * @return void
    */
    public function addExAction()
    {
           
              
      $val1 = 'USD';
      $val2 = 'MXN'; 
      $fuente = 'www.xe.com';

      $url = 'http://www.xe.com/es/currencyconverter/convert/?Amount=1&From='.$val1.'&To='.$val2;
      $output = file_get_contents($url); //devuelve el fichero a un string
         
      preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $output, $coincidencias, PREG_SET_ORDER); //crea la busqueda




            $tcEx_1 =$coincidencias[86][0]; 
            echo $tcEx_1;
 
          /* solo si se quiere la conversion inversa de $VAL2 a $VAL1 (mxn a usd)
          elseif ($n == 88) 
          {
            $tcEx_2 = $valor[0];
          }
          */

            $fechaTcEx = $coincidencias[143][0];
            echo $fechaTcEx;
 


        // Se comprueban las variables
        // echo $tcEx_1."<br>";
        // echo $tcEx_2."<br>";
        // echo $fechaTcEx."<br>";
        // die();

        //1 USD = 14.9121 MXN
        //1 MXN = 0.0670595 USD
        //2015-04-07 15:22 UTC

          $divisa_origen = substr($tcEx_1, 53, 3);
          $monto_origen = substr($tcEx_1, 46, 1); 

          $divisa_destino = substr($tcEx_1, 82, 3);
          $monto_destino = substr($tcEx_1, 69, 7);

          $fecha = substr($fechaTcEx, 26, 11);

          
          // Se comprueban las variables
          echo "<br>Divisa Destino".$divisa_destino."<br>";
          echo "Monto Destino".$monto_destino."<br>";
          echo $divisa_origen."<br>";
          echo $monto_origen."<br>";
          echo $fecha."<br>";
          die();
        

        //Verifico que no exista el tipo de cambio con las mismas divisas y fecha
          $consulta = Modelos\TipoCambio::query()
            ->where("fecha = :fecha:")
            ->andWhere("moneda_origen = :divisaO:")
            ->andWhere("moneda_destino = :divisaD:")
            ->andWhere("fuente = :fuente:")
            ->bind(["fecha" => $fecha, "divisaO" => $divisa_origen, "divisaD" => $divisa_destino, "fuente" => $fuente])
            ->execute();
            if (count($consulta) == 0)
            {

                $tipoCambio = new Modelos\TipoCambio();
                $tipoCambio->fuente= $fuente;
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
                print_r("\nYa existe el tipo de cambio de ".$fecha);
                die();
            }

             

       
                            
    }

    /**
    * function addExAction
    * agrega un registro, regitrando el tipo de cambio de www.ex.com
    * @return void
    */
    public function addDofAction()
    {
     // date_default_timezone_set('America/Mexico_City');
      echo date('d.m.y');
      echo "<br>";

      $fec_1 = date("d").'%2F'.date('m').'%2F'.date('y');
      // $fec_1 = '07%2F04%2F2015';
      $fuente = 'www.banxico.org.mx';

      $url = 'http://dof.gob.mx/indicadores_detalle.php?cod_tipo_indicador=158&dfecha='.$fec_1.'&hfecha='.$fec_1;
      $output = file_get_contents($url); //devuelve el fichero a un string
         
      preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $output, $coincidencias, PREG_SET_ORDER); //crea la busqueda

      $n=0;

      foreach ($coincidencias as $valor) {
          $n=$n+1;
          if($n==44)
          {
            $moneda = $valor[0];
          }
          elseif ($n==50)
          {
            $fechaTcDof = $valor[0];
          }
          elseif ($n==51)
          {
            $tcDof = $valor[0];
          }
      }
        // Se comprueban las variables
        // echo $moneda."<br>";
        // echo $fechaTcDof."<br>";
        // echo $tcDof_1."<br>";
        // die();

          $divisa_origen = 'USD';
          $monto_origen = 1;

          $divisa_destino = 'MXN';
          $monto_destino = substr($tcDof, 43, 7);

          $fecha = substr($fechaTcDof, 77, 10);
          $dia = substr($fecha, 0, 2);
          $mes = substr($fecha, 3, 2);
          $año = substr($fecha, 6, 4);
          $fecha = $año."-".$mes."-".$dia;

          /*
          * Se comprueban las variables
          echo $divisa_destino."<br>";
          echo $monto_destino."<br>";
          echo $divisa_origen."<br>";
          echo $monto_origen."<br>";
          echo $fecha."<br>";
          die();
          */
          

        //Verifico que no exista el tipo de cambio con las mismas divisas y fecha
          $consulta = Modelos\TipoCambio::query()
            ->where("fecha = :fecha:")
            ->andWhere("moneda_origen = :divisaO:")
            ->andWhere("moneda_destino = :divisaD:")
            ->andWhere("fuente = :fuente:")
            ->bind(["fecha" => $fecha, "divisaO" => $divisa_origen, "divisaD" => $divisa_destino, "fuente" => $fuente])
            ->execute();
            if (count($consulta) == 0)
            {

                $tipoCambio = new Modelos\TipoCambio();
                $tipoCambio->fuente= $fuente;
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
                print_r("\nYa existe el tipo de cambio de ".$fecha);
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



        /**
    * function addAction
    * agrega un registro, regitrando el ID de organizacion al que corresponde
    * @param $id varchar recibe la id de la Organizacion al cual el usuario tendra permiso
    * @return void
    */
    public function addDofgAction()
    {
           
              
      $url = 'http://www.dof.gob.mx/indicadores.xml';

      $xml = simpleXML_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA); 
      if($xml ===  FALSE) 
      { 
          echo "No se puede conectar con el servidor RSS";

      } 
      else 
      { 

          //echo $xml->channel->item[0]->title; //Moneda Origen
          $fuente = 'www.dof.gob.mx';

          $divisa_origen = 'USD';
          $monto_origen = 1;
          
          $divisa_destino = 'MXN';
          $monto_destino = $xml->channel->item[0]->description; 
     
          $fecha = $xml->channel->item[0]->valueDate;
          $fecha=implode('/',array_reverse(explode('/',$fecha))); //Invierte la fecha (yy/mm/dd)

        //Verifico que no exista el tipo de cambio con las mismas divisas y fecha
          $consulta = Modelos\TipoCambio::query()
            ->where("fecha = :fecha:")
            ->andWhere("moneda_origen = :divisaO:")
            ->andWhere("moneda_destino = :divisaD:")
            ->andWhere("fuente = :fuente:")
            ->bind(["fecha" => $fecha, "divisaO" => $divisa_origen, "divisaD" => $divisa_destino, "fuente" => $fuente])
            ->execute();
            if (count($consulta) == 0)
            {

                $tipoCambio = new Modelos\TipoCambio();
                $tipoCambio->fuente= $fuente;
                $tipoCambio->moneda_origen= $divisa_origen;
                $tipoCambio->monto_origen= $monto_origen;
                $tipoCambio->moneda_destino= $divisa_destino;
                $tipoCambio->monto_destino= $monto_destino;
                $tipoCambio->fecha= $fecha;

                //guardo la  datos recibidos del formulario
                if($tipoCambio->save())
                {
                    echo 'Guardado correctamente, Fuente: www.dof.gob.mx';
                    return $this->dispatcher->forward(['action'=>'index']);
                }
                else
                {
                  foreach($tipoCambio->getMessages() as $msg) 
                  {
                    var_dump($msg->getMessage());
                  }
                  print_r("\nNo se guardo, intente nuevamente");
                  die();
                }
            }
            else
            {
                print_r("\nYa existe el tipo de cambio de ".$fecha);
                die();
            }

             

       } 
                            
    } 
    /**
    * function addAction
    * agrega un registro, regitrando el ID de organizacion al que corresponde
    * @param $id varchar recibe la id de la Organizacion al cual el usuario tendra permiso
    * @return void
    */
    public function addBanamexAction()
    {
      
      $fecha = date("y/m/d");

      $url = 'http://portal.banamex.com.mx/c719_004/economiaFinanzas/es/home?xhost=http://www.banamex.com/';
      $output = file_get_contents($url); //devuelve el fichero a un string
      preg_match_all("/(\d+).(\d+)/", $output, $tc, PREG_SET_ORDER);//crea la busqueda de los numeros con decimales(\d+).(\d+)


      $divisa_origen = 'USD';
      $monto_origen = '1';
      $divisa_destino = 'MXN';
      $monto_destino =  $tc[2][0];

      /*
      preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $output, $titulo, PREG_SET_ORDER); // Se realiza la busqueda  de caracteres tipo text
      //Se muestran las variables obtenidas de las busquedas
      echo $titulo[7][0]; //COMPRA

      echo $titulo[3][0]." "; //USD
      echo $tc[2][0]; //valor

      echo $titulo[4][0]." "; //EURO
      echo $tc[3][0];

      echo $titulo[5][0]." "; //LIBRA
      echo $tc[4][0];

      echo $titulo[6][0]." "; //YEN
      echo $tc[5][0];



      echo $titulo[8][0]; //VENTA

      echo $titulo[3][0]." "; //USD
      echo $tc[6][0];

      echo $titulo[4][0]." "; //EURO
      echo $tc[7][0];

      echo $titulo[5][0]." "; //LIBRA 
      echo $tc[8][0];

      echo $titulo[6][0]." "; //YEN
      echo $tc[9][0];

      */

      preg_match('@^(?:http://)?([^/]+)@i', $url, $dominio);
      $fuente = $dominio[1];
    //Verifico que no exista el tipo de cambio con las mismas divisas y fecha
      $consulta = Modelos\TipoCambio::query()
        ->where("fecha = :fecha:")
        ->andWhere("moneda_origen = :divisaO:")
        ->andWhere("moneda_destino = :divisaD:")
        ->andWhere("fuente = :fuente:")
        ->bind(["fecha" => $fecha, "divisaO" => 'USD', "divisaD" => 'MXN', "fuente" => $fuente])
        ->execute();
      if (count($consulta) == 0)
      {

        $tipoCambio = new Modelos\TipoCambio();
        $tipoCambio->fuente= $fuente;
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
        else
        {
           print_r("\nHubo un error al guardar, intente nuevamente\n");
          foreach($tipoCambio->getMessages() as $msg) 
          {
            var_dump($msg->getMessage());
          }
          die();
        }
      }
      else
      {
        print_r("\nYa existe el tipo de cambio de ".$fecha);
        die();
      }
                       
    }

    /**
    * function addTasasAction
    * agrega las tasas de cambio de automaticamente
    * @return void
    */
    public function addTasasAction()
    {
      switch ($nombreFuente) 
      {
        case 'Banxico':

          $url = 'http://www.dof.gob.mx/indicadores.xml';
          $xml = simpleXML_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
          $divisaOrigen = 'USD';
          $montoOrigen = 1;
          
          $divisaDestino = 'MXN';
          $montoDestino = $xml->channel->item[0]->description; 
     
          $fecha = $xml->channel->item[0]->valueDate;
          $fecha=implode('/',array_reverse(explode('/',$fecha))); //Invierte la fecha (yy/mm/dd)
          break;
        
        default:
          # code...
          break;
      }

      preg_match('@^(?:http://)?([^/]+)@i', $url, $dominio);
      $fuente = $dominio[1];
      //Verifico que no exista el tipo de cambio con las mismas divisas y fecha
      $consulta = Modelos\TipoCambio::query()
        ->where("fecha = :fecha:")
        ->andWhere("moneda_origen = :divisaO:")
        ->andWhere("moneda_destino = :divisaD:")
        ->andWhere("fuente = :fuente:")
        ->bind(["fecha" => $fecha, "divisaO" => 'USD', "divisaD" => 'MXN', "fuente" => $fuente])
        ->execute();
      if (count($consulta) == 0)
      {

        $tipoCambio = new Modelos\TipoCambio();
        $tipoCambio->fuente= $fuente;
        $tipoCambio->moneda_origen= $divisaDrigen;
        $tipoCambio->monto_origen= $montoOrigen;
        $tipoCambio->moneda_destino= $divisaDestino;
        $tipoCambio->monto_destino= $montoDestino;
        $tipoCambio->fecha= $fecha;

      //guardo la  datos recibidos del formulario
        if($tipoCambio->save())
        {
          echo 'si se guardo';
          return $this->dispatcher->forward(['action'=>'index']);
        }
        else
        {
           print_r("\nHubo un error al guardar, intente nuevamente\n");
          foreach($tipoCambio->getMessages() as $msg) 
          {
            var_dump($msg->getMessage());
          }
          die();
        }
      }
      else
      {
        print_r("\nYa existe el tipo de cambio de ".$fecha);
        die();
      }
    }

}

