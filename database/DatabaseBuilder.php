<?php
require 'config.php';
require 'libs/Colonne.php';
require 'libs/DbMaker.php';

use databse\DbMaker as Maker;
use cols\Colonne;

define("us_name", $user_name);
define("psw", $password);
define("ht", $host);
define("db", $bd_name);

class DatabaseBuilder extends Colonne
{

    protected $file;
    
    public function build()
    {

        Maker::creatTab("aquipe", [
            $this->addCol('id')->integer()->cantNull(false)->increment()->save("aquipe"),
            $this->addCol("nom")->string()->cantNull()->unique()->save("aquipe"),
            $this->addCol("couleur")->string()->cantNull()->save("aquipe"),
            $this->primaryKey("id")->save()
        ]);

        Maker::creatTab("rencontre", [
            $this->addCol('id')->integer()->cantNull(false)->increment()->save("rencontre"),
            $this->addCol('aquipe_id')->integer()->cantNull(false)->save("rencontre"),
            $this->addCol('equipe_id')->integer()->cantNull(false)->save("rencontre"),
            $this->primaryKey("id")->save(),
            $this->foreignKey("aquipe_id","aquipe","id")->cascade()->save(),
            $this->foreignKey("equipe_id","aquipe","id")->cascade()->save()
        ]);

        Maker::creatTab("match", [
            $this->addCol('id')->integer()->cantNull(false)->increment()->save("match"),
            $this->addCol('aquipe_id')->integer()->cantNull(false)->save("match"),
            $this->addCol('equipe_id')->integer()->cantNull(false)->save("match"),
            $this->primaryKey("id")->save(),
            $this->foreignKey("aquipe_id","aquipe","id")->cascade()->save(),
            $this->foreignKey("equipe_id","aquipe","id")->cascade()->save()
        ]);

        /*
        Maker::creatTab("user", [
            $this->addCol('id')->integer()->cantNull(false)->increment()->save("user"),
            $this->addCol("username")->string()->cantNull()->unique()->save("user"),
            $this->addCol("password")->string()->cantNull()->save("user"),
            $this->primaryKey("id")->save()
        ]);

        /*
        Maker::creatTab("produit", [
            $this->addCol('id')->integer(5)->cantNull(false)->increment()->save("produit"),
            $this->addCol("libelle")->string(16)->cantNull(false)->unique()->save("produit"),
            $this->addCol("user_id")->integer()->cantNull(false)->save("produit"),
            $this->primaryKey("id")->save(),
            $this->foreignKey("user_id","user","id")->cascade()->save()
        ]);

        Maker::creatTab("profile",[
            $this->addCol('id')->integer(5)->cantNull(false)->increment()->save("profile"),
            $this->addCol("libelle")->string(16)->cantNull(false)->unique()->save("profile"),
            $this->primaryKey("id")->save(),

        ]);
        */
    }
}
$build = new DatabaseBuilder();
$build->build();