<?php
	include('database.php');
	session_start();
	$db = new Database();
	$response;

	switch($_GET['command'])
	{
		case 'loggedin':
			if (array_key_exists('user', $_SESSION))
			{
				$username = $db->get_user_name($_SESSION['user']);
				$response = array('username'=>$username);
			}
			else
				$response = array('username'=>'');
			break;

		default:
			$response = array();
			break;
	}

	echo(json_encode($response));
?>
