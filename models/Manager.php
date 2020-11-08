<?php
define("path",get_path(explode("/",$_SERVER['PHP_SELF'])));

try {
    //Chargement des classes
    spl_autoload_register(function ($class) {
        $patchLibs = path."database/libs/" . $class . ".php";
        $patchModels = path."models/" . $class . ".php";
        $patchDao = path."models/dao/" . $class . ".php";

        if (file_exists($patchModels)) {
            require_once($patchModels);
        } elseif (file_exists($patchLibs)){
            require_once($patchLibs);
        } elseif (file_exists($patchDao)) {
            require_once($patchDao);
        }
    });
} catch (\Throwable $th) {
    print_r($th);
}

function get_path($repertoire)
{
    $path = '';
    for ($i=(count($repertoire)-1); $i >=0 ; $i--) {
        if (file_exists($path."models/Manager.php")) {
            return $path;
        }
        $path = $path."../";
    }
    die("Fichier de configiration manquante");
}