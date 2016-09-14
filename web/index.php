<?php

require_once __DIR__.'/../vendor/autoload.php'; 


$app = new Silex\Application(); 

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'homework',
        'user'     => 'homework',
        'password' => 'vMEpOgOfadxQkffl',
        'charset'  => 'utf8mb4',
    ),
));

$app->get('/', function() use($app) { 
    // return 'Hello '.$app->escape($name); 
    return $app['twig']->render('index.twig', []);
}); 

$app->get('/drag', function() use($app) { 

    // Select tasks for users
    $sql = "SELECT t.id, t.name FROM task t
    		INNER JOIN user_task ut ON t.id = ut.task_id
    		INNER JOIN user u ON u.id = ut.user_id
    		WHERE u.id = ?";
    $taskList['user1'] = $app['db']->fetchAll( $sql, [1] );
    $taskList['user2'] = $app['db']->fetchAll( $sql, [2] );
    $taskList['user3'] = $app['db']->fetchAll( $sql, [3] );

    // Select others task
	$sql = "SELECT t.id, t.name, ut.task_id AS testMe FROM task t
			LEFT OUTER JOIN user_task ut ON t.id = ut.task_id
			WHERE ut.task_id IS NULL";
    $taskList['others'] = $app['db']->fetchAll( $sql );

    // echo "<pre>";
	// var_dump($taskList);

    return $app['twig']->render('drag.twig', ['taskList' => $taskList]);
}); 

$app->run(); 