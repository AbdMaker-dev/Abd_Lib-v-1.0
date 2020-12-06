<?php

class User extends Model
{
	private $id;
	private $username;
	private $password;


	public function __construct($data=null)
	{
		if($data!=null)
		{
			$this->hydrate($data);
		}
	}


	public function hydrate($data)
	{
		foreach ($data as $key => $value)
		{
			$this->$key = $value;
		}
	}


	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}
}