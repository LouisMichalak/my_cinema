<?php
function register()
{
    if (!isset($_GET['lstName']) || $_GET['lstName'] == '')
    {
        return("Please fill out the entire form.");
    }
    elseif (!isset($_GET['fstName']) || $_GET['fstName'] == '')
    {
        return("Please fill out the entire form.");
    }
    elseif (!isset($_GET['email']) || $_GET['email'] == '')
    {
        return("Please fill out the entire form.");
    }
    elseif (!isset($_GET['pwd']) || $_GET['pwd'] == '')
    {
        return("Please fill out the entire form.");
    }
    return(correspondence_check());
}
function correspondence_check()
{
    $request = "SELECT email FROM ids_utilisateur WHERE email".
        " = '". $_GET['email']."'";
    $pdo = new DB();
    if (!isset($pdo->query($request)[0]))
    {
        return(final_Registration());
    }
    else
    {
        return("This email adress is already taken");
    }
}
function final_registration()
{
    $request_id = "INSERT INTO ids_utilisateur (prenom, nom, email, mdp,".
        " id_fiche_perso) VALUES ('".$_GET['fstName']."','".$_GET['lstName'].
        "','".$_GET['email']."','".$_GET['pwd']."',(SELECT id_perso + 1 FROM".
        " fiche_personne ORDER BY id_perso DESC LIMIT 1))";
    $request_fiche_perso ="INSERT INTO fiche_personne (id_perso, nom, prenom".
        ", email) VALUES ((SELECT id_fiche_perso + 1 FROM".
        " membre ORDER BY id_fiche_perso DESC LIMIT 1), '"
        .$_GET['lstName']."','". $_GET['fstName'] ."','". $_GET['email']."')";
    $pdo = new DB();
    $pdo->query($request_id);
    $pdo->query($request_fiche_perso);
    return("Success");
}
?>