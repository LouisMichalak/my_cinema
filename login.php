<?php
include "DBclass/commands_interface.php";
include "registerLoginLogout/loginRequest.php";
include "part_generation/header.php";
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <link rel="stylesheet" type="text/css" href="style/my_cinema.css">
    <script src="scripts/script.js" type="text/javascript"></script>
    <title>Cinemathon</title>
</head>
<body>
    <?php
    headerGeneration();
    ?>
    <form>
        <ul>
            <li><label for="email">email : </label><input type="email" name="email" id="email" value="">
            <li><label for="pwd">PassWord : </label><input type="password" name="pwd" id="pwd" value="">
            <li><button type="submit">Register</button></li>
        </ul>
    </form>
    <div>
        <?php
            echo login();
        ?>
    </div>
</body>
</html>