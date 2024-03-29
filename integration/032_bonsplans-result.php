<?php
$title = 'Vacances directes | Le mobil-home et vous';
$page = 'result';
include('includes/inc_header.php');
include('includes/top.php'); ?>

<div id="wrap" class="fixed-width clear">
    <!-- colonne gauche -->
        <div class="column left">

            <ol class="pathway" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Accueil</span></a></li>
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title"Résultats de recherche">Résultats de recherche</span></a></li>
            </ol>

            <h1>Destination Espagne !</h1>

            <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tincidunt lobortis consequat. Nam a elit nunc. Sed at enim ac odio molestie rutrum non vitae dolor. Phasellus ac nisl massa. Morbi imperdiet nulla ac neque vulputate sagittis. Mauris ullamcorper aliquet ultricies. Sed ut lectus sed metus lobortis convallis. Cras lectus sapien, blandit non cursus ultricies, bibendum quis diam. Integer nec tortor in risus mollis luctus at nec justo. Suspendisse quis nunc eros. Mauris auctor scelerisque sapien eleifend mattis. Pellentesque dictum sollicitudin velit vitae adipiscing.</p>

            <img class="bdPict" src="../web/images/vacancesdirectes/dyn/results/bandeau-result-bonplan.jpg" alt="">

            <span class="nbResult"><span class="nb">07</span>Résultat(s)</span>
            <div class="typeAff">
                <span>Affichage résultats</span>
                <button id="btList" class="button picto active">Liste</button>
                <button id="btMap" class="button picto">Carte</button>
            </div>
            <div id="widgetRange">
                Budget(s) proposé(s)
                <div id="noUiSlider" class="noUiSlider" data-range='{"minScale":0, "maxScale":500, "minStart":"0", "minStop":"500"}'></div>
            </div>

            <div id="resultMap" class="gmap" style="width:616px;height:573px;">
                <script>
                    function resultInit() {
                        var resultMkrs = [
                            //['title', lat, lont, zindex, 'idAjaxCamping', couleurMarker]
                             ['Palavas Camping 1', 43.519863, 3.90937, 2, '/c2is/Cungfoo/web/index_dev.php/camping/infobox/4', markerFushia]
                            ,['Palavas Camping 2', 43.558998, 3.719444, 2, '/c2is/Cungfoo/web/index_dev.php/camping/infobox/2', markerVert]
                            ,['Palavas Camping 3', 43.649491, 4.025002, 2, '/c2is/Cungfoo/web/index_dev.php/camping/infobox/3', markerBleu]
                            ,['Palavas Camping 4', 43.667375, 3.621254, 2, '/c2is/Cungfoo/web/index_dev.php/camping/infobox/1', markerFushia]
                        ];
                        var centerresultMkr = new google.maps.LatLng(45.764544,4.846512),
                                mapOptions = {
                                    zoom: 6,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                                    center: centerresultMkr
                                };
                        resultMap = new google.maps.Map(document.getElementById('resultMap'), mapOptions);
                        setMarkers(resultMap, resultMkrs);
                    }
                </script>
            </div>

            <form id="filterTri" action="">
                <fieldset>
                    <label for="">Trier par</label>
                </fieldset>
            </form>

            <span class="infoComp">Comparateur</span>

            <div id="results" class="clear">
                <div data-id="/c2is/Cungfoo/web/index_dev.php/camping/infobox/4" class="itemResult clear" data-critplus="SRV1,SRV3,SRV7,AL1,TH4,TH3,TH2,TH5,SC1,SC2,SC3,SC4,SC5,TH1,AL2" data-crit="SIT4,SIT3,SIT7,DST1,">
                    <!-- item.title -->
                    <div class="itemResultTitle">
                        <input type="checkbox" name="compar" value="idCamp1">
                        Palavas Camping ******
                        <span class="dates">du 11/08/2012 au 28/08/2012</span>
                    </div>
                    <!-- item.left -->
                    <div class="itemResultLeft">
                        <img src="http://pimg.devlint.fr/135x98" alt="" class="boxborder">

                        <div class="ratingFiche" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            Note :
                            <span itemprop="ratingValue" content="4" title="4/5">
                                <span class="review rated">1</span>
                                <span class="review rated">2</span>
                                <span class="review rated">3</span>
                                <span class="review rated">4</span>
                                <span class="review">5</span>
                            </span>
                            <span class="reviewCount" itemprop="reviewCount">46</span> avis clients
                        </div>
                    </div>
                    <!-- item.center -->
                    <div class="itemResultCenter">
                        <p>- Accès direct à la plage</p>
                        <p>- Cadre boisé</p>
                        <p>- Parc aquatique</p>
                        <p>- Nombreuses animations</p>

                        <div class="pictos">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                        </div>

                        <a class="bt sombre" href="#_">Découvrir le camping</a>
                    </div>
                    <!-- item.right -->
                    <div class="itemResultRight">
                        <img width="75" height="77" alt="France &gt; Languedoc-Roussillon" src="../web/images/vacancesdirectes/dyn/miniCartes/languedoc-roussillon.png">
                        <span class="titDest"><a href="#_" title="France">France</a><br><a href="#_" title="Languedoc-roussilon">Languedoc-roussilon</a><br><a href="#_" class="ville" title="Palavas Les Flots">Palavas Les Flots</a></span>
                        <span class="bt trans">En savoir plus <br>sur la destination</span>

                        <div class="itemResultPopDest" style="display:none;"><div>
                            <h3>Pavalas Les Flots</h3>
                            <img height="94" width="185" alt="" src="http://pimg.devlint.fr/185x94/ccc/333/*" class="iDestImg1 boxborder">
                            <img height="81" width="116" alt="" src="http://pimg.devlint.fr/116x81/ccc/333/*" class="iDestImg2 boxborder">
                            <p>La ville de Palalas Les Flots, station balnéaire du sud de la France, est heureuse de vous accueillir sur ses plages ensoleillées.</p>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Mozart - Les Noces de Figaro - Opéra - Montpellier<br>
                                Du mercredi 20 juin 2012 au jeudi 28 juin 2012
                                <a class="bt trans" href="#_">Plus d'événements</a>
                            </div>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Visitez le parc zoologique de Montpellier
                                <a class="bt trans" href="#_">Plus de visites</a>
                            </div>

                            <div class="imanqPop">
                                <h4>&Agrave; ne pas manquer</h4>
                                <a class="bt trans" href="#_">14 sites à visiter</a>
                                <a class="bt trans" href="#_">24 activités</a>
                                <a class="bt trans" href="#_">14 événements</a>
                            </div>

                            <a class="bt big grisC" href="#_">Découvrir Palavas Les Flots</a>
                        </div></div>

                    </div>
                    <!-- item.bottom -->
                    <div class="itemResultBottom clear">
                        <div class="linePrice checked promotion">
                            <label for="camp1-1"><input type="radio" id="camp1-1" name="camp1" checked="checked"> Familial (mobil-home 6 places) <span class="price">952€</span></label>
                            <span class="stain fushia cover">
                                <span class="promo">-20%</span>
                                <span class="price">952€</span>
                                <span class="aulieude">au lieu de 1076€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp1-2"><input type="radio" id="camp1-2" name="camp1"> Vacancial (mobil-home 6 places) <span class="price">1141€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1141€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp1-3"><input type="radio" id="camp1-3" name="camp1"> Special (mobil-home 8 places) <span class="price">1141€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1141€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>

                    </div>
                </div>

                <div class="disclaim">
                    Utiliser le comparateur en cliquant sur
                    <img src="../web/images/vacancesdirectes/common/ui/tickCompar.png" alt="">
                </div>


                <div data-id="/c2is/Cungfoo/web/index_dev.php/camping/infobox/2" class="itemResult clear" data-critplus="SRV2,SRV6,SRV7,AL1,TH4,TH3,TH2,TH5,SC1,SC2,SC3,SC4,SC5,TH1,AL2" data-crit="SIT4,SIT3,SIT7,DST1,">
                    <!-- item.title -->
                    <div class="itemResultTitle">
                        <input type="checkbox" name="compar" value="idCamp1">
                        Palavas Camping ******
                        <span class="dates">du 11/08/2012 au 28/08/2012</span>
                    </div>
                    <!-- item.left -->
                    <div class="itemResultLeft">
                        <img src="http://pimg.devlint.fr/135x98" alt="" class="boxborder">

                        <div class="ratingFiche" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            Note :
                            <span itemprop="ratingValue" content="4" title="4/5">
                                <span class="review rated">1</span>
                                <span class="review rated">2</span>
                                <span class="review rated">3</span>
                                <span class="review rated">4</span>
                                <span class="review">5</span>
                            </span>
                            <span class="reviewCount" itemprop="reviewCount">46</span> avis clients
                        </div>
                    </div>
                    <!-- item.center -->
                    <div class="itemResultCenter">
                        <p>- Accès direct à la plage</p>
                        <p>- Cadre boisé</p>
                        <p>- Parc aquatique</p>
                        <p>- Nombreuses animations</p>

                        <div class="pictos">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                        </div>

                        <a class="bt sombre" href="#_">Découvrir le camping</a>
                    </div>
                    <!-- item.right -->
                    <div class="itemResultRight">
                        <img width="75" height="77" alt="France &gt; Languedoc-Roussillon" src="../web/images/vacancesdirectes/dyn/miniCartes/languedoc-roussillon.png">
                        <span class="titDest">France<br>Languedoc-roussilon<br>Palavs Les Flots</span>
                        <span class="bt trans">En savoir plus <br>sur la destination</span>

                        <div class="itemResultPopDest" style="display:none;"><div>
                            <h3>Pavalas Les Flots</h3>
                            <img height="94" width="185" alt="" src="http://pimg.devlint.fr/185x94/ccc/333/*" class="iDestImg1 boxborder">
                            <img height="81" width="116" alt="" src="http://pimg.devlint.fr/116x81/ccc/333/*" class="iDestImg2 boxborder">
                            <p>La ville de Palalas Les Flots, station balnéaire du sud de la France, est heureuse de vous accueillir sur ses plages ensoleillées.</p>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Mozart - Les Noces de Figaro - Opéra - Montpellier<br>
                                Du mercredi 20 juin 2012 au jeudi 28 juin 2012
                                <a class="bt trans" href="#_">Plus d'événements</a>
                            </div>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Visitez le parc zoologique de Montpellier
                                <a class="bt trans" href="#_">Plus de visites</a>
                            </div>

                            <div class="imanqPop">
                                <h4>&Agrave; ne pas manquer</h4>
                                <a class="bt trans" href="#_">14 sites à visiter</a>
                                <a class="bt trans" href="#_">24 activités</a>
                                <a class="bt trans" href="#_">14 événements</a>
                            </div>

                            <a class="bt big grisC" href="#_">Découvrir Palavas Les Flots</a>
                        </div></div>

                    </div>
                    <!-- item.bottom -->
                    <div class="itemResultBottom clear">
                        <div class="linePrice checked promotion">
                            <label for="camp2-1"><input type="radio" id="camp2-1" name="camp2" checked="checked"> Familial (mobil-home 6 places) <span class="price">852€</span></label>
                            <span class="stain fushia cover">
                                <span class="promo">-20%</span>
                                <span class="price">852€</span>
                                <span class="aulieude">au lieu de 1076€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp2-2"><input type="radio" id="camp2-2" name="camp2"> Vacancial (mobil-home 6 places) <span class="price">1000€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1000€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp2-3"><input type="radio" id="camp2-3" name="camp2"> Special (mobil-home 8 places) <span class="price">1041€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1041€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>

                    </div>
                </div>

                <div data-id="/c2is/Cungfoo/web/index_dev.php/camping/infobox/3" class="itemResult clear" data-critplus="SRV4,SRV5,AL1,TH4,TH3,TH2,TH5,SC1,SC2,SC3,SC4,SC5,TH1,AL2" data-crit="SIT4,SIT3,SIT7,DST1,">
                    <!-- item.title -->
                    <div class="itemResultTitle">
                        <input type="checkbox" name="compar" value="idCamp3">
                        Palavas Camping ******
                        <span class="dates">du 11/08/2012 au 28/08/2012</span>
                    </div>
                    <!-- item.left -->
                    <div class="itemResultLeft">
                        <img src="http://pimg.devlint.fr/135x98" alt="" class="boxborder">

                        <div class="ratingFiche" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            Note :
                            <span itemprop="ratingValue" content="4" title="4/5">
                                <span class="review rated">1</span>
                                <span class="review rated">2</span>
                                <span class="review rated">3</span>
                                <span class="review rated">4</span>
                                <span class="review">5</span>
                            </span>
                            <span class="reviewCount" itemprop="reviewCount">46</span> avis clients
                        </div>
                    </div>
                    <!-- item.center -->
                    <div class="itemResultCenter">
                        <p>- Accès direct à la plage</p>
                        <p>- Cadre boisé</p>
                        <p>- Parc aquatique</p>
                        <p>- Nombreuses animations</p>

                        <div class="pictos">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                        </div>

                        <a class="bt sombre" href="#_">Découvrir le camping</a>
                    </div>
                    <!-- item.right -->
                    <div class="itemResultRight">
                        <img width="75" height="77" alt="France &gt; Languedoc-Roussillon" src="../web/images/vacancesdirectes/dyn/miniCartes/languedoc-roussillon.png">
                        <span class="titDest">France<br>Languedoc-roussilon<br>Palavs Les Flots</span>
                        <span class="bt trans">En savoir plus <br>sur la destination</span>

                        <div class="itemResultPopDest" style="display:none;"><div>
                            <h3>Pavalas Les Flots</h3>
                            <img height="94" width="185" alt="" src="http://pimg.devlint.fr/185x94/ccc/333/*" class="iDestImg1 boxborder">
                            <img height="81" width="116" alt="" src="http://pimg.devlint.fr/116x81/ccc/333/*" class="iDestImg2 boxborder">
                            <p>La ville de Palalas Les Flots, station balnéaire du sud de la France, est heureuse de vous accueillir sur ses plages ensoleillées.</p>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Mozart - Les Noces de Figaro - Opéra - Montpellier<br>
                                Du mercredi 20 juin 2012 au jeudi 28 juin 2012
                                <a class="bt trans" href="#_">Plus d'événements</a>
                            </div>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Visitez le parc zoologique de Montpellier
                                <a class="bt trans" href="#_">Plus de visites</a>
                            </div>

                            <div class="imanqPop">
                                <h4>&Agrave; ne pas manquer</h4>
                                <a class="bt trans" href="#_">14 sites à visiter</a>
                                <a class="bt trans" href="#_">24 activités</a>
                                <a class="bt trans" href="#_">14 événements</a>
                            </div>

                            <a class="bt big grisC" href="#_">Découvrir Palavas Les Flots</a>
                        </div></div>

                    </div>
                    <!-- item.bottom -->
                    <div class="itemResultBottom clear">
                        <div class="linePrice checked promotion">
                            <label for="camp3-1"><input type="radio" id="camp3-1" name="camp3" checked="checked"> Familial (mobil-home 6 places) <span class="price">852€</span></label>
                            <span class="stain fushia cover">
                                <span class="promo">-20%</span>
                                <span class="price">852€</span>
                                <span class="aulieude">au lieu de 1076€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp3-2"><input type="radio" id="camp3-2" name="camp3"> Vacancial (mobil-home 6 places) <span class="price">1000€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1000€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp3-3"><input type="radio" id="camp3-3" name="camp3"> Special (mobil-home 8 places) <span class="price">1041€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1041€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>

                    </div>
                </div>


                <div data-id="/c2is/Cungfoo/web/index_dev.php/camping/infobox/1" class="itemResult clear" data-critplus="SRV1,SRV2,SRV3,AL1,TH4,TH3,TH2,TH5,SC1,SC2,SC3,SC4,SC5,TH1,AL2" data-crit="SIT4,SIT3,SIT7,DST1,">
                    <!-- item.title -->
                    <div class="itemResultTitle">
                        <input type="checkbox" name="compar" value="idCamp4">
                        Palavas Camping ******
                        <span class="dates">du 11/08/2012 au 28/08/2012</span>
                    </div>
                    <!-- item.left -->
                    <div class="itemResultLeft">
                        <img src="http://pimg.devlint.fr/135x98" alt="" class="boxborder">

                        <div class="ratingFiche" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                            Note :
                            <span itemprop="ratingValue" content="4" title="4/5">
                                <span class="review rated">1</span>
                                <span class="review rated">2</span>
                                <span class="review rated">3</span>
                                <span class="review rated">4</span>
                                <span class="review">5</span>
                            </span>
                            <span class="reviewCount" itemprop="reviewCount">46</span> avis clients
                        </div>
                    </div>
                    <!-- item.center -->
                    <div class="itemResultCenter">
                        <p>- Accès direct à la plage</p>
                        <p>- Cadre boisé</p>
                        <p>- Parc aquatique</p>
                        <p>- Nombreuses animations</p>

                        <div class="pictos">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                            <img src="../web/images/vacancesdirectes/dyn/results/picto.png" alt="">
                        </div>

                        <a class="bt sombre" href="#_">Découvrir le camping</a>
                    </div>
                    <!-- item.right -->
                    <div class="itemResultRight">
                        <img width="75" height="77" alt="France &gt; Languedoc-Roussillon" src="../web/images/vacancesdirectes/dyn/miniCartes/languedoc-roussillon.png">
                        <span class="titDest">France<br>Languedoc-roussilon<br>Palavs Les Flots</span>
                        <span class="bt trans">En savoir plus <br>sur la destination</span>

                        <div class="itemResultPopDest" style="display:none;"><div>
                            <h3>Pavalas Les Flots</h3>
                            <img height="94" width="185" alt="" src="http://pimg.devlint.fr/185x94/ccc/333/*" class="iDestImg1 boxborder">
                            <img height="81" width="116" alt="" src="http://pimg.devlint.fr/116x81/ccc/333/*" class="iDestImg2 boxborder">
                            <p>La ville de Palalas Les Flots, station balnéaire du sud de la France, est heureuse de vous accueillir sur ses plages ensoleillées.</p>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Mozart - Les Noces de Figaro - Opéra - Montpellier<br>
                                Du mercredi 20 juin 2012 au jeudi 28 juin 2012
                                <a class="bt trans" href="#_">Plus d'événements</a>
                            </div>

                            <div class="infoPop">
                                <img height="66" width="67" class="left boxborder" alt="toto" src="http://pimg.devlint.fr/67x66/ccc/333/*">
                                Visitez le parc zoologique de Montpellier
                                <a class="bt trans" href="#_">Plus de visites</a>
                            </div>

                            <div class="imanqPop">
                                <h4>&Agrave; ne pas manquer</h4>
                                <a class="bt trans" href="#_">14 sites à visiter</a>
                                <a class="bt trans" href="#_">24 activités</a>
                                <a class="bt trans" href="#_">14 événements</a>
                            </div>

                            <a class="bt big grisC" href="#_">Découvrir Palavas Les Flots</a>
                        </div></div>

                    </div>
                    <!-- item.bottom -->
                    <div class="itemResultBottom clear">
                        <div class="linePrice checked promotion">
                            <label for="camp4-1"><input type="radio" id="camp4-1" name="camp4" checked="checked"> Familial (mobil-home 6 places) <span class="price">852€</span></label>
                            <span class="stain fushia cover">
                                <span class="promo">-20%</span>
                                <span class="price">852€</span>
                                <span class="aulieude">au lieu de 1076€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp4-2"><input type="radio" id="camp4-2" name="camp4"> Vacancial (mobil-home 6 places) <span class="price">1000€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1000€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>
                        <div class="linePrice">
                            <label for="camp4-3"><input type="radio" id="camp4-3" name="camp4"> Special (mobil-home 8 places) <span class="price">1041€</span></label>
                            <span class="stain fushia cover">
                                <span class="price">1041€</span>
                            </span>
                            <a class="bt big" href="#_">Réserver</a>
                        </div>

                    </div>
                </div>

            </div><!-- // #result -->

            <button id="btPlusResults" class="bt big sombre">Plus de résultats</button>

        </div>

    <!-- // colonne gauche -->
    <!-- colonne droite -->
        <aside class="column right">
            <?php include('blocs/search.php') ?>
            <?php include('blocs/filterSearch.php') ?>
        </aside>
    <!-- // colonne droite -->
    </div>

<?php include('includes/bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>