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
        Maker::creatTab("surah", [
            $this->addCol('number')->integer()->cantNull(false)->save("surah"),
            $this->addCol("name")->string()->unique()->save("surah"),
            $this->addCol("englishName")->string()->save("surah"),
            $this->addCol("englishNameTranslation")->string()->save("surah"),
            $this->primaryKey("number")->save()
        ]);

        Maker::creatTab("ayat", [
            $this->addCol('number')->integer()->cantNull(false)->save("ayat"),
            $this->addCol("text")->string()->save("ayat"),
            $this->addCol('number_surah')->integer()->cantNull(false)->save("ayat"),
            $this->primaryKey("number")->save(),
            $this->foreignKey('number_surah','surah','number')->save()
        ]);
    }
}
$build = new DatabaseBuilder();
$build->build();