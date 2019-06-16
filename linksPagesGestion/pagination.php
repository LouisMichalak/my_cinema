<?php
function pagination_links_interface($type)
{
    if ($type == "film")
    {
        $request = buildRequest("film", true);
    }
    if ($type == "member")
    {
        $request = buildRequest("member", true);
    }
    $pdo = new DB();
    $nbr = ceil(count($pdo->query($request)) / $_GET['nbrResult']);
    write_it($nbr);
}
function write_it($nbr)
{
    if ($_GET['pageNbr'] == 0)
    {
        echo "<li class='hidden'><button class='button_page'>&lt</button></li>";
    }
    else
    {
        echo "<li><button class='button_page'>&lt</button></li>";
    }
    write_links($nbr);
    if ($nbr > $_GET['pageNbr'] + 1)
    {
        echo "<li><button class='button_page'>&gt</button></button></li>";
    }
    else
    {
        echo "<li class='hidden'><button class='button_page'>&gt</button></li>";
    }
}
function write_links($nbr)
{
    $equal_pos = strrpos($_SERVER['HTTP_REFERER'], "=");
    $link = substr($_SERVER['HTTP_REFERER'], 0, $equal_pos + 1);
    for ($count = 0; $count < 5; $count++)
    {
        $innerForALot = $_GET['pageNbr'] + $count - 1;
        $innerLink = $_GET['pageNbr'] + $count - 2;
        $innerText = $count + 1;
        if ($_GET['pageNbr'] <= 2)
        {
            if ($count < $nbr)
            {
                echo "<li><a class='link_page' href='$link$count'>".
                    $innerText."</a></li>";
            }
        }
        else
        {
            if ($_GET['pageNbr'] + $count - 2 < $nbr)
            {
                echo "<li><a class='link_page' href='$link$innerLink'>".
                    $innerForALot."</a></li>";
            }
        }
    }
}
?>