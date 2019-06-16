<?php
function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("location: http://localhost/my_cinema.php");
}
logout();
?>