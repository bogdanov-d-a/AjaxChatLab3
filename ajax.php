<?php
	include('database.php');
	session_start();
	$db = new Database();
	$response;

	switch($_GET['command'])
	{
		case 'loggedin':
			if (array_key_exists('user', $_SESSION))
				$response = array('result'=>1);
			else
				$response = array('result'=>0);
			break;

		default:
			$response = array();
			break;
	}

	echo(json_encode($response));
?>
