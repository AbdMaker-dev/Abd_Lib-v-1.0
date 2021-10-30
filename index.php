<?php
// Obligatoire:: toujour inclure Manager.php 
require_once "models/Manager.php";

// $user_dao = new UserDao();

// echo "<br><br> Insertion User avec add()<br>";
// $result =  $user_dao->add(["username"=>"Abd2020","password"=>"passer_1234"]);
// var_dump($result);

// echo "<br><br>Slecte All user avec  All()<br>";
// var_dump($user_dao->findAll());

$result =  file_get_contents('http://api.alquran.cloud/v1/quran/quran-uthmani', false, stream_context_create([
    'http' => [
        'method' => 'GET',
        'header'  => "Content-type: application/x-www-form-urlencoded"
    ]
]));

$surah_dao = new SurahDao();
$ayat_dao = new AyatDao();

$result = json_decode($result, true);
if ($result["data"] && $result["data"]["surahs"]) {
    foreach ($result["data"]["surahs"] as $surah) {
        // var_dump($surah);
        // echo "<br><br>Slecte All user avec-----------  All()<br>";
        $rslt = $surah_dao->add(["number"=>$surah["number"], "name"=>$surah["name"], "englishName"=>$surah["englishName"], "englishNameTranslation"=>$surah["englishNameTranslation"]]);
        if (rslt) {
           foreach ($surah["ayahs"] as $ayat) {
            $ayat_dao->add(["number"=>$ayat["number"],"text"=>$ayat["text"],"number_surah"=>$surah["number"]]);
           }
        }
    }
}
