<?php
function buildRequest($type, $withoutLimit = false)
{
    if ($type == "film")
    {
        $request = "SELECT titre, resum, annee_prod, genre.nom as genderName,".
            "distrib.nom AS distribName FROM".
            " film LEFT JOIN genre ON film.id_genre = genre.id_genre ".
            "LEFT JOIN distrib ON film.id_distrib = distrib.id_distrib WHERE";
        $request = toSearchAFilm($request, $withoutLimit);
    }
    elseif ($type == "member")
    {
        $request = "SELECT prenom, fiche_personne.nom AS LastName,".
            " abonnement.nom AS Abonnement ".
            "FROM fiche_personne INNER JOIN membre ON fiche_personne.id_perso = ".
            "membre.id_fiche_perso INNER JOIN abonnement ON membre.id_abo = ".
            "abonnement.id_abo WHERE";
        $request = toSearchAMember($request, $withoutLimit);
    }
    return($request);
}

?>