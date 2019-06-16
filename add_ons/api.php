<?php
include "DBclass/commands_interface.php";
function apiAllocine()
{
    $pdo = new DB();
    $my_file = json_decode(file_get_contents("https://api.themoviedb.org/3/m".
        "ovie/now_playing?api_key=267ec9f80bdb9fbe984bcfd1ae90b535&language=e".
        "n-US&page=1-6"), true);
    $pdo->query("DELETE FROM grille_programme");
    foreach ($my_file['results'] as $index => $value)
    {
        $request_test="SELECT titre FROM film WHERE titre = '".$value['title']
            ."' && annee_prod = '".substr($value['release_date'], 0, 4)."'";
        programme($index, $value);
        if (isset($pdo->query($request_test)[0]))
        {
            continue;
        }
        $resum = str_replace("\"", "'", $value['overview']);
        $id_film=$pdo->query("SELECT id_film + 1 FROM film ORDER BY".
            " id_film DESC LIMIT 1")[0]['id_film + 1'];
        $insertfilm="INSERT INTO film (id_film, titre, resum, annee_prod) ".
            "VALUES (".$id_film.", \"".$value['title']."\", \""
            .$resum."\", '"
            .substr($value['release_date'], 0, 4)."')";
        $pdo->query($insertfilm);
    }
}
function programme($index, $value)
{
    $pdo = new DB();
    $end = $index + 2;
    $insertprogramme = "INSERT INTO grille_programme VALUES ((SELECT ".
        "id_film FROM film WHERE titre = '".$value['title']."'".
        " ORDER BY id_film DESC LIMIT 1),".
        rand(0, 16) ." , 96, 61, 205, '".$index ."h','". $end . "h')";
    $pdo->query($insertprogramme);
}
?>