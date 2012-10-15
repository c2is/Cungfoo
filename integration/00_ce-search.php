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
        <div class="searchBox full-width">

            <form id="searchForm" class="searchFrame">
                <fieldset>
                    <legend>Recherche de linéaires classiques</legend>
                    <ol>
                        <li>
                            <div class="selectContainer clear">
                                <select name="selectCountry" onchange="">
                                    <option value="">Country 1</option>
                                    <option value="2">Country 2</option>
                                    <option value="3">Country 3</option>
                                </select>
                                <select name="selectRegion" onchange="">
                                    <option value="1">Region 1</option>
                                    <option value="2">Region 2</option>
                                    <option value="3">Region 3</option>
                                    <option value="4">Languedoc-Roussillon </option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="selectContainer clear">
                                <select class="sMultSelect" id="AchatLineaire_campings" name="AchatLineaire[campings][]" multiple="multiple"><option value="1" selected="selected">Les Amiaux</option><option value="2">Pins Parasols </option><option value="3">Plage Fleurie </option><option value="4">Playa Montroig</option><option value="5">Playa Tropicana </option><option value="6">Port de plaisance</option><option value="7">La Ribeyre</option><option value="8">Le Roussillonnais </option><option value="9">Les Sables de Cordouan </option><option value="10">Azu'Rivage</option><option value="11">Saint Aygulf Plage</option><option value="12">Saint Louis</option><option value="13">Sainte Baume</option><option value="14">Le Sainte-Marie </option><option value="15">Le Sen Yan </option><option value="16">La Ferme de la Serraz </option><option value="17">Signol </option><option value="18">Le Soleil </option><option value="19">Le Soleil de la Méditerranée</option><option value="20">Le Bahia Club</option><option value="21">Les Sources </option><option value="22">Le Talaris </option><option value="23">Le Tamerici </option><option value="24">Tenuta Primero </option><option value="25">Ur Onea </option><option value="26">Via Romana </option><option value="27">Le Vieux Port </option><option value="28">Les Vignes </option><option value="29">Vilanova Park </option><option value="30">Zagarella</option><option value="31">Le Ruisseau des Pyrénées</option><option value="32">La Masia</option><option value="33">Les Tamaris</option><option value="34">Playa Joyel</option><option value="35">Grande Italia</option><option value="36">Le Pearl Village Club</option><option value="37">Les Pins Maritimes</option><option value="38">zz Le Barralet</option><option value="39">Beau Rivage </option><option value="40">zz Village Cavallino</option><option value="41">zz Aux Hamacs</option><option value="42">zz Prat Dou Rey</option><option value="43">zz Rouffiac</option><option value="44">zz Séquoia Parc</option><option value="45">zz Trémolat</option><option value="46">zz L'Atlantique</option><option value="47">zz Le Bahamas Beach</option><option value="48">zz La Barque</option><option value="49">zz Chanset</option><option value="50">Beaulieu </option><option value="51">zz Le Chêne Gris</option><option value="52">zz Les Dauphins Bleus</option><option value="53">zz Domaine de Beaulieu</option><option value="54">zz Le Lamparo</option><option value="55">zz Marmotel</option><option value="56">zz Les Ondines</option><option value="57">zz Pyla Camping</option><option value="58">zz La Rotonde</option><option value="59">zz Village Stoja</option><option value="60">zz Le Tamarit Park</option><option value="61">Bois Soleil</option><option value="62">zz Le Trivoly</option><option value="63">zz Almadies</option><option value="64">zz Bois de Pleuven</option><option value="65">zz Domaine de la Forêt</option><option value="66">zz Le Lac</option><option value="67">zz Rieu Montagné</option><option value="68">zz Domaine des Bans</option><option value="69">zz Douce Quiétude</option><option value="70">zz Fleutron</option><option value="71">zz Palmeraie</option><option value="72">Bordenéo </option><option value="73">zz Les Tours</option><option value="74">zz Abri de Camargue</option><option value="75">zz Domaine des Iscles</option><option value="76">zz Lacs du Verdon</option><option value="77">zz Les Pins Payrac</option><option value="78">Domaine des Pins</option><option value="79">Atlantic Club Montalivet</option><option value="80">Les Ajoncs d'Or</option><option value="81">Camping Les Biches</option><option value="82">La Bretonnière</option><option value="83">Le California</option><option value="84">Le Mas</option><option value="85">Le Calypso</option><option value="86">Camping du Lac </option><option value="87">Cap Agathois </option><option value="88">Le Carbonnier</option><option value="89">Castell Mar</option><option value="90">Castell Montgri </option><option value="91">Caussanel </option><option value="92">Cayola </option><option value="93">Le Chaponnet</option><option value="94">Domaine des Charmilles</option><option value="95">Le Cala Gogo</option><option value="96">Le Château de Galinée </option><option value="97">La Chênaie </option><option value="98">Les Chênes Verts </option><option value="99">Le Col Vert </option><option value="100">Le Conguel </option><option value="101">La Coste Rouge </option><option value="102">La Côte d'Argent </option><option value="103">Crin Blanc </option><option value="104">Cupulatta </option><option value="105">Les Cyprès </option><option value="106">Le Petit Mousse</option><option value="107">Les Deux Fontaines </option><option value="108">Les Deux Plages </option><option value="109">Domaine d'Inly </option><option value="110">Domaine d'Oléron </option><option value="111">Domaine de Chaussy </option><option value="112">Domaine de Kermario</option><option value="113">Domaine de la Rive</option><option value="114">Domaine de Léveno </option><option value="115">Domaine des Naïades</option><option value="116">Domaine du Cros d'Auzon </option><option value="117">Airotel Oléron</option><option value="118">Domaine du Verdon </option><option value="119">Les Dunes </option><option value="120">Eden </option><option value="121">Les Embruns </option><option value="122">Eurolac </option><option value="123">Le Fanal </option><option value="124">La Farigoulette </option><option value="125">Les Fontaines </option><option value="126">Les Frênes </option><option value="127">Front de Mer</option><option value="128">Aluna Vacances </option><option value="129">Grand'Terre </option><option value="130">Château de la Grenouillère </option><option value="131">Les Huttes </option><option value="132">L'Idéal </option><option value="133">Les Ilates</option><option value="134">Ilbarritz </option><option value="135">Internacional de Calonge </option><option value="136">Internacional Palamos </option><option value="137">Le Jard </option><option value="138">Les Amandiers</option><option value="139">Lac Bleu </option><option value="140">Lac de Miel </option><option value="141">Lac de Thoux St Cricq</option><option value="142">Land's Hause </option><option value="143">Lou Broustaricq </option><option value="144">Lou Pignada </option><option value="145">La Loubine </option><option value="146">Loyada </option><option value="147">Malazéou </option><option value="148">Mare e Pineta </option><option value="149">Sandaya Soulac Plage</option><option value="150">La Marine </option><option value="151">Les Marsouins</option><option value="152">Marze </option><option value="153">La Maïre </option><option value="154">Le Moulin</option><option value="155">Camping Neptuno </option><option value="156">L'Oasis</option><option value="157">L'Océano d'Or</option><option value="158">Oyam </option><option value="159">Les Oyats </option><option value="160">Ametlla</option><option value="161">Pachacaïd</option><option value="162">Domaine de la Paille Basse</option><option value="163">Le Palace </option><option value="164">Palavas Camping</option><option value="165">Le Parc </option><option value="166">Park Albatros </option><option value="167">Petit Bois (Ardèche)</option><option value="168">Petit Bois (Cantal)</option><option value="169">Le Pinada </option><option value="170">Les Pins </option><option value="171">zzz Fictif enregistrement Linéaire Liberté</option><option value="172">zzz Fictif enregistrement package</option><option value="173">zzz Fictif pour copie paramétrage</option><option value="174">Z Vacances directes</option><option value="175">Aqua Viva</option><option value="176">Arbousiers</option><option value="177">Aurilandes</option><option value="178">Baie du Kernic</option><option value="179">Bois d’Amour</option><option value="180">Le Castellas</option></select>
                            </div>
                        </li>
                        <li>
                            <div id="widget">
                                <input class="hidden" type="text" id="arrival"  name="arrival" readonly="readonly" />
                                <input class="hidden" type="text" id="departure"  name="departure" readonly="readonly" />
                                <div id="widgetField" class="clear">
                                    <input type="text" name="datepicker" id="widgetInput" readonly="readonly" /><span class="date"></span>
                                </div>
                                <div id="widgetCalendar">

                                </div>
                            </div>
                            <button type="submit" class="bt fushia">Rechercher</button>
                        </li>

                    </ol>
                </fieldset>
            </form>
            <div id="searchContent" class="searchFrame">
            </div>
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

<!--            <iframe id="frameResalys" width="960px" height="700px" src="/c2is/Cungfoo/web/ce_dev.php/resalys/wrapper?webuser=web_ce_achat_fr&amp;display=default&amp;tokens=ignore_token&amp;session=vacancesdirectes_preprod_v6_6_3Vxwpf4fVGJs5Z5I&amp;template=search_product_results&amp;actions=updateProductCriterias%3BgetProductProposals&amp;criterias_object_name=search_form&amp;product_CMSCriteria_ALL=ALL&amp;search_page=1&amp;product_CMSCriteria_PHS=&amp;product_start_date=10%2F10%2F2012"></iframe>-->

    </div>
    <!-- colonne pleine largeur -->
</div>

<?php include('includes/ce-bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>