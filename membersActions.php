<?php
include "DBclass/commands_interface.php";
include "buildersSearchRequests/buildRequest.php";
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
    <section class="searchMember">
        <form>
            <ul>
                <li><label for="fstName">Member firstname: </label><input type="text" name="fstName" id="fstName"></li>
                <li><label for="lstName">Member lastname: </label><input type="text" name="lstName" id="lstName"></li>
                <li><label for="nbrResult">Number of result: </label>
                    <select id="nbrResult" name="nbrResult">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </select></li>
                <li><button type="submit">Research</button></li>
                <input class="hidden" type="text" name="pageNbr" id="pageNbr" value="0">
            </ul>
        </form>
        <div>
            <ul>
                <?php
                if (isset($_GET['nom']))
                {
                    pagination_links_interface("member");
                }
                ?>
            </ul>
        </div>
        <div class="searchResult">
            <?php
            writeResultsMembers();
            ?>
        </div>
    </section>
</body>
</html>