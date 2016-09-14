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

// Services

use Symfony\Component\HttpFoundation\Request;
$app->post('/save-changes', function(Request $request) use ($app) {

	// Data from AJAX
	// $inputData = $request->get('list');

	$user1 = [];
	parse_str($_POST['user1'], $user1);

	// echo "user 1 = ";
	// print_r($user1);


	$user2 = [];
	parse_str($_POST['user2'], $user2);

	// echo "user 2 = ";
	// print_r($user2);

	$user3 = [];
	parse_str($_POST['user3'], $user3);

	// echo "user 3 = ";
	// print_r($user3);


	// Update DB

	try {
		// Clear table
		$sql = "TRUNCATE TABLE user_task";
		// $app['db']->executeUpdate($sql);
		$stmt = $app['db']->prepare($sql);
		$stmt->execute();


		// Add new racords
		foreach ($user1['task'] as $item) {
			$app['db']->insert('user_task', [ 'user_id' => 1, 'task_id' => (int) $item ]);
		}

		foreach ($user2['task'] as $item) {
			$app['db']->insert('user_task', [ 'user_id' => 2, 'task_id' => (int) $item ]);
		}

		foreach ($user3['task'] as $item) {
			$app['db']->insert('user_task', [ 'user_id' => 3, 'task_id' => (int) $item ]);
		}

    	// $app['db']->fetchAll("SELECT * from user1");

		
	} catch (Exception $e) {
		return $app->json( ['status' => 'fail', 'message' => 'sth wrong on server side !'] );
	}


	$outputData = ['status' => 'ok', 'test' => $user1];

	return $app->json($outputData);
});

$app->run(); 