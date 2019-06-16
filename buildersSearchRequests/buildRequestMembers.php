<?php
function toSearchAMember($request, $withoutLimit)
{
    $request .= " prenom LIKE '%".$_GET['fstName']."%'";
    $request .= " AND";
    $request .= " fiche_personne.nom LIKE '%".$_GET['lstName']."%'";
    $offset = $_GET['pageNbr'] * $_GET['nbrResult'];
    if ($withoutLimit === false)
    {
        $request .= " LIMIT ".$_GET['nbrResult'];
        $request .= " OFFSET $offset";
    }
    return($request);
}
function writeResultsMembers()
{
    $request = buildRequest("member");
    $pdo = new DB();
    $headers = array();
    echo "<table>";
    $myDatas = '?';
    foreach ($pdo->query($request) as $array)
    {
        foreach ($array as $key => $value)
        {
            if (!in_array($key, $headers))
            {
                $headers[] = $key;
                echo "<th>$key</th>";
            }
        }
    }
    writeDataMembers($pdo, $request, $myDatas);
}
function writeDataMembers($pdo, $request, $myDatas)
{

    foreach ($pdo->query($request) as $array)
    {
        echo "<tr class='rowsResult'>";
        foreach ($array as $key => $value)
        {
            echo "<td>".$value."</td>";
            $myDatas .= $key ."=". $value ."&";
        }
        echo "<td><a href='memberProfil.php$myDatas'>Check the member's profil</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
function getInfosAboutMember()
{
    $fstRequest = "SELECT date_naissance, ville FROM fiche_personne WHERE ".
        "prenom = '".$_GET['prenom']."' AND nom = '".$_GET['LastName']."'";
    $sndRequest = "SELECT prix, duree_abo FROM abonnement ".
        "WHERE nom = '" . $_GET['Abonnement']."'";
    $thdRequest ="SELECT film.titre, SUBSTR(historique_membre.date,0,10) FROM".
        " historique_membre INNER JOIN membre ON ".
        "historique_membre.id_membre =".
        " membre.id_membre INNER JOIN fiche_personne ON membre.id_fiche_perso".
        " = fiche_personne.id_perso INNER JOIN film ON ".
        "historique_membre.id_film = film.id_film WHERE fiche_personne.nom ='".
        $_GET['LastName']."' && prenom = '" . $_GET['prenom']."'";
    writeInfos($fstRequest, $sndRequest, $thdRequest);
}
function writeInfos($fstRequest, $sndRequest, $thdRequest)
{
    $pdo = new DB();
    $fstRequest = $pdo->query($fstRequest)[0];
    echo ucfirst($_GET['prenom'])."  was born on ".
        substr($fstRequest['date_naissance'], 0, 10).
        " at ".$fstRequest['ville'].".";
    $sndRequest = $pdo->query($sndRequest)[0];
    echo "<br>He/She is a ".$_GET['Abonnement']." subscriber".
        ", for a total of ".$sndRequest['prix']." dollars (".
        $sndRequest['duree_abo']. " days).";
    echo "<h5>Historic of ". ucfirst($_GET['prenom']) .":</h5>";
    foreach ($pdo->query($thdRequest) as $array)
    {
        foreach ($array as $value)
        {
            echo $value . '<br>';
        }
    }
};
?>