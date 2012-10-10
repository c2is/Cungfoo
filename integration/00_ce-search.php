<?php
$title = 'Vacances directes | Le mobil-home et vous';
$page = 'ce';
include('includes/inc_header.php');
include('includes/ce-top.php'); ?>

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
        </nav>

    </div>
    <!-- colonne pleine largeur -->

    <!-- colonne pleine largeur -->
    <div id="searchContainer" class="column clearboth">
        <div id="searchPrincipal" class="searchBox">
            <label>Du</label><input class="date" type="text" name="datepicker-principal-arrival" id="datepicker-principal-arrival" />
            <label>Au</label><input class="date" type="text" name="datepicker-principal-departure" id="datepicker-principal-departure" />
        </div>
        <div id="datepickerPrincipal" class="datepicker clear"></div>
        <div id="searchSecondary" class="searchBox">
            <label>Du</label><input class="date" type="text" name="datepicker-secondary-arrival" id="datepicker-secondary-arrival" />
            <label>Au</label><input class="date" type="text" name="datepicker-secondary-departure" id="datepicker-secondary-departure" />
        </div>
        <div id="datepickerSecondary" class="datepicker clear"></div>
    </div>
    <!-- colonne pleine largeur -->

    <!-- colonne pleine largeur -->
    <div id="discoverContainer" class="column clearboth">

    </div>
    <!-- colonne pleine largeur -->
</div>

<?php include('includes/ce-bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>