<?php
use Phalcon\Queue\Beanstalk\Extended as BeanstalkExtended;
use Phalcon\Queue\Beanstalk\Job;


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

   }
}


