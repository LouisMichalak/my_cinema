<?php
function toSearchAFilm ($request, $withoutLimit)
{
    $request .= " titre LIKE '%".$_GET['title']."%'";
    if ($_GET['genre'] !== "")
    {
        $request .= " AND";
        $request .= " genre.nom LIKE '%".$_GET['genre']."%'";
    }
    if ($_GET['distributor'] !== "")
    {
        $request .= " AND";
        $request .= " distrib.nom LIKE '%".$_GET['distributor']."%'";
    }
    $offset = $_GET['pageNbr'] * $_GET['nbrResult'];
    if ($withoutLimit === false)
    {
        $request .= " LIMIT ".$_GET['nbrResult'];
        $request .= " OFFSET $offset";
    }
    return($request);
}
function writeResultsFilms()
{
    $request = buildRequest("film");
    $pdo = new DB();
    $headers = array();
    echo "<table>";
    foreach ($pdo->query($request) as $array)
    {
        echo "<th></th>";
        foreach ($array as $key => $value)
        {
            if (!in_array($key, $headers))
            {
                $headers[] = $key;
                echo "<th>$key</th>";
            }
        }
        echo "<tr class='rowsResult'>";
        echo "<td class='filmPoster'>".$array['titre']."</td>";
        foreach ($array as $key => $value)
        {
            echo "<td>".$value."</td>";
        }
        if (isset($_SESSION['login']))
        {
            echo "<td><a href='add_ons/addToMyHistoric.php?modifier=".$array['titre']."'>Add to my historic</a></td>";
            echo "<td><a href='interface_feedback.php?modifier=".$array['titre']."'>Feedbacks</a></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>