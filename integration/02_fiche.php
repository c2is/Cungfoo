<?php
    $title = 'Vacances directes | Le mobil-home et vous';
    $page = 'fiche';
    include('includes/inc_header.php');
    include('includes/top.php'); ?>

    <div id="wrap" class="fixed-width clear">
    <!-- colonne gauche -->
        <div class="column left">
            <nav id="ficheShare">
                <a href="#_" class="icon facebook" title="Partager sur Facebook">Partager sur Facebook</a>
                <a href="#_" class="icon twitter" title="Partager sur Twitter">Partager sur Twitter</a>
                <a href="#_" class="icon email" title="Partager par email">Partager par email</a>
                <a href="#_" class="icon print" title="Imprimer">Imprimer</a>
            </nav>


            <a href="#semainier" class="bt gris left goto">&lt; Retour</a>

            <ol class="pathway" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Accueil</span></a></li>
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Nos campings : Campings France</span></a></li>
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Location mobil home Languedoc-Roussillon</span></a></li>
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Le Petit Mousse</span></a></li>
            </ol>

            <?php include('021_fiche-content.php') ?>

        <!-- Iframe Semainier Resalys -->
            <div id="semainier">
                <!-- ¤¤¤ iframe ¤¤¤ -->
            </div>
        </div>
    <!-- // colonne gauche -->
    <!-- colonne droite -->
        <aside class="column right">
            <?php include('blocs/ficheReservation.php'); ?>
            <?php include('blocs/search.php'); ?>
            <?php include('blocs/offreSpeciales.php'); ?>
            <?php include('blocs/dejaVu.php'); ?>
            <?php include('blocs/communaute.php'); ?>
            <?php include('blocs/vacancesReussies.php'); ?>
            <?php include('blocs/aimeriezAussi.php'); ?>
        </aside>
    <!-- // colonne droite -->
    </div>

<?php include('includes/bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>