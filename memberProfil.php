<?php
include "DBclass/commands_interface.php";
include "buildersSearchRequests/buildRequest.php";
include "buildersSearchRequests/buildRequestFilms.php";
include "buildersSearchRequests/buildRequestMembers.php";
include "linksPagesGestion/pagination.php";
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
    <main>
        <?php
        echo "<p>You are visiting the profil of ".
            ucfirst($_GET['prenom'])." ".ucfirst($_GET['LastName']).".</p>";
        getInfosAboutMember();
        ?>
    </main>
</body>
</html>