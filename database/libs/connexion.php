<?php

function getConect()
{
    $pdo = null;
    try {
        require path.'database/config.php';
        $pdo = new PDO("mysql:host=".$host.";dbname=".$bd_name, $user_name, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo ;
    } catch (PDOException $e) {
        die("Erreur au niveau de la base de donnée. Veuillez contacter SYMBOLE");
    }
}

function executeQueryFile($sqlFile)
{
    $query = file_get_contents($sqlFile);

    $Lines = explode(";\n", $query);
    $b = true;
    for ($i=0; $i < count($Lines); $i++) { 
        $line = $query[$i];
        if ($line!= '') {
            $line.= ";";
            $b &= mysqli_query('',$line);
        }
    }
}