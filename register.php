<?php
include "DBclass/commands_interface.php";
include "registerLoginLogout/registerRequest.php";
include "part_generation/header.php";
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <link rel="stylesheet" type="text/css" href="style/my_cinema.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts/script.js" type="text/javascript"></script>
    <title>Cinemathon</title>
</head>
<body>
    <?php
    headerGeneration();
    ?>
    <form>
        <ul>
            <li><label for="lstName">Lastname : </label><input type="text" name='fstName' id='fstName'></li>
            <li><label for="fstName">Firstname : </label><input type="text" name="lstName" id="lstName"></li>
            <li><label for="email">email : </label><input type="email" name="email" id="email" value="">
            <li><label for="pwd">PassWord : </label><input type="password" name="pwd" id="pwd" value="">
            <li><button type="submit">Register</button></li>
        </ul>
    </form>
    <div>
        <?php
        echo register();
        ?>
    </div>
</body>
</html>
