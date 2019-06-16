<?php
function feedbacks ()
{
    $pdo = new DB();
    $request = "SELECT * FROM feedbacks WHERE titre = '".$_GET['modifier']."'";
    $feedbacks = $pdo->query($request);
    echo "<table>";
    foreach ($feedbacks[0] as $keys => $datas)
    {
        echo "<th>$keys</th>";
    }
    foreach ($feedbacks as $array)
    {
        echo "<tr>";
        foreach ($array as $data)
        {
            echo "<td>$data</td>";
        }
        echo "</tr>";
    }
}
function getFilm()
{
    echo "<input class='hidden' type='text' id='modifier' name='modifier' ".
        "value='".$_GET['modifier']."'>";
}
function feedBackAdd()
{
    if (isset($_GET['feedback']))
    {
        $pdo = new DB();
        $request = "INSERT INTO feedbacks VALUES('".$_SESSION['login']."', '".
        $_GET['modifier']."', '".$_GET['feedback']."')";
        $pdo->query($request);
        unset($_GET['feedback']);
    }
}
?>