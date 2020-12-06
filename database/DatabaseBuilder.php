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

        Maker::creatTab("user", [
            $this->addCol('id')->integer()->cantNull(false)->increment()->save("user"),
            $this->addCol("username")->string()->cantNull()->unique()->save("user"),
            $this->addCol("password")->string()->cantNull()->save("user"),
            $this->primaryKey("id")->save()
        ]);
    }
}
$build = new DatabaseBuilder();
$build->build();