<?php
function profileGeneration()
{
    $request = "SELECT * FROM fiche_personne WHERE email LIKE '".$_SESSION['login']."'";
    echo "<ul>";
    $url = "http://localhost/myProfile.php";
    loopGenerationInfos($url, $request);
    echo "</ul>";
    editInfos();
}
function loopGenerationInfos($url, $request)
{
    $pdo = new DB();
    foreach ($pdo->query($request)[0] as $key => $value)
    {
        if ($key == "id_perso")
        {
            continue;
        }
        elseif ($_GET['modifier'] == $key)
        {
            echo "<li><form method='get'><strong><label for='".$key."'>".
                "$key: </label></strong>".
                "<input type='text' id='".$key."' name='".$key."' value='".
                $value."'><input type='submit' value='Edit'></form></li>";
        }
        else
        {
            echo "<li><strong>$key: $value </strong>".
                "<a href='".$url."?modifier=".$key."'>".
                "Modifier cette information</a></li>";
        }
    }
}
function editInfos()
{
    $value = "";
    $verifierAction = false;
    if (isset($_GET['nom']))
    {
        $value = "nom";
        $verifierAction = true;
    }
    elseif (isset($_GET['prenom']))
    {
        $value = "prenom";
        $verifierAction = true;
    }
    elseif (isset($_GET['ville']))
    {
        $value = "ville";
        $verifierAction = true;
    }
    elseif (isset($_GET['pays']))
    {
        $value = "pays";
        $verifierAction = true;
    }
    verifyGet($value, $verifierAction);
}
function verifyGet($value, $verifierAction)
{
    if (isset($_GET['email']))
    {
        $value = "email";
        $verifierAction = true;
    }
    elseif (isset($_GET['adresse']))
    {
        $value = "adresse";
        $verifierAction = true;
    }
    elseif (isset($_GET['cpostal']))
    {
        $value = "cpostal";
        $verifierAction = true;
    }
    finalEdits($value, $verifierAction);
}
function finalEdits($value, $verifierAction)
{

    if ($verifierAction === true)
    {
        $pdo = new DB();
        $pdo->query("UPDATE fiche_personne SET $value = '" .
            $_GET[$value]."' WHERE email LIKE '".$_SESSION['login']."'");
        if (in_array($value, array("prenom", "nom", "email")))
        {
            $pdo->query("UPDATE ids_utilisateur SET $value = '" .
                $_GET[$value]."'WHERE email LIKE '".$_SESSION['login']."'");
            if ($value == "email")
            {
                $_SESSION['login'] = $_GET[$value];
            }
        }
        header('Location: http://localhost/myProfile.php');
    }
}
?>