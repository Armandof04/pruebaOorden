<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir
    )
)->register();

$loader->registerNamespaces(
    array(
       'prueba\Controllers'    =>  $config->application->controllersDir,
       'prueba\Models'    =>  $config->application->modelsDir,
       'Phalcon' => $config->application->incubatorDir
    )
);

$loader->register();


