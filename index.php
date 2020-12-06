<?php
// Obligatoire:: toujour inclure Manager.php 
require_once "models/Manager.php";

$equi_dao = new AquipeDao();
$equi_dao->add(["nom"=>"Senegale", "couleur"=>"verte"]);
$equi_dao->add(["nom"=>"Cameroune", "couleur"=>"rouge"]);


$recontre_dao = new RencontreDao();
$recontre_dao->add(["aquipe_id"=> 1, "equipe_id"=> 2]);

$match_dao = new MatchDao();
$match_dao->add(["aquipe_id"=> 1, "equipe_id"=> 2]);

/* Code test
$user_dao = new UserDao();

echo "<br><br> Insertion User avec add()<br>";
$result =  $user_dao->add(["username"=>"Abd2020","password"=>"passer_1234"]);
var_dump($result);

echo "<br><br>Slecte All user avec  All()<br>";
var_dump($user_dao->findAll());
*/