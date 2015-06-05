<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir,
        $config->application->phpexcelDir,
    )
)
->registerNamespaces(
    array(
       'prueba\Controllers'    =>  $config->application->controllersDir,
       'prueba\Models'    =>  $config->application->modelsDir,
       'Phalcon' => $config->application->incubatorDir,
       'Excel' => $config->application->phpexcelDir,
       'Goutte\Client'  =>  $config->application->goutte,
    )
)
/*
->registerClasses(
    array(
        "IOFactory"         => $config->application->phpexcelDir.'/PHPExcel/IOFactory.php',
        "PHPExcel_Reader_Excel2007"   =>    '/../../app/vendor/phpoffice/phpexcel/Classes/PHPExcel/Reader/Excel2007.php'
    )
)*/
//a ver corre eso para ver donde falla

->registerPrefixes(
    [
      'PHPExcel' => '/../../app/vendor/phpoffice/phpexcel/Classes/PHPExcel'
    ]
  )
->register();



