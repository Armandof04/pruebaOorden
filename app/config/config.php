<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => 'oorden',
        'dbname'      => 'test',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        'incubatorDir'   => __DIR__ . '/../../app/vendor/phalcon/incubator/Library/Phalcon',
        'publicUrl'      => 'prueba.io',
        'baseUri'        => '/',
    ),
    'mail' => array(
                'fromName' => 'ABITS',
                'fromEmail' => 'armando.flores@abits.com',
                'smtp' => array(
                        'server'    => 'smtp.gmail.com',
                        'port'      => 465,
                        'security' => 'ssl',
                        'username' => 'armando.flores@abits.com',
                        'password' => 'Armandof118576',
                )
        ),
));
