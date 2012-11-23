<?php
$title = 'Vacances directes | Le mobil-home et vous';
$page = 'booking';
include('includes/inc_header.php');
include('includes/booking-top.php'); ?>

<div id="wrap" class="fixed-width clear">

    <!-- colonne pleine largeur -->
    <div id="headerContainer" class="column">
        <div id="userBox">
            <span>M. CHAMALET - C2iS</span>
            <a class="bt fushia small right" href="#">Déconnexion</a>
        </div>
        <h1><span>Bienvenue dans l’espace </span>comité d’entreprise</h1>
        <nav id="nav" class="clearboth">
            <ul class="topnav fixed-width clear">
                <li class="tab current"><a href="#">Achats</a></li>
                <li class="tab"><a href="#">Documents</a></li>
                <li class="tab"><a href="#">Administration</a></li>
            </ul>

            <ul class="topnav topnavSub fixed-width clear">
                <li class="tab current"><a href="">Coordonnées</a></li>
                <li class="tab"><a href="">Suivi des achats</a></li>
            </ul>
        </nav>

    </div>
    <!-- colonne pleine largeur -->

</div>
    <script type="text/javascript">
        var fStartDate = '2013/04/06',                  // must be a saturday
                fEndDate = '2013/10/26',                // must be a saturday
                fHighSeasonStartDate = '2013/06/29',    // must be a saturday
                fHighSeasonEndDate = '2013/08/31',      // must be a saturday
                linear,
                numMinWeeks = 6;                       // minimum number of weeks selectable (for linear mini)
    </script>

    <?php include('includes/bottom.php'); ?>
    <?php include('includes/inc_footer.php'); ?>
