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
				$db->update_last_activity($_SESSION['user'], date("Y-m-d H:i:s"));
				$username = $db->get_user_data($_SESSION['user'])['name'];
				$response = array('username'=>$username);
			}
			else
				$response = array('username'=>'');
			break;

		case 'login':
			if (array_key_exists('user', $_SESSION))
				$response = array('error'=>'Already logged in');
			else
			{
				$user_id = $db->check_login_data($_POST['username'], $_POST['password']);
				if ($user_id != null)
				{
					$_SESSION['user'] = $user_id;
					$db->update_last_activity($_SESSION['user'], date("Y-m-d H:i:s"));
					$response = array('error'=>'');
				}
				else
					$response = array('error'=>'Incorrect username or password');
			}
			break;

		case 'logout':
			if (array_key_exists('user', $_SESSION))
			{
				$db->update_last_activity($_SESSION['user'], date("Y-m-d H:i:s", PHP_INT_MAX + 1));
				unset($_SESSION['user']);
				$response = array('error'=>'');
			}
			else
				$response = array('error'=>'Not logged in');
			break;

		case 'sendmsg':
			if (array_key_exists('user', $_SESSION))
			{
				if ($_POST['text'] != '')
				{
					$db->update_last_activity($_SESSION['user'], date("Y-m-d H:i:s"));
					$db->add_message($_SESSION['user'], $_POST['text']);
					$response = array('error'=>'');
				}
				else
					$response = array('error'=>'Can\'t send empty message');
			}
			else
				$response = array('error'=>'Not logged in');
			break;

		case 'pullmsglog':
			if (array_key_exists('user', $_SESSION))
			{
				$db->update_last_activity($_SESSION['user'], date("Y-m-d H:i:s"));
				$response = array('error'=>'', 'result'=>$db->pull_message_log($_POST['lastId']));
			}
			else
				$response = array('error'=>'Not logged in');
			break;

		case 'getusers':
			if (array_key_exists('user', $_SESSION))
			{
				$db->update_last_activity($_SESSION['user'], date("Y-m-d H:i:s"));
				$response = array('error'=>'', 'result'=>array('mock user1', 'mock user2'));
			}
			else
				$response = array('error'=>'Not logged in');
			break;

		default:
			$response = array();
			break;
	}

	echo(json_encode($response));
?>
