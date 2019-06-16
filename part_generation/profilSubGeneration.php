<?php
function subPartGeneration()
{
    $request = "SELECT * FROM membre INNER JOIN fiche_personne ON ".
        "membre.id_fiche_perso = fiche_personne.id_perso ".
        "WHERE fiche_personne.email LIKE '".$_SESSION['login']."'";
    $pdo = new DB();
    if (!isset($pdo->query($request)[0]))
    {
        echo "<p>How dare you, you are not subscribed yet! Being a subscriber "
            ."offers a lot of additional content on our site and you would als"
            . "o save money on your sessions.<br>".
            "To officially become a member of the community \"More than just".
            " PopCorn\", subscribe to one of the subscriptions below,".
            " you will get access to all our content!</p>";
        echo "<form method='get'><label for='abo'>Make a choice:</label>";
        echo "<select id='abo' name='abo'><option value=''>DO IT</option>";
        foreach ($pdo->query("SELECT nom, prix, duree_abo FROM abonnement")
                 as $array)
        {
            echo "<option value='".$array['nom']."'>"
                ."<li>The ".$array['nom']." for ".$array['duree_abo'].
                " days and ".$array['prix']." dollars.</li></option>";
        }
        echo "<input type='submit' value='My choice has been done'>".
            "</select><form>";
        subscribing("first");
    }
    else
    {
        abo_part($pdo->query($request)[0]);
    }
}
function abo_part($infos_membre)
{
    $pdo = new DB();
    $infos_abo = "SELECT nom, prix, duree_abo FROM abonnement WHERE id_abo = ".
        $infos_membre['id_abo'];
    $infos_abo = $pdo->query($infos_abo)[0];
    echo "You are a ".$infos_abo['nom'] ." subscriber for ".$infos_abo['prix'].
        " dollars, ".$infos_abo['duree_abo']." days of pure pleasure.";
    echo "Everybody knows that your subscription is the best, but, would you".
        " change for something 'better' suited for you?";
    echo "<form method='get'><label for='abo'>Change it in one click:</label>";
    echo "<select id='abo' name='abo'><option value=''>Subscriptions</option>";
    foreach ($pdo->query("SELECT nom, prix, duree_abo FROM abonnement")
             as $array)
    {
        if ($array['nom'] !== $infos_abo['nom'])
        {
            echo "<option value='".$array['nom']."'>"
                ."<li>The ".$array['nom']." for ".$array['duree_abo'].
                " days and ".$array['prix']." dollars.</li></option>";
        }
    }
    echo "<input type='submit' value='My choice has been done'>".
        "</select><form>";
    subscribing("change");
}
function subscribing($first_or_not)
{
    $pdo = new DB();
    $id_perso = "SELECT * FROM fiche_personne WHERE email LIKE '".
        $_SESSION['login']."'";
    $id_perso = $pdo->query($id_perso)[0]['id_perso'];
    if (isset($_GET['abo']) && $_GET['abo'] !== '' && $first_or_not == "first")
    {
        $id_membre = "SELECT id_membre + 1 FROM membre ORDER BY id_membre".
            " DESC LIMIT 1";
        $id_membre = $pdo->query($id_membre)[0]['id_membre + 1'];
        $request = "INSERT INTO membre (id_membre, id_fiche_perso,".
            "id_abo, date_abo)".
            "VALUES (".$id_membre.",".$id_perso.",".
            "(SELECT id_abo FROM abonnement WHERE nom = '". $_GET['abo']. "'),".
            "(SELECT NOW()))";
        $pdo->query($request);
        header('Location: http://localhost/myProfile.php');
    }
    elseif (isset($_GET['abo']) && $_GET['abo'] !== ''
        && $first_or_not == "change")
    {
        $request = "UPDATE membre SET id_abo = (SELECT id_abo FROM abonnement".
            " WHERE nom = '". $_GET['abo']. "') WHERE ".
            "id_fiche_perso = '".$id_perso."'";
        $pdo->query($request);
        header('Location: http://localhost/myProfile.php');
    }
}
?>