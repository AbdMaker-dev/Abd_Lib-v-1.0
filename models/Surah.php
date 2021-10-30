<?php

class Surah extends Model
{
	private $number;
	private $name;
	private $englishName;
	private $englishNameTranslation;


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


	public function getNumber()
	{
		return $this->number;
	}

	public function setNumber($number)
	{
		$this->number = $number;
		return $this;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	public function getEnglishName()
	{
		return $this->englishName;
	}

	public function setEnglishName($englishName)
	{
		$this->englishName = $englishName;
		return $this;
	}

	public function getEnglishNameTranslation()
	{
		return $this->englishNameTranslation;
	}

	public function setEnglishNameTranslation($englishNameTranslation)
	{
		$this->englishNameTranslation = $englishNameTranslation;
		return $this;
	}
}