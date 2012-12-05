<form action="" class="formSearchRefined radiusBox greyC" id="formSearchRefined">
    <div class="stamp fushia">
        <h2>Affinez votre recherche</h2>
    </div>
    <p class="criteres"><span id="nbCrit">0</span> critère(s) séléctioné(s)</p>

    <!-- situation -->
        <p class="sectionTitle open first">Situation</p>
        <fieldset class="contentCrit" id="searchSituation">
            <label><input type="checkbox" name="checkSituation" id="SIT4">Proche des remontées mécaniques</label>
            <label><input type="checkbox" name="checkSituation" id="SIT2">Campagne</label>
            <label><input type="checkbox" name="checkSituation" id="SIT3">Montagne</label>
            <label><input type="checkbox" name="checkSituation" id="SIT5">Proche centre ville</label>
            <label><input type="checkbox" name="checkSituation" id="SIT1">Bord de mer</label>
            <label><input type="checkbox" name="checkSituation" id="SIT6">Ambiance village</label>
            <label><input type="checkbox" name="checkSituation" id="SIT7">Grands domaines skiables</label>
        </fieldset>

    <!-- destinations mmv -->
        <p class="sectionTitle open">Destinations mmv</p>
        <fieldset class="contentCrit" id="searchDestination">
            <p>Afficher les Destinations :</p>
            <label><span class="colorMontEte">&nbsp;</span><input type="checkbox" name="checkDestination" id="DST1">Montagne hiver</label>
            <label><span class="colorMontEte">&nbsp;</span><input type="checkbox" name="checkDestination" id="DST2">Montagne été</label>
            <label><span class="colorMontEte">&nbsp;</span><input type="checkbox" name="checkDestination" id="DST4">Languedoc</label>
            <label><span class="colorMontEte">&nbsp;</span><input type="checkbox" name="checkDestination" id="DST5">Manche &amp; Bretagne</label>
        </fieldset>

    <!-- formules mmv -->
        <p class="sectionTitle open">Formules mmv</p>
        <fieldset class="contentCrit" id="searchFormules">
                <label><input type="checkbox" name="checkFormules" id="LT"><span>Picto</span> Location</label>
        </fieldset>

    <!-- services -->
        <p class="sectionTitle open">Services</p>
        <fieldset class="contentCritPlus" id="searchServices">
            <label><input type="checkbox" name="checkServices" id="SRV1">Parking</label>
            <label><input type="checkbox" name="checkServices" id="SRV2">Sauna, Hammam, Jacuzzi</label>
            <label><input type="checkbox" name="checkServices" id="SRV4">Piscine hiver</label>
            <label><input type="checkbox" name="checkServices" id="SRV6">Club enfants</label>
            <label><input type="checkbox" name="checkServices" id="SRV7">Restaurant</label>
            <label><input type="checkbox" name="checkServices" id="SRV5">Piscine été</label>
        </fieldset>

    <!-- animations et loisirs -->
        <p class="sectionTitle open">Animations et loisirs</p>
        <fieldset class="contentCritPlus" id="searchAnimations">
            <label><input type="checkbox" name="checkAnimations" id="AL1">Rendez-vous mmv</label>
            <label><input type="checkbox" name="checkAnimations" id="AL3">Séances Aqua Zen</label>
            <label><input type="checkbox" name="checkAnimations" id="AL4">Programme randonnées</label>
            <label><input type="checkbox" name="checkAnimations" id="AL2">Activités découvertes</label>
        </fieldset>

    <!-- themes-->
        <p class="sectionTitle open">Thèmes</p>
        <fieldset class="contentCritPlus" id="searchThemes">
            <label><input type="checkbox" name="checkThemes" id="TH4">Bien-être</label>
            <label><input type="checkbox" name="checkThemes" id="TH3">A deux</label>
            <label><input type="checkbox" name="checkThemes" id="TH6">Culture et patrimoine</label>
            <label><input type="checkbox" name="checkThemes" id="TH2">Entre amis</label>
            <label><input type="checkbox" name="checkThemes" id="TH5">Séjour sportif</label>
            <label><input type="checkbox" name="checkThemes" id="TH1">En famille</label>
            <label><input type="checkbox" name="checkThemes" id="TH8">Randonnée</label>
        </fieldset>

    <!-- services a la carte -->
        <p class="sectionTitle open">Services à la carte</p>
        <fieldset class="contentCritPlus" id="searchServicesCarte">
            <label><input type="checkbox" name="checkServicesCarte" id="SC1">Soins et massages</label>
            <label><input type="checkbox" name="checkServicesCarte" id="SC2">Cours de ski ESF</label>
            <label><input type="checkbox" name="checkServicesCarte" id="SC3">Location matériel ski</label>
            <label><input type="checkbox" name="checkServicesCarte" id="SC4">Forfait ski</label>
            <label><input type="checkbox" name="checkServicesCarte" id="SC5">Services hôteliers</label>
        </fieldset>

    <!-- submit rechercher -->
    <button class="bt big sombre searchGlobalSubmit">Filtrer</button>
</form>