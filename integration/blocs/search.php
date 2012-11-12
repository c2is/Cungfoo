<div id="searchBloc" class="radiusBox fushia">
    <ul id="switchForm" class="clear">
        <li><a id="tabSearchBlocDate" class="active" href="#searchBlocDate"><span>Date</span></a></li>
        <li><a id="tabSearchBlocTrajet" href="#searchBlocTrajet"><span>Trajet</span></a></li>
        <li><a id="tabSearchBlocBudget" href="#searchBlocBudget"><span>Budget</span></a></li>
    </ul>
    <form id="searchBlocDate" action="#_">
        <fieldset>
            <ol>
                <li>
                    <div id="datepicker" class="clear">
                        <input type="hidden" id="SearchDate_dateDebut"  name="SearchDate[dateDebut]" readonly="readonly" value="" />
                        <input type="hidden" id="SearchDate_dateFin"  name="SearchDate[dateFin]" readonly="readonly" value="" />
                        <div id="datepickerField" class="clear">
                            <input type="text" name="datepicker" id="datepickerInput" readonly="readonly" placeholder="Dates d'arrivée et de départ" /><span class="date"></span>
                        </div>
                        <div id="datepickerCalendar">

                        </div>
                    </div>
                </li>
                <li class="selectContainer clear">
                    <div class="selectContainer clear">
                        <select id="SearchDate_destination" name="SearchDate[destination]" >
                            <option value="">Destination</option>
                            <option value="1">Destination 1</option>
                            <option value="2">Destination 2</option>
                            <option value="3">Destination 3</option>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="selectContainer clear">
                        <select id="SearchDate_ville" name="SearchDate[ville]">
                            <option value="">Lieu de séjour</option>
                            <option value="1" class="country">Pays de séjour 1</option>
                            <option value="2">Lieu de séjour 1</option>
                            <option value="3">Lieu de séjour 2</option>
                            <option value="3">Lieu de séjour 3</option>
                        </select>
                        <select id="SearchDate_camping" name="SearchDate[camping]">
                            <option value="">Campings</option>
                            <option value="1" class="country">Pays de séjour 1</option>
                            <option value="2">Camping 1</option>
                            <option value="3">Camping 2</option>
                            <option value="3">Camping 3</option>
                        </select>
                    </div>
                    <span class="ou">ou</span>
                    <div id="switchVilleCamping" title=""></div>
                </li>
                <li>
                    <label for="SearchDate_nbAdultes">Adulte(s)</label>
                    <div class="spinner clear">
                        <div class="spin-bt-down left">-</div>
                        <input type="number" id="SearchDate_nbAdultes" class="left" value="2">
                        <div class="spin-bt-up left">+</div>
                    </div>
                </li>
                <li>
                    <label for="SearchDate_nbEnfants">Enfant(s)</label>
                    <div class="spinner clear">
                        <div class="spin-bt-down left">-</div>
                        <input type="number" id="SearchDate_nbEnfants" class="left" value="0">
                        <div class="spin-bt-up left">+</div>
                    </div>
                </li>
                <li>
                    <a href="#">+ de critères</a>
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
    var fStartDate = '2013/04/06',                  // must be a saturday
        fEndDate = '2013/10/26',                // must be a saturday
        linear = "reservation",
        numMinWeeks = 1;
</script>
