<?php

namespace databse;

class DbMaker
{


    public static $file ;

    public static function creatTab($table, array $attributes)
    {
        $requet = "\nCREATE TABLE `$table` ( \n";
        for ($i = 0; $i < count($attributes); $i++) {
            $requet = $requet . $attributes[$i];
            if (isset($attributes[$i + 1])) {
                $requet = $requet . ",\n";
            }
        }
        $requet = $requet .  "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;\n";
        try {
            $file_name = "migration/".db."_tables_".date("Y_m_d")."_".date("h_m");
            fopen($file_name.".sql", "c+");
            $contenu = file_get_contents($file_name.".sql");
            if ($contenu==null) {
                $contenu = "DROP DATABASE IF EXISTS `" . db . "`;\nCREATE DATABASE IF NOT EXISTS `" . db . "`;\nUSE `" . db . "`;\n" ;
            }
            $contenu = $contenu . $requet;
            file_put_contents($file_name.".sql", $contenu);

            DbMaker::$file = $file_name.".sql";
            
            return true;
        } catch (\Throwable $th) {
            die($th);
        }
        
    }
}