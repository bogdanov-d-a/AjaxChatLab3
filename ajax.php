<?php
	include('database.php');
	session_start();
	$db = new Database();
	$response;

	switch($_GET['command'])
	{
		case 'loggedin':
			if (array_key_exists('user', $_SESSION))
				$response = array('username'=>$_SESSION['user']);
			else
				$response = array('username'=>'');
			break;

		default:
			$response = array();
			break;
	}

	echo(json_encode($response));
?>
