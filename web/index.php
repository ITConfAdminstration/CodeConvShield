<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Our web handlers

$app->get('/', function() use($app) {

	return 'Hello, World!';
	
});

$app->post('/bot', function() use($app) {
	$data = json_decode(file_get_contents('php://input'));
	
	if(!$data)
		return 'NULL';
	
	if($data->secret !== getenv('VK_SECRET_TOKEN') && $data->type != 'confirmation' )
		return 'NULL';
	
	
	switch($data->type)
	{
		
		case 'confirmation':
		return getenv('VK_CONFIRMATION_CODE');
		break;
		
		case 'messages_new':
		
		
		
		break;
		
	}
	
	return 'NULL';
	
});

$app->run();
