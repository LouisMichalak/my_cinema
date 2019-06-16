<?php
include "../part_generation/header.php";
include "../DBclass/commands_interface.php";
function addToHistoric()
{
    headerGeneration();
    $pdo = new DB();
    $filmName = $_GET['modifier'];
    $id_membre = $pdo->get_id_membre($_SESSION['login'])[0]['id_membre'];
    $id_film = "SELECT id_film FROM film WHERE titre = '".$filmName."'";
    $historique_membre = "INSERT INTO historique_membre VALUES (".$id_membre.
        ", (".$id_film."), (SELECT NOW()))";
    $membre = "UPDATE membre SET id_dernier_film = (".$id_film.
        "), date_dernier_film = (SELECT NOW()) WHERE id_membre =".
        " ".$id_membre;
    $pdo->query($historique_membre);
    $pdo->query($membre);
    header("location: ".$_SERVER['HTTP_REFERER']);
}
addToHistoric();
?>