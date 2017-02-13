<?php

class db
{
	private $databse = 'test';
	private $login = 'root';
	private $password = 'root';
	private $host = 'localhost';
	private $dbase;
	private $query;

	public function __construct()
	{
		$this->dbase = mysql_connect($this->host, $this->login, $this->password);
		if (!$this->dbase) die(mysql_error());
		mysql_select_db($this->databse, $this->dbase) or die(mysql_error());
	}

	public function getDB()
	{
		return $this->dbase;
	}

	public function select()
	{
		$this->query='SELECT * FROM images';
		$result = mysql_query($this->query);
		if (!$result) die(mysql_error());
		return $result;
	}

	public function insert($original_name)
	{
		$date=date("Y-m-d H:i:s");
		$this->query="INSERT INTO `images`(`original_name`,`create_datetime`) 
					  VALUES ('$original_name','$date')";
		$result = mysql_query($this->query);
		if (!$result) die(mysql_error());
		return mysql_insert_id ();
	}
}