<div id="searchBloc" class="radiusBox fushia">
    <ul id="switchForm" class="clear">
        <li><a id="tabSearchBlocDate" class="active" href="#searchBlocDate"><span>Date</span></a></li>
        <li><a id="tabSearchBlocTrajet" href="#searchBlocTrajet"><span>Trajet</span></a></li>
        <li><a id="tabSearchBlocBudget" href="#searchBlocBudget"><span>Budget</span></a></li>
    </ul>
    <form id="searchBlocDate" action="#_">
        <fieldset>
            <div class="errors">
                <ul>
                    <li>La destination est requise.</li>
                    <li>La date de début de séjour est requise.</li>
                </ul>
            </div>
            <ol>
                <li>
                    <div id="datepicker" class="clear">
                        <input type="hidden" id="SearchDate_dateDebut"  name="SearchDate[dateDebut]" readonly="readonly" value="" />
                        <div id="datepickerField" class="clear">
                            <label for="datepickerInput">Date de début de séjour</label>
                            <input type="text" name="datepicker" id="datepickerInput" readonly="readonly" placeholder="Date de début de séjour" /><span class="date"></span>
                        </div>
                        <div id="datepickerCalendar">

                        </div>
                    </div>
                </li>
                <li>
                    <div id="SearchDate_selectContainer0" class="selectContainer clear">
                        <input type="hidden" id="SearchDate_duration_isBasseSaison" value="1" />
                        <label for="SearchDate_duration_isBasseSaison_0">Nombre de nuits</label>
                        <select id="SearchDate_duration_isBasseSaison_0" name="SearchDate[destination]" >
                            <option value="">Nombre de nuits</option>
                            <option value="3">3</option>
                            <option value="3">4</option>
                            <option value="3">7</option>
                            <option value="3">10</option>
                            <option value="3">11</option>
                            <option value="3">14</option>
                            <option value="3">17</option>
                            <option value="3">18</option>
                            <option value="3">21</option>
                            <option value="3">24</option>
                            <option value="3">25</option>
                            <option value="3">28</option>
                        </select>
                        <label for="SearchDate_duration_isBasseSaison_1">Nombre de nuits</label>
                        <select id="SearchDate_duration_isBasseSaison_1" name="SearchDate[destination]" >
                            <option value="">Nombre de nuits</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3">4</option>
                            <option value="3">7</option>
                            <option value="3">10</option>
                            <option value="3">11</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div id="SearchDate_selectContainer1" class="selectContainer clear">
                        <label for="SearchDate_destination">Destination</label>
                        <select id="SearchDate_destination" name="SearchDate[destination]" >
                            <option value="">Destination</option>
                            <option value="1">Destination 1</option>
                            <option value="2">Destination 2</option>
                            <option value="3">Destination 3</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div id="SearchDate_selectContainer2" class="selectContainer clear">
                        <input type="hidden" id="SearchDate_isCamping" value="0" />
                        <label for="SearchDate_ville">Lieux de séjour</label>
                        <select id="SearchDate_ville" name="SearchDate[ville]">
                            <option value="">Lieux de séjour</option>
                            <option value="1" class="optGroup-like">Pays de séjour 1</option>
                            <option value="2">Lieu de séjour 1</option>
                            <option value="3">Lieu de séjour 2</option>
                            <option value="4">Lieu de séjour 3</option>
                            <option value="5" class="optGroup-like">Pays de séjour 2</option>
                            <option value="6">Lieu de séjour 1</option>
                            <option value="7">Lieu de séjour 2</option>
                            <option value="8">Lieu de séjour 3</option>
                            <option value="9" class="optGroup-like">Pays de séjour 13</option>
                            <option value="10">Lieu de séjour 1</option>
                            <option value="11">Lieu de séjour 2</option>
                            <option value="12">Lieu de séjour 3</option>
                        </select>
                        <label for="SearchDate_camping">Campings</label>
                        <select id="SearchDate_camping" name="SearchDate[camping]">
                            <option value="">Campings</option>
                            <option value="1" class="optGroup-like">Pays de séjour 1</option>
                            <option value="2">Camping 1</option>
                            <option value="3">Camping 2</option>
                            <option value="3">Camping 3</option>
                        </select>
                        <div id="SearchDate_switch">
                            <span class="left">ou</span>
                            <div class="switchSelect tooltip" title="">
                                <span>Campings</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="spinner clear">
                        <label for="SearchDate_nbAdultes" class="left">Adulte(s)</label>
                        <button class="spin-bt-down left">-</button>
                        <input class="spin-tb left" type="text" id="SearchDate_nbAdultes" value="2">
                        <button class="spin-bt-up left">+</button>
                    </div>
                </li>
                <li>
                    <div class="spinner clear">
                        <label for="SearchDate_nbEnfants" class="left">Enfant(s)</label>
                        <button  class="spin-bt-down left">-</button>
                        <input class="spin-tb left" type="text" id="SearchDate_nbEnfants" value="0">
                        <button class="spin-bt-up left">+</button>
                    </div>
                </li>
                <li>
                    <div class="toggleContainer">

                        <div class="mainField">
                            <input type="checkbox" name="room_features[]" value="PMR-OUI" id="search_form_room_features">
                            <label for="search_form_room_features">Logements adaptés pour Personne à Mobilité Réduite</label>
                        </div>
                        <div class="mainField last">
                            <input type="checkbox" name="room_features[]" value="LBB-OUI" id="search_form_room_features_2">
                            <label for="search_form_room_features_2">Lit bébé</label>
                        </div>
                        <div class="floatField">
                            <input type="checkbox" name="options[]" value="PISC" id="check1">
                            <label for="check1">Piscine</label>
                        </div>
                        <div class="floatField">
                            <input type="checkbox" name="options[]" value="ESPF" id="check2">
                            <label for="check2">Espace Forme</label>
                        </div>
                        <div class="floatField">
                            <input type="checkbox" name="options[]" value="THAL" id="check3">
                            <label for="check3">Thalasso</label>
                        </div>

                    </div>
                    <a class="toggleButton" href="#">+ de critères</a>
                </li>
                <li>
                    <button type="submit" class="bt sombre big">Trouver</button>
                </li>
            </ol>




        </fieldset>
    </form>
    <form id="searchBlocTrajet" action="#_">
        <fieldset>

        </fieldset>
    </form>
    <form id="searchBlocBudget" action="#_">
        <fieldset>

        </fieldset>
    </form>
</div>

<script type="text/javascript">
    var fStartDate = '2013/03/01',
        fEndDate = '2013/10/31',
        fHighSeasonStartDate = '2013/06/29',    // must be a saturday
        fHighSeasonEndDate = '2013/08/31',      // must be a saturday
        linear = "reservation";
</script>
