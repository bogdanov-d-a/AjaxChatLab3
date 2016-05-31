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

	public function get_user_name($id)
	{
		$reader = $this->query('select * from users where id=' . $id . ';');

		if ($reader->num_rows === 0)
			die('could not find user');

		$user = $reader->fetch_assoc();
		return $user['name'];
	}

	public function check_login_data($username, $password)
	{
		$reader = $this->query('select * from users where name=\'' . $username . '\' and password=\'' . $password . '\';');

		if ($reader->num_rows === 0)
			return null;

		$user = $reader->fetch_assoc();
		return $user['id'];
	}
}

?>
