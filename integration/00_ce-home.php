<?php
    $title = 'Vacances directes | Le mobil-home et vous';
    $page = 'ce';
    include('includes/inc_header.php');
    include('includes/ce-top.php'); ?>

    <div id="wrap" class="fixed-width clear">

    <!-- colonne pleine largeur -->
        <div class="column">
            <h1><span>Bienvenue dans l’espace </span>comité d’entreprise</h1>
        </div>

    <!--<div class="clear">-->
    <!-- colonne gauche -->
        <div class="column left">
            <div id="boxLogin" class="radiusBox greyC">
                <div class="stamp blue">
                    <h2>Identification</h2>
                </div>
                <form id="formLogin" class="clear">
                    <div class="left">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" name="identifiant" id="identifiant" />
                    <label for="password">Identifiant</label>
                    <input type="password" name="password" id="password" />
                    </div>
                    <div class="right">
                        <input class="bt big fushia" type="submit" value="Se connecter" />
                        <a href="#">Identifiant oublié ?</a><br />
                        <a href="#">Mote de passe oublié ?</a>
                    </div>

                </form>

            </div>
            <div id="boxDiscover" class="radiusBox greyC">
                <h2>Découvrez tous <span>nos produits</span><br >pensés pour <span>nos adhérents !</span></h2>
                <table>
                    <tr>
                        <th></th>
                        <th>Haute saison<br/>
                            <span>du 06/07/13 au 31/08/13</span></th>
                        <th>Basse saison<br/>
                            <span>avant le 06/07/13 et après 31/08/13</span></th>
                    </tr>
                    <tr>
                        <th class="label">Formules
                            linéaires</th>
                        <td><span class="rubric fushia">Classique</span></td>
                        <td><span class="rubric jaune">Mini</span></td>
                    </tr>
                    <tr>
                        <th>Formules
                            liberté</th>
                        <td><span class="rubric orange">Bouquet</span></td>
                        <td><span class="rubric vert">Package</span></td>
                    </tr>
                    <tr>
                        <th>Achats
                            ponctuels</th>
                        <td colspan="2"><span class="rubric violet">Coup par coup</span></td>
                    </tr>
                </table>
            </div>
        </div>
    <!-- // colonne gauche -->
    <!-- colonne droite -->
        <div class="column right">
            <div id="boxEdito" class="radiusBox greyC">
                <h2><span>L'édito</span></h2>
                <p>Chers partenaires,</p>
                <br />
                <p>Le secteur de l’hôtellerie de plein air connaît d’importantes mutations depuis 10 ans et notamment sur la qualité des prestations proposées (parcs aquatiques, club enfants, mobilhome...).</p>
                <p>C’est dans ce contexte que Village Center et Vacances Directes ont décidé de s’associer pour vous proposer l’offre la plus large et la plus exhaustive en hôtellerie de plein air, avec plus de 180 campings et résidences situés dans les plus belles régions de France, en Espagne et en Italie.</p>
                <p>Sélectionnés avec soin, ces établissements de qualité présentent tout le confort et la convivialité attendus, pour une offre que nous voulons toujours accessible au plus grand nombre.</p>
                <p>Attentifs à vos retours, nous avons revu nos produits spécialement conçus pour les comités d’entreprises et collectivités afin qu’ils correspondent au mieux à vos besoins et aux envies de chacun de vos salariés et leur famille.</p>
                <p>Nous avons aussi complété nos équipes pour vous apporter toute l’attention que vous pouvez attendre d’un professionnel du tourisme, leader sur son marché.</p>
                <p>Riche d’une longue expérience auprès des CE et collectivités, nous souhaitons vous apporter tout notre savoir-faire, et mettre à votre disposition des outils performants.</p>
                <p>Nous souhaitons donc à vos collaborateurs de très bonnes vacances dans les plus belles destinations de France, d’Espagne ou d’Italie dans le style qui leur convient le mieux : en emplacements, en mobil-homes, en chalets, en yourtes ou en écolodges...</p>
                <br />
                <p class="bold">Campingment votre...</p>
            </div>
        </div>
    <!-- // colonne droite -->
    <!--</div>-->
        <!-- colonne pleine largeur -->
        <div class="column clearboth">
            <a class="bt big fushia full" href="#semainier">Demandez vos identifiants pour accéder à votre espace !</a>
        </div>
        <!-- // colonne pleine largeur -->
    </div>

<?php include('includes/ce-bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>