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
    <div class="divFormFilms">
        <button><a href="filmsActions.php">Search a film</a></button>
    </div>
    <div class="divFormMembers">
        <button><a href="membersActions.php">Search a member of our community</a></button>
    </div>
    <div class="films_affiche">
    </div>
    <div>
        <?php
        apiAllocine();
        ?>
    </div>
    <footer>
    </footer>
</body>
</html>