<?php
$title = 'Vacances directes | Le mobil-home et vous';
$page = 'result';
include('includes/inc_header.php');
include('includes/top.php'); ?>

<div id="wrap" class="fixed-width clear">
    <!-- colonne gauche -->
        <div class="column left">
            <span class="nbResult"><span class="nb">07</span>Résultat(s)</span>
            <div class="typeAff">
                <span>Affichage résultats</span>
                <button class="button picto active">Liste</button>
                <button class="button picto">Carte</button>
            </div>
            <div id="widgetRange">
                Budget(s) proposé(s)
                <div id="noUiSlider" class="noUiSlider" data-range='{"minScale":0, "maxScale":500, "minStart":"0", "minStop":"500"}'></div>
            </div>

            <form id="filterTri" action="">
                <fieldset>
                    <label for="">Trier par</label>
                </fieldset>
            </form>

        </div>

    <!-- // colonne gauche -->
    <!-- colonne droite -->
        <aside class="column right">
            <?php include('blocs/search.php') ?>
        </aside>
    <!-- // colonne droite -->
    </div>

<?php include('includes/bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>

