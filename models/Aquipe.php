<?php

class Aquipe extends Model
{
	private $id;
	private $nom;
	private $couleur;


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

	public function getNom()
	{
		return $this->nom;
	}

	public function setNom($nom)
	{
		$this->nom = $nom;
		return $this;
	}

	public function getCouleur()
	{
		return $this->couleur;
	}

	public function setCouleur($couleur)
	{
		$this->couleur = $couleur;
		return $this;
	}
}