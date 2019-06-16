<?php
function login()
{
    if (!isset($_GET['email']) || $_GET['email'] == '' ||
        !isset($_GET['pwd']) || $_GET['pwd'] == '')
    {
        return("Please fill out the entire form.");
    }
    $request = "SELECT email, mdp FROM ids_utilisateur WHERE email LIKE '".
        $_GET['email']."' && mdp = '".$_GET['pwd']."'";
    $pdo = new DB();
    if (isset($pdo->query($request)[0]['email']) &&
        isset($pdo->query($request)[0]['mdp']))
    {
        session_start();
        $_SESSION['login'] = $_GET['email'];
    }
    else
    {
        return('Login/password not correct.');
    }
    header("Location: my_cinema.php");
}
?>