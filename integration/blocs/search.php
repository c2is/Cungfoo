<div id="searchBloc" class="radiusBox fushia">
    <ul id="switchForm" class="clear">
        <li><a id="tabSearchBlocDate" class="active" href="#searchBlocDate"><span>Date</span></a></li>
        <li><a id="tabSearchBlocTrajet" href="#searchBlocTrajet"><span>Trajet</span></a></li>
        <li><a id="tabSearchBlocBudget" href="#searchBlocBudget"><span>Budget</span></a></li>
    </ul>
    <form id="searchBlocDate" action="#_">
        <fieldset>
            <p>
                <div id="datepicker">
                    <!--                                <input class="hidden" type="hidden" id="AchatLineaire_dateDebut"  name="AchatLineaire[dateDebut]" readonly="readonly" value="22/06/2013" />-->
                    <!--                                <input class="hidden" type="hidden" id="AchatLineaire_dateFin"  name="AchatLineaire[dateFin]" readonly="readonly" value="31/08/2013" />-->
                    <input class="hidden" type="hidden" id="AchatLineaire_dateDebut"  name="AchatLineaire[dateDebut]" readonly="readonly" value="" />
                    <input class="hidden" type="hidden" id="AchatLineaire_dateFin"  name="AchatLineaire[dateFin]" readonly="readonly" value="" />
                    <div id="datepickerField" class="clear">
                        <input type="text" name="datepicker" id="datepickerInput" readonly="readonly" placeholder="Dates d'arrivée et de départ" /><span class="date"></span>
                    </div>
                    <div id="datepickerCalendar">

                    </div>
                </div>
            </p>
            <p>
                <select name="listDestination" id="listDestination">
                    <option value="">Destination</option>
                    <option value="1">Destination 1</option>
                    <option value="2">Destination 2</option>
                    <option value="3">Destination 3</option>
                </select>
            </p>
            <p>
                <select name="listLieu" id="listLieu">
                    <option value="">Lieu de séjour</option>
                    <option value="1">Lieu de séjour 1</option>
                    <option value="2">Lieu de séjour 2</option>
                    <option value="3">Lieu de séjour 3</option>
                </select>
                <span class="ou">ou</span>
                <button id="switchListCampLieu">Camping/Lieu de séjour</button>
            </p>
            <p>
                <label for="nbAdults">Adulte(s)</label>
                <input id="nbAdults" class="spinner" type="number" value="2">
            </p>
            <p>
                <label for="nbChildren">Adulte(s)</label>
                <input id="nbChildren" class="spinner" type="number" value="2">
            </p>
            <p>
                <a href="#">+ de critères</a>
                <button type="submit" class="bt sombre big">Trouver</button>
            </p>
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
    var fStartDate = '2013/04/06',                  // must be a saturday
        fEndDate = '2013/10/26',                // must be a saturday
        linear = "reservation",
        numMinWeeks = 1;
</script>
