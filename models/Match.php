<?php

class Match extends Model
{
	private $id;
	private $aquipe_id;
	private $equipe_id;


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

	public function getAquipe_id()
	{
		return $this->aquipe_id;
	}

	public function setAquipe_id($aquipe_id)
	{
		$this->aquipe_id = $aquipe_id;
		return $this;
	}

	public function getEquipe_id()
	{
		return $this->equipe_id;
	}

	public function setEquipe_id($equipe_id)
	{
		$this->equipe_id = $equipe_id;
		return $this;
	}
}