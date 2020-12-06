<?php
// Obligatoire:: toujour inclure Manager.php 
require_once "models/Manager.php";

$user_dao = new UserDao();

echo "<br><br> Insertion User avec add()<br>";
$result =  $user_dao->add(["username"=>"Abd2020","password"=>"passer_1234"]);
var_dump($result);

echo "<br><br>Slecte All user avec  All()<br>";
var_dump($user_dao->findAll());