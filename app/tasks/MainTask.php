<?php
use Phalcon\Queue\Beanstalk\Extended as BeanstalkExtended;
use Phalcon\Queue\Beanstalk\Job;
use prueba\Controllers\TipoC as TipoC;
use prueba\Models as Modelos;

class MainTask extends \Phalcon\CLI\Task
{
    /**
    * function mainAction
    * Ejecuta todas las funciones del Task
    */
    public function mainAction() {
         echo "\nMostrare el estatus del envio de correos y activare la funcions de Queues \n";
         $this->statusQueueAction();
         $this->queueAction();
         die();
    }

    /**
    * @param array $params
    */
   public function testAction(array $params) {
       echo sprintf('hello %s', $params[0]) . PHP_EOL;
       echo sprintf('atentamente, %s', $params[1]) . PHP_EOL;
   }

   /*
    $ php app/cli.php main test world universe

    hello world
    best regards, universe
  */

  /**
  * function statusQueueAction
  * Script de consola simple que da salida a las estadísticas de tubos:
  * @param $prefix varchar el nombre de nuestro proyecto que queremos mostrar
  */
  public function statusQueueAction(){
    $prefix    = 'correos';
    $beanstalk = new BeanstalkExtended(array(
        'host'   => 'localhost',
        'prefix' => $prefix,
    ));

foreach ($beanstalk->getTubes() as $tube) {
      if (0 === strpos($tube, $prefix)) {
        try {
            $stats = $beanstalk->getTubeStats($tube);
            printf(
                "%s:\n\tready: %d\n\treserved: %d\n",
                $tube,
                $stats['current-jobs-ready'],
                $stats['current-jobs-reserved']
            );
        } catch (\Exception $e) {
        }
      }
      
}


  }


    /**
    * function queueAction
    * Ejecuta el servicio de Queues, para envio de correos
    * @param $prefix varchar el nombre de nuestro proyecto que queremos mostrar
    */

   public function queueAction(){
      $beanstalk = new BeanstalkExtended(array(
            'host'   => 'localhost',
            'prefix' => 'correos',
      ));

      $beanstalk->addWorker('envioEmail', function (Job $job) {
        // Aquí debemos recoger la información meta, hacer las capturas de pantalla, convertir el vídeo a FLV etc.
        $message = $job->getBody();
        $cabeceras = 'From: noreply@abits.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
        
        mail($message, 'mi titulo de correo 4.0', 'este es mi mensaje Mensaje', $cabeceras);
  
        // It's very important to send the right exit code!
        // Es muy importante enviar el código de salida de la derecha!
        exit(0);

      });

        // Start processing queues
        $beanstalk->doWork();

        die();

   }

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

          $fecha = substr($xml->item->title, 24, 10);

          $fuente = 'banxico';
     
         // $fecha = strtotime ( '+1 day' , strtotime ( $fechaA ) ) ; //sumo un dia a la fecha, ya que el SAT los datos los obtiene del día anterior
         // $fecha = date ( 'Y-m-j' , $fecha );

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
                   die();
                }
                else{
                  foreach($tipoCambio->getMessages() as $msg) {
                    var_dump($msg->getMessage());
                  }
                  echo 'No se guardo, intente nuevamente';
                  die();
                }
          }
            else
            {
                print_r("\nYa existe el tipo de cambio");
                die();
            }

            

       } 
                            
    }

     public function addExAction()
    {
           
              
      $val1 = 'USD';
      $val2 = 'MXN'; 
      $fuente = 'www.xe.com';

      $url = 'http://www.xe.com/es/currencyconverter/convert/?Amount=1&From='.$val1.'&To='.$val2;
      $output = file_get_contents($url); //devuelve el fichero a un string
         
      preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $output, $coincidencias, PREG_SET_ORDER); //crea la busqueda

      $n=0;

      foreach ($coincidencias as $valor) {
          $n=$n+1;
          if($n == 87)
          {
            $tcEx_1 =$valor[0];
          }
          /* solo si se quiere la conversion inversa de $VAL2 a $VAL1 (mxn a usd)
          elseif ($n == 88) 
          {
            $tcEx_2 = $valor[0];
          }
          */
          elseif ($n == 144) 
          {
            $fechaTcEx = $valor[0];
          }

      }
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
                  print_r("\nSe guardo correctamente\n");
                  die();
                }
            }
            else
            {
                print_r("\nYa existe el tipo de cambio\n");
                die();
            }

             

       
                            
    }


}


