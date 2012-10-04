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

            <div itemscope itemtype="http://schema.org/Place">
                <h1 itemprop="name">Le Petit Mousse***</h1>
                <p class="keywordsFiche">Club enfants - Parc aquatique - Plage de mer - Accès wifi - Animaux acceptés</p>

                <a href="#semainier" class="bt big fushia right goto">Tarifs & disponibilités</a>

                <h2>Camping Vias</h2>
                <div class="geoDataFiche" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <span itemprop="addressCountry">France</span> |
                    <span itemprop="addressRegion">Languedoc-Roussillon</span> |
                    <span itemprop="postalCode">34450</span>
                    <span itemprop="addressLocality">Vias</span>
                    <button class="bt trans cfushia">Situer sur la carte</button>
                </div>
                <div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
                    <meta itemprop="latitude" content="40.75">
                    <meta itemprop="longitude" content="73.98">
                </div>
            </div>

            <div class="ratingFiche" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                Note :
                <span class="review rated">1</span>
                <span class="review rated">2</span>
                <span class="review rated">3</span>
                <span class="review rated">4</span>
                <span class="review">5</span>
                <meta itemprop="ratingValue" content="4">
                <a href="#_"><span class="reviewCount" itemprop="reviewCount">46</span> avis clients</a>
            </div>

            <ul class="tabControls clear">
                <li><a href="#tabCamp" class="active">Le camping</a></li>
                <li><a href="#tabLocation">Les locations</a></li>
                <li><a href="#tabSurplace">Sur place</a></li>
                <li><a href="#tabProximite">A proximité</a></li>
                <li><a href="#tabAvis">Avis</a></li>
                <li><a href="#tabInfos">Infos pratiques</a></li>
            </ul>

        <!-- tab Camping -->
            <div id="tabCamp" class="tabs">
                <div class="tabCampDiapo">
                    <div class="slider"><div class="slide clear">
                        <img src="http://pImg.devlint.fr/616x326/ff9191" width="616" height="326" alt="Camping 1" class="camping">
                        <img src="http://pImg.devlint.fr/616x326/ddd448" width="616" height="326" alt="Location 1" class="locations">
                        <img src="http://pImg.devlint.fr/616x326/ff9191" width="616" height="326" alt="Camping 2" class="camping">
                        <img src="http://pImg.devlint.fr/616x326/b7b2ab" width="616" height="326" alt="Activité 1" class="activites">
                        <img src="http://pImg.devlint.fr/616x326/3bbd38" width="616" height="326" alt="Régions 1" class="regions">
                        <img src="http://pImg.devlint.fr/616x326/3bbd38" width="616" height="326" alt="Régions 4" class="regions">
                        <img src="http://pImg.devlint.fr/616x326/ff9191" width="616" height="326" alt="Camping 3" class="camping">
                        <img src="http://pImg.devlint.fr/616x326/ff9191" width="616" height="326" alt="Camping 4" class="camping">
                        <img src="http://pImg.devlint.fr/616x326/ddd448" width="616" height="326" alt="Location 3" class="locations">
                        <img src="http://pImg.devlint.fr/616x326/b7b2ab" width="616" height="326" alt="Activité 3" class="activites">
                        <img src="http://pImg.devlint.fr/616x326/ddd448" width="616" height="326" alt="Location 2" class="locations">
                        <img src="http://pImg.devlint.fr/616x326/3bbd38" width="616" height="326" alt="Régions 3" class="regions">
                        <img src="http://pImg.devlint.fr/616x326/ddd448" width="616" height="326" alt="Location 4" class="locations">
                        <img src="http://pImg.devlint.fr/616x326/ddd448" width="616" height="326" alt="Location 5" class="locations">
                        <img src="http://pImg.devlint.fr/616x326/b7b2ab" width="616" height="326" alt="Activité 2" class="activites">
                        <img src="http://pImg.devlint.fr/616x326/b7b2ab" width="616" height="326" alt="Activité 4" class="activites">
                        <img src="http://pImg.devlint.fr/616x326/3bbd38" width="616" height="326" alt="Régions 2" class="regions">
                    </div></div>
                    <form class="tabCampDiapoOptions clear" action="#_">
                        <fieldset class="left">
                            <span>Photos</span>
                            <label for="photosToutes"><input type="radio" id="photosToutes" name="affPhoto" value="all" checked="checked">Toutes</label>
                            <label for="photosCamping"><input type="radio" id="photosCamping" name="affPhoto" value="camping">Camping</label>
                            <label for="photosLocations"><input type="radio" id="photosLocations" name="affPhoto" value="locations">Locations</label>
                            <label for="photosActivites"><input type="radio" id="photosActivites" name="affPhoto" value="activites">Activités</label>
                            <label for="photosRegions"><input type="radio" id="photosRegions" name="affPhoto" value="regions">Régions</label>
                        </fieldset>
                        <fieldset class="right">
                            <a class="popin tabCampVideo" href="#_">Vidéo</a>
                            <a class="popin tabCamp360" href="#_">360°</a>
                        </fieldset>
                    </form>
                </div>
                <div class="tabCampDesc">
                    <h3>Le camping Le Petit-Mousse, le paradis de l'eau</h3>
                    <h4>364 emplacements | Ouvert du 27 avril 2012 au 16 septembre 2012</h4>
                    <p>Depuis plus de 35 ans, Vacances directes propose la location en camping de mobil-homes tout confort et de qualité. Venez découvrir plus de 120 destinations sélectionnées avec soin en France, Espagne et Italie pour des vacances conviviales et reposantes. Apud has gentes, quarum exordiens initium ab Assyriis ad Nili cataractas porrigitur et confinia Blemmyarum, omnes pari sorte sunt bellatores seminudi coloratis sagulis pube tenus amicti, equorum adiumento pernicium graciliumque camelorum.</p>
                </div>

                <a href="#semainier" class="bt big fushia right goto">Tarifs & disponibilités</a>

                <div class="bloc gris">
                    <h3>Vous aimerez</h3>
                    <h4>comme</h4>
                    <div class="temoigFiche fish">
                        <span class="perso">Amélie</span>
                        <span class="age">10 ans</span>
                        <ul>
                            <li>- les activités du club enfant (5-12 ans)</li>
                            <li>- le toboggan aquatique</li>
                            <li>- l'équitation (2 km)</li>
                        </ul>
                    </div>
                    <div class="temoigFiche drink">
                        <span class="perso">Pierre</span>
                        <span class="age">36 ans</span>
                        <ul>
                            <li>- la location de vélos</li>
                            <li>- les barbecues collectifs</li>
                            <li>- le restaurant et le snacks</li>
                        </ul>
                    </div>
                    <div class="temoigFiche glass">
                        <span class="perso">Isabelle</span>
                        <span class="age">48 ans</span>
                        <ul>
                            <li>- l'accès direct à la plage</li>
                            <li>- l'accès wifi dans tout le camping</li>
                            <li>- la laverie</li>
                        </ul>
                    </div>
                    <a href="#_">Tous les plus du campings</a>
                    <hr>
                    <h4>Les vacances à Vias</h4>

                    <a href="#_">Tout savoir</a>
                </div>
            </div>
        <!-- tab Locations -->
            <div id="tabLocation" class="tabs">
                Tab Location
            </div>
        <!-- tab Sur place -->
            <div id="tabSurplace" class="tabs">
                Tab Sur place
            </div>
        <!-- tab A proximité -->
            <div id="tabProximite" class="tabs">
                Tab A proximité
            </div>
        <!-- tab Avis -->
            <div id="tabAvis" class="tabs">
                Tab Avis
            </div>
        <!-- tab Infos Pratiques -->
            <div id="tabInfos" class="tabs">
                Tab Infos Pratiques
            </div>

        <!-- Iframe Semainier Resalys -->
            <div id="semainier">
                <!-- ¤¤¤ iframe ¤¤¤ -->
            </div>
        </div>
    <!-- // colonne gauche -->
    <!-- colonne droite -->
        <aside class="column right">
            toto
        </aside>
    <!-- // colonne droite -->
    </div>

<?php include('includes/bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>