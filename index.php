<?php
// Obligatoire:: toujour inclure Manager.php 
require_once "models/Manager.php";

$result =  file_get_contents('http://api.alquran.cloud/v1/quran/quran-uthmani', false, stream_context_create([
    'http' => [
        'method' => 'GET',
        'header'  => "Content-type: application/x-www-form-urlencoded"
    ]
]));

$result = json_decode($result, true);

if ($result["data"] && $result["data"]["surahs"]) {
    $surah_dao = new SurahDao();
    $ayat_dao = new AyatDao();
    foreach ($result["data"]["surahs"] as $surah) {
        $rslt = $surah_dao->add(["number"=>$surah["number"], "name"=>$surah["name"], "englishName"=>$surah["englishName"], "englishNameTranslation"=>$surah["englishNameTranslation"]]);
        if (rslt) {
           foreach ($surah["ayahs"] as $ayat) {
            $ayat_dao->add(["number"=>$ayat["number"],"text"=>$ayat["text"],"number_surah"=>$surah["number"]]);
           }
        }
    }
}
