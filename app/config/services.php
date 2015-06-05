<?php

use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Router as Router;//hacemos uso de router
use Phalcon\Mvc\Dispatcher as PhDispatcher;
/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 * Aquí se crea el contenedor donde se irán inyectando nuestras dependencias, a partir de esa linea le añadimos todo lo que necesitamos. 
 * Pues de la misma forma es como debemos hacer para utilizar las rutas
 */
$di = new FactoryDefault(); 


/**

 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
}, true);

/**
 * Setting up the view component
 */
$di->set('view', function () use ($config) {

    $view = new View();

    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view, $di) use ($config) {

            $volt = new VoltEngine($view, $di);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ));

            return $volt;
        },
        '.php' => 'Phalcon\Mvc\View\Engine\Php'
    ));

    return $view;
}, true);

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set('db', function () use ($config) {
    return new DbAdapter(array(
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        "charset" => $config->database->charset
    ));
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set('modelsMetadata', function () {
    return new MetaDataAdapter();
});



/*-----hago la conexion de la memcache con el servicor---*/
//cache del find de Organizaciones
$di->set('modelsCache', function() use ($config)
    {
        //Tiempo que durara la cache (un dia)
        $frontCache = new \Phalcon\Cache\Frontend\Data([
                "lifetime" => 3600
        ]);

        //Configurar la Memcache para conexion a la Base de Datos
        $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, [
                 'host' => $config->database->host,
                "port" => "11211"
        ]);
        return $cache;
    });

//cache del find de Sucursales
$di->set('cacheSuc', function() use ($config)
    {
        //Tiempo que durara la cache (un dia)
        $frontCache = new \Phalcon\Cache\Frontend\Data([
                "lifetime" => 3600
        ]);

        //Configurar la Memcache para conexion a la Base de Datos
        $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, [
                'host' => $config->database->host,
                "port" => "11211"
        ]);
        return $cache;

    });


//cache del find de Usuarios
$di->set('cacheUs', function() use ($config)
    {
        //Tiempo que durara la cache (un dia)
        $frontCache = new \Phalcon\Cache\Frontend\Data([
                "lifetime" => 3600
        ]);

        //Configurar la Memcache para conexion a la Base de Datos
        $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, [
                'host' => $config->database->host,
                "port" => "11211"
        ]);
        return $cache;

    });

//cache del find de tipoCambio
$di->set('cacheTi', function() use ($config)
    {
        //Tiempo que durara la cache (un dia)
        $frontCache = new \Phalcon\Cache\Frontend\Data([
                "lifetime" => 3600
        ]);

        //Configurar la Memcache para conexion a la Base de Datos
        $cache = new \Phalcon\Cache\Backend\Memcache($frontCache, [
                'host' => $config->database->host,
                "port" => "11211"
        ]);
        return $cache;

    });
/*---- Termina el cache-----*/


//app/config/service.php
        //Mail service uses Gmail;
        $di->set('mail', function(){
                return new Mail();
        });


/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

$di->set('config', $config);
//registro el dispatcher para poder usar mi namespace "prueba" que se utilizara en la misma instancia (controllers)
$di->set('dispatcher', function() {
    $dispatcher = new \Phalcon\Mvc\Dispatcher();
    $dispatcher->setDefaultNamespace('prueba\Controllers\\');
    return $dispatcher;
}); 


//Register a controller as a service
$di->set('IndexController', function() {
    $component = new Component();
    return $component;
});

/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function()
{
    return new Phalcon\Flash\Direct(
        array(
            'error' => 'alert alert-error',
            'success' => 'alert alert-success',
            'notice' => 'alert alert-info',
            'warning' => 'alert alert-warning',
        )
    );
});

/**
 * creamos nuestras rutas
 *creamos una nueva instancia del objeto Router,
 * lo que estamos haciendo es inyectar en el contenedor de dependencias el objeto router para que pueda ser utilizado.
*/
$di->set('router', function() 
{
    $router = new Router();
 
    return $router;
});

$di->set('cookies', function() {
    $cookies = new Phalcon\Http\Response\Cookies();
    $cookies->useEncryption(false);
    return $cookies;
});



