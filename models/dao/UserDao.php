<?php

class UserDao extends DaoManager
{


	public function __construct()
	{
		$this->className='User';
		$this->tabName='user';
		$this->getConnection();
	}

	/**
	* add(array data) permet d'ajouter une nouvelle enregistrement dans la base
	*/


	/**
	* findAll() return un tableau vide ou un tableau d'objets user
	*/


	/**
	* findById(id) return null ou un objet user
	*/


	/**
	* findBy(array data) return un tableau vide ou un tableau d'objets user
	*/


	/**
	* update(array data) Modifie les infos de l'objet user grace a l'ID
	*/




	/**
	* Vous pouvez cree ici vos propre fonctions pour interoger la base de donnees en utilisant $this->pdo pour excute les requets
	*/

}