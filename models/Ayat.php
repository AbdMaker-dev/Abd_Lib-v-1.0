<?php

class Ayat extends Model
{
	private $number;
	private $text;
	private $number_surah;


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

	public function getText()
	{
		return $this->text;
	}

	public function setText($text)
	{
		$this->text = $text;
		return $this;
	}

	public function getNumber_surah()
	{
		return $this->number_surah;
	}

	public function setNumber_surah($number_surah)
	{
		$this->number_surah = $number_surah;
		return $this;
	}
}