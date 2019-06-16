<?php
function headerGeneration()
{
    session_start();
    echo "<header class='header'><nav class='wrapper--header'>".
        "<ul class='header--nav'>";
    echo "<li><a href='my_cinema.php'>Accueil</a></li>";
    if (!isset($_SESSION['login']))
    {
        echo "<li><a href='register.php'>Register</a></li>";
        echo "<li><a href='login.php'>Login</a></li>";
    }
    else
    {
        echo "<li class='dropdown'>
             <a href='#' class='dropdownbtn'>".$_SESSION['login']."</a>
                <div class='dropdown-cnt'>
                    <a class='dropdown-link' ".
                    "href='myProfile.php'>My profile</a>
                    <a class='dropdown-link' ".
                    "href='historic.php'>My historic</a>
                    <a class='dropdown-link' ".
                    "href='registerLoginLogout/logout.php'>Logout</a>
                </div>
             </li>";
    }
    echo "</ul></div></header>";
}
?>