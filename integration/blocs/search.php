<div id="searchBloc">
    <ul id="switchForm">
        <li><a href="#searchBlocDate"></a></li>
        <li><a href="#searchBlocTrajet"></a></li>
        <li><a href="#searchBlocBudget"></a></li>
    </ul>
    <form id="searchBlocDate" action="#_">
        <fieldset>
            <input type="date" id="dateSejour" class="datePicker">
            <select name="listDestination" id="listDestination">
                <option value="">Destination</option>
                <option value="1">Destination 1</option>
                <option value="2">Destination 2</option>
                <option value="3">Destination 3</option>
            </select>
            <select name="listLieu" id="listLieu">
                <option value="">Lieu de séjour</option>
                <option value="1">Lieu de séjour 1</option>
                <option value="2">Lieu de séjour 2</option>
                <option value="3">Lieu de séjour 3</option>
            </select>
            <span class="ou">ou</span>
            <button id="switchListCampLieu">Camping/Lieu de séjour</button>
            <label for="nbAdults">Adulte(s)</label>
                <input id="nbAdults" class="spinner" type="number" value="2">
            <label for="nbChildren">Adulte(s)</label>
                <input id="nbChildren" class="spinner" type="number" value="2">
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
