<?php
$title = 'Vacances directes | Le mobil-home et vous';
$page = 'ce';
include('includes/inc_header.php');
include('includes/ce-top.php'); ?>

<div id="wrap" class="fixed-width clear" xmlns="http://www.w3.org/1999/html">

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

    <!-- colonne pleine largeur -->
    <div id="linearSwitcher">
        <p>
            <label>Rechercher de :</label>
            <input type = "radio"
                   name = "linearType"
                   id = "classicLinear"
                   value = "classic"
                   checked = "checked" />
            <label for = "classicLinear">linéaires classiques</label>
            <input type = "radio"
                   name = "linearType"
                   id = "miniLinear"
                   value = "mini" />
            <label for = "miniLinear">linéaires basse saison</label>
        </p>
    </div>

    <div id="searchContainer" class="column clearboth">
        <div id="searchPrincipal" class="searchBox classic">

            <form id="searchForm">
                <fieldset>
                    <legend>Recherche de linéaires classiques</legend>
                    <ol>
                        <li>
                            <div class="selectContainer clear">
                                <select name="selectCountry" onchange="">
                                    <option value="1">Country 1</option>
                                    <option value="2">Country 2</option>
                                    <option value="3">Country 3</option>
                                </select>
                                <select name="selectRegion" onchange="">
                                    <option value="1">Region 1</option>
                                    <option value="2">Region 2</option>
                                    <option value="3">Region 3</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="selectContainer clear">
                                <select multiple="multiple" name="selectCamping" onchange="">
                                    <option id="camping1" name="camping1" value="1" type="checkbox">Camping 1</option>
                                    <option id="camping2" name="camping2" value="2" type="checkbox">Camping 2</option>
                                    <option id="camping3" name="camping3" value="3" type="checkbox">Camping 3</option>
                                    <option id="camping4" name="camping4" value="4" type="checkbox">Camping 4</option>
                                    <option id="camping5" name="camping5" value="5" type="checkbox">Camping 5</option>
                                    <option id="camping6" name="camping6" value="6" type="checkbox">Camping 6</option>
                                    <option id="camping7" name="camping7" value="7" type="checkbox">Camping 7</option>
                                    <option id="camping8" name="camping8" value="8" type="checkbox">Camping 8</option>
                                    <option id="camping9" name="camping9" value="9" type="checkbox">Camping 9</option>
                                    <option id="camping10" name="camping10" value="10" type="checkbox">Camping 10</option>
                                </select>
                                <ul id="selectCamping">
                                    <li>Camping 1</li>
                                    <li>Camping 2</li>
                                    <li>Camping 3</li>
                                    <li>Camping 4</li>
                                    <li>Camping 5</li>
                                    <li>Camping 6</li>
                                    <li>Camping 7</li>
                                    <li>Camping 8</li>
                                    <li>Camping 9</li>
                                    <li>Camping 10</li>
                                </ul>
                            </div>

                            </p>
                        </li>
                        <li>
                            <label>Du</label><input class="date" type="text" name="datepicker-principal-arrival" id="datepicker-principal-arrival" />
                            <label>Au</label><input class="date" type="text" name="datepicker-principal-departure" id="datepicker-principal-departure" />
                            <button type=submit>Rechercher</button>
                        </li>
                    </ol>
                </fieldset>
            </form>
        </div>
<!--        <div id="datepickerPrincipal" class="datepicker clear"></div>-->
<!--        <div id="searchSecondary" class="searchBox">-->
<!--            <label>Du</label><input class="date" type="text" name="datepicker-secondary-arrival" id="datepicker-secondary-arrival" />-->
<!--            <label>Au</label><input class="date" type="text" name="datepicker-secondary-departure" id="datepicker-secondary-departure" />-->
<!--        </div>-->
<!--        <div id="datepickerSecondary" class="datepicker clear"></div>-->

    <!-- colonne pleine largeur -->

    <!-- colonne pleine largeur -->
    <div id="discoverContainer" class="column clearboth">

            <iframe width="960px" height="700px" src="/c2is/Cungfoo/web/ce_dev.php/resalys/wrapper?webuser=web_ce_achat_fr&amp;display=default&amp;tokens=ignore_token&amp;session=vacancesdirectes_preprod_v6_6_3Vxwpf4fVGJs5Z5I&amp;template=search_product_results&amp;actions=updateProductCriterias%3BgetProductProposals&amp;criterias_object_name=search_form&amp;product_CMSCriteria_ALL=ALL&amp;search_page=1&amp;product_CMSCriteria_PHS=&amp;product_start_date=10%2F10%2F2012"></iframe>

    </div>
    <!-- colonne pleine largeur -->
</div>

<?php include('includes/ce-bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>