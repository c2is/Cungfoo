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

            <form id=searchForm>
                <fieldset>
                    <legend>Recherche de linéaires classiques</legend>
                    <ol>
                        <li>
                            <div class="selectContainer clear"></div>
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
                            <p>
                                <input id="camping1" name="camping1" value="1" type="checkbox"><label for="camping1">Camping 1</label>
                            </p>
                            <p>
                                <input id="camping2" name="camping2" value="2" type="checkbox"><label for="camping2">Camping 2</label>
                            </p>
                            <p>
                                <input id="camping3" name="camping3" value="3" type="checkbox"><label for="camping3">Camping 3</label>
                            </p>
                            <p>
                                <input id="camping4" name="camping4" value="4" type="checkbox"><label for="camping4">Camping 4</label>
                            </p>
                            <p>
                                <input id="camping5" name="camping5" value="5" type="checkbox"><label for="camping5">Camping 5</label>
                            </p>
                            <p>
                                <input id="camping6" name="camping6" value="6" type="checkbox"><label for="camping6">Camping 6</label>
                            </p>
                            <p>
                                <input id="camping7" name="camping7" value="7" type="checkbox"><label for="camping7">Camping 7</label>
                            </p>
                            <p>
                                <input id="camping8" name="camping8" value="8" type="checkbox"><label for="camping8">Camping 8</label>
                            </p>
                            <p>
                                <input id="camping9" name="camping9" value="9" type="checkbox"><label for="camping9">Camping 9</label>
                            </p>
                            <p>
                                <input id="camping10" name="camping10" value="10" type="checkbox"><label for="camping10">Camping 10</label>
                            </p>
                        </li>
                        <li>
                            <label>Du</label><input class="date" type="text" name="datepicker-principal-arrival" id="datepicker-principal-arrival" />
                            <label>Au</label><input class="date" type="text" name="datepicker-principal-departure" id="datepicker-principal-departure" />
                            <button type=submit>Rechercher</button>
                        </li>

                    </ol>
                </fieldset>
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

            <iframe width="960px" height="700px" src="/c2is/Cungfoo/web/ce_dev.php/resalys/wrapper?webuser=web_ce_achat_fr&amp;display=default&amp;tokens=ignore_token&amp;session=vacancesdirectes_preprod_v6_6_3Vxwpf4fVGJs5Z5I&amp;template=search_product_results&amp;actions=updateProductCriterias%3BgetProductProposals&amp;criterias_object_name=search_form&amp;product_CMSCriteria_ALL=ALL&amp;search_page=1&amp;product_CMSCriteria_PHS=&amp;product_start_date=10%2F10%2F2012"></iframe>

    </div>
    <!-- colonne pleine largeur -->
</div>

<?php include('includes/ce-bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>