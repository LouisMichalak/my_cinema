<?php
function getHistoric()
{
    $pdo = new DB();
    if (!isset($pdo->get_id_membre($_SESSION['login'])[0]))
    {
        echo "<p>You must be a subscriber to have an historic,".
            " to subscribe, go to the section \"My profile\"<p>";
    }
    else
    {
        foreach($pdo->get_historique($_SESSION['login']) as $array)
        {
            foreach ($array as $value)
            {
                echo $value . "<br>";
            }
        }
    }
}
?>