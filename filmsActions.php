<?php
include "DBclass/commands_interface.php";
include "buildersSearchRequests/buildRequest.php";
include "buildersSearchRequests/buildRequestFilms.php";
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
    <section class="searchFilm">
        <form method="get">
            <ul>
                <li><label for="title">Movie title: </label><input type="text" name="title" id="title"></li>
                <li><label for="genre">Movie genre: </label><input type="text" name="genre" id="genre"></li>
                <li><label for="distributor">Distributor: </label><input type="text" name="distributor" id="distributor"></li>
                <li><label for="nbrResult">Number of result: </label>
                    <select id="nbrResult" name="nbrResult">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </select></li>
                <li><button type="submit">Research</button></li>
            </ul>
            <input class="hidden" type="text" name="pageNbr" id="pageNbr" value="0">
        </form>
        <div>
            <ul>
                <?php
                if (isset($_GET['title']))
                {
                    pagination_links_interface("film");
                }
                ?>
            </ul>
        </div>
        <div class="searchResult">
            <?php
            writeResultsFilms();
            ?>
        </div>
    </section>
</body>
</html>