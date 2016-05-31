<?php

class Database
{
	private $link;

	public function __construct()
	{
		$this->link = mysql_connect('localhost', 'root', '')
			or die('Could not connect: ' . mysql_error());
		mysql_select_db('lab3') or die('Could not select database');
	}

	public function __destruct()
	{
		mysql_close($this->link);
	}
}

?>
