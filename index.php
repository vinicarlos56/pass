<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

require 'vendor/autoload.php';


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("/var/www/pass/models");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'pass',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);


$app = new \Slim\Slim(array(
    'debug' => true,
    'mode' => 'development',
    'templates.path' => 'views/templates/'
));


$app->get('/', function () use ($app) {
    echo $app->render('main.php', array('content' => 'teste'));
});

$app->get('/data',function() use ($entityManager){
	echo "<pre>";
	var_dump($entityManager->getRepository('\\Models\\Client')->findAll());
	echo "</pre>";
	exit();
});


$app->run();