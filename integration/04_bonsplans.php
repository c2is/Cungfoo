<?php
    $title = 'Vacances directes | Le mobil-home et vous';
    $page = 'bonsplans';
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

            <h1>Faites le plein de bons plans</h1>
            <h2 class="h3-like">Prêt à vous faire plaisir à des prix mini ? A vos marques... partez !</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tempus lorem id odio vulputate sed malesuada diam pretium. In pharetra bibendum velit, in consequat odio ullamcorper molestie. Vivamus semper massa metus, eu malesuada lacus. Nunc eu arcu ipsum. Nunc cursus tortor a odio cursus malesuada. Nunc dui nunc, feugiat vitae luctus sed, vehicula nec nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vitae nunc libero, non vehicula metus. Vestibulum est risus, placerat vel vestibulum ac, euismod eget lacus. Vestibulum ante sapien, lobortis id vehicula non, accumsan sit amet augue. </p>
            <p>Suspendisse tellus eros, rutrum vel interdum quis, fermentum quis turpis. Aenean velit arcu, facilisis lacinia ullamcorper non, semper sit amet dolor. Sed nisl orci, malesuada nec hendrerit quis, rutrum non ligula. Donec eget velit dui, at condimentum sem. Phasellus vehicula fermentum consectetur. Maecenas sit amet commodo arcu. Aliquam erat volutpat. Quisque blandit, enim at gravida scelerisque, massa risus interdum mauris, sed volutpat metus dolor quis neque.</p>
        </div>
    <!-- // colonne gauche -->
    <!-- colonne droite -->
        <aside class="column right">
            <?php include('blocs/search.php') ?>
        </aside>
    <!-- // colonne droite -->
    <!-- colonne full -->
        <div class="column left">
            <h2 class="h3-like">Nos offres</h2>

            <div class="bonsplans itemResult clear">
                <div class="itemResultTitle">Vos vacances les pieds dans l'eau</div>
                img
                A partir de 952€
                <p>Suspendisse tellus eros, rutrum vel interdum quis, fermentum quis turpis. Aenean velit arcu, facilisis lacinia ullamcorper non, semper sit amet dolor. Sed nisl orci, malesuada nec hendrerit quis, rutrum non ligula.</p>
                <div class="bp_count">
                    <span>Plus que</span>
                    <span class="bp_jours"></span>
                    <span class="bp_heures"></span>
                    <span class="bp_minutes"></span>
                    <a href="#searchBlocDate" class="bt big popinBP">Voir l'offre</a>
                </div>
            </div>

        </div>
    <!-- // colonne full -->
    </div>

<?php include('includes/bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>

