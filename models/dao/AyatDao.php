<?php

class AyatDao extends DaoManager
{


	public function __construct()
	{
		$this->className='Ayat';
		$this->tabName='ayat';
		$this->getConnection();
	}

	/**
	* add(array data) permet d'ajouter une nouvelle enregistrement dans la base
	*/


	/**
	* findAll() return un tableau vide ou un tableau d'objets ayat
	*/


	/**
	* findById(id) return null ou un objet ayat
	*/


	/**
	* findBy(array data) return un tableau vide ou un tableau d'objets ayat
	*/


	/**
	* update(array data) Modifie les infos de l'objet ayat grace a l'ID
	*/




	/**
	* Vous pouvez cree ici vos propre fonctions pour interoger la base de donnees en utilisant $this->pdo pour excute les requets
	*/

}