<?php
include "DBclass/commands_interface.php";
include "part_generation/header.php";
include "part_generation/profileGeneration.php";
include "part_generation/profilSubGeneration.php";
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
        profileGeneration();
        ?>
    </main>
    <section>
        <?php
        subPartGeneration();
        ?>
    </section>
</body>
</html>
