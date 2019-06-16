<?php
include "DBclass/commands_interface.php";
include "part_generation/header.php";
include "add_ons/feedbacks_gestion.php";
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <link rel="stylesheet" type="text/css" href="style/my_cinema.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script rel="script" type="text/javascript" src="scripts"></script>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    headerGeneration();
    ?>
    <form method='get'>
        <label for='feedback'>Add a feedback on this film</label>
        <input type='text' id='feedback' name="feedback">
        <?php
        getFilm();
        ?>
        <button type="submit">Submit</button>
    </form>
    <?php feedBackAdd() ?>
    <div>
        <?php
        feedbacks();
        ?>
    </div>
    <footer>

    </footer>
</body>
</html>
