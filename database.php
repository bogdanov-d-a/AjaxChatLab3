<?php

class Database
{
	private $mysqli;

	public function __construct()
	{
		$this->mysqli = new mysqli('localhost', 'root', '', 'lab3');
		if ($this->mysqli->connect_errno)
			die('mysqli connect error: ' . $mysqli->connect_errno);
	}

	public function __destruct()
	{
		$this->mysqli->close();
	}

	public function query($sql)
	{
		$result = $this->mysqli->query($sql);
		if (!$result)
			die('query failed');
		return $result;
	}

	public function no_query($sql)
	{
		$result = $this->mysqli->query($sql);
		if (!$result || !($result === TRUE))
			die('no_query failed');
	}

	public function get_user_data($id)
	{
		$reader = $this->query('select * from users where id=' . $id . ';');

		if ($reader->num_rows === 0)
			die('could not find user');

		$user = $reader->fetch_assoc();
		return $user;
	}

	public function check_login_data($username, $password)
	{
		$reader = $this->query('select * from users where name=\'' . $username . '\' and password=\'' . $password . '\';');

		if ($reader->num_rows === 0)
			return null;

		$user = $reader->fetch_assoc();
		return $user['id'];
	}

	public function add_message($sender, $text)
	{
		$this->no_query('insert into messages (text, sender) values (\'' . $text . '\', \'' . $sender . '\');');
	}

	public function pull_message_log($lastId)
	{
		$reader = $this->query('select * from messages where id > ' . $lastId . ' order by id asc;');
		$msgArray = array();
		$lastId = 0;

		while ($message = $reader->fetch_assoc())
		{
			array_push($msgArray, array(
				'sender'=>$this->get_user_data($message['sender'])['name'],
				'text'=>$message['text']
			));
			$lastId = $message['id'];
		}

		return array('lastId'=>$lastId, 'log'=>$msgArray);
	}
}

?>
