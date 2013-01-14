<?php
$title = 'Vacances directes | Le mobil-home et vous';
$page = 'booking';
include('includes/inc_header.php');
include('includes/booking-top.php'); ?>
<div id="wrap" class="fixed-width clear">

    <!-- colonne pleine largeur -->
    <div id="headerContainer" class="column">
        <h1><span>Bienvenue dans l’espace </span>comité d’entreprise</h1>
        <nav id="stepNav" class="clearboth">
            <ul class="topnav fixed-width clear">
                <li class="tab completed"><span>Détails du séjour</span></li>
                <li class="tab completed"><span>Récapitulatif</span></li>
                <li class="tab current"><span>Paiement</span></li>
                <li class="tab"><span>Confirmation</span></li>
            </ul>
        </nav>
    </div>
    <!-- colonne pleine largeur -->

    <div class="column left" id="pageContener">

        <div id="contentContener">

            <div id="reservationContener">

                <div style="display: none" class="warning"></div>

                <div class="contentBlock radiusBox greyC" id="option">
                    <h2>Votre paiement</h2>
                    <h4>Montant du règlement : 275.84 €</h4>


                    <div id="authentication" class="contentBlock">
                        <h2>Identification</h2>
                        <div>


                            <div class="whiteBg">
                                <div class="authenticationChoice">
                                    <input type="radio" checked="" onclick="updateCustomerLayer();" value="1" id="returningCustomerYes" name="returning_customer" class="radio">
                                    <label for="returningCustomerYes">Vous êtes un client existant, veuillez vous identifier</label>
                                </div>
                                <div class="authenticationChoice">
                                    <input type="radio" onclick="updateCustomerLayer();" value="0" id="returningCustomerNo" name="returning_customer" class="radio">
                                    <label for="returningCustomerNo">Vous êtes un nouveau client, vous devez créer un compte</label>
                                </div>
                            </div>


                            <div class="clear" id="existingCustomerLayer" style="display: none;">
                                <p class="aField">
                                    <span class="label">Nom d'utilisateur</span><span class="field"><!--OBJ_existing_customer_login--><input type="text" size="30" maxlength="254" id="existing_customer_login" class="control_text" value="" name="existing_customer_login"><!--END_OBJ_existing_customer_login--></span>
                                </p>
                                <p class="aField">
                                    <span class="label">Mot de passe</span><span class="field"><input type="password" size="12" maxlength="16" id="existing_customer_password" value="" name="existing_customer_password" class="control_password"></span>
                                </p>
                                <p class="loginLink"><a href="javascript:submitDisplayForm('reservation_content', 'reservation_content', 'login', 'MTcyMTEzNTQ4NzA4MjAzNzI', 'checkCustomerLoginForm', null, null, 'http://10.63.1.231/c2is/Cungfoo/web/index_dev.php/resalys/wrapper/couloir', null, null);" class="bt fushia ib big">Se connecter</a></p>
                            </div>



                            <div class="clear" id="newCustomerLayer" style="">


                                <div id="newAccount">
                                    <h4>Nouveau compte</h4>
                                    <p class="aField">
                                        <span class="label">Nom d'utilisateur*</span><span class="field"><!--OBJ_login--><input type="text" size="30" maxlength="254" class="control_text" value="" name="login"><!--END_OBJ_login--></span>
                                        <span style="display: none" class="warning"></span>
                                    </p>
                                    <p class="aField">
                                        <span class="label">Mot de passe*</span><span class="field"><input type="password" size="12" maxlength="16" autocomplete="off" value="" name="password" class="control_password"></span>
                                    </p>
                                    <p class="aField">
                                        <span class="label">Confirmation*</span><span class="field"><input type="password" size="12" maxlength="16" value="" name="password2" class="control_password"></span>
                                    </p>
                                </div>


                                <div id="address">
                                    <h4>Vos coordonnées</h4>
                                    <table>



                                        <tbody><tr>
                                            <td class="label">Nom*</td>
                                            <td><!--OBJ_Nom--><input type="text" size="40" onchange=";formatText( 'Nom', null, 'reservation_content', 1 );" maxlength="30" id="Nom" class="control_text" value="" name="Nom"><!--END_OBJ_Nom--></td>
                                            <td class="label">Prénom*</td>
                                            <td><!--OBJ_Prenom--><input type="text" size="40" onchange=";formatText( 'Prenom', null, 'reservation_content', 3 );" maxlength="30" id="Prenom" class="control_text" value="" name="Prenom"><!--END_OBJ_Prenom--></td>
                                        </tr>
                                        <tr>
                                            <td class="label">Date de naissance</td>
                                            <td>
                                                <div class="datepicker tooltip" title="Format de la date DD/MM/YYYY">
                                                    <span class="rsl-date-input" style="white-space:nowrap;"><!--OBJ_reservation_content_date_creation--><input type="text" title="Format de la date DD/MM/YYYY" size="12" onchange=";;if(!checkAndUpdateDateField( this, 'DD/MM/YYYY' )) return false;" maxlength="10" id="reservation_content_date_creation" class="control_date hasDatepicker" value="13/04/1983" name="reservation_content_date_creation"><button type="button" class="ui-datepicker-trigger">...</button><!--END_OBJ_reservation_content_date_creation--><!--OBJ_date_sRowID_link--><a title="Format de la date DD/MM/YYYY" tabindex="999" onclick=";pCalendar.select(getFormObject('reservation_content_date_creation', 'reservation_content'),'reservation_content_date_creation','DD/MM/YYYY' );" href="javascript:void( null );" id="date_sRowID_link"><img class="calendarImage" alt="Calendrier" src="images/date_button.gif"></a><!--END_OBJ_date_sRowID_link--></span>
                                                    <span class="bubble">Format de la date DD/MM/YYYY</span>
                                                </div>
                                            </td>
                                            <td class="label">Langue</td>
                                            <td><!--OBJ_reservation_content_cd_langue--><select name="reservation_content_cd_langue" id="reservation_content_cd_langue" class="control_select" style="display: none;"><option value="DE">Allemand</option><option value="DK">Danois</option><option value="EN">Anglais</option><option value="ES">Espagnol</option><option selected="" value="FR">Francais</option><option value="IT">Italien</option><option value="NL">Néerlandais</option><option value="PT">Portuguais</option></select><div class="newListSelected" tabindex="0" style="position: static;"><div class="selectedTxt">Francais</div><div style="visibility: visible; top: 27px; height: 189px; left: 0px; display: none;" class="SSContainerDivWrapper"><ul class="newList" style="height: 189px;"><li><a href="JavaScript:void(0);">Allemand</a></li><li><a href="JavaScript:void(0);">Danois</a></li><li><a href="JavaScript:void(0);">Anglais</a></li><li><a href="JavaScript:void(0);">Espagnol</a></li><li><a href="JavaScript:void(0);" class="hiLite">Francais</a></li><li><a href="JavaScript:void(0);">Italien</a></li><li><a href="JavaScript:void(0);">Néerlandais</a></li><li><a href="JavaScript:void(0);">Portuguais</a></li></ul></div></div><!--END_OBJ_reservation_content_cd_langue--></td>
                                        </tr>
                                        <tr>
                                            <td class="label">Civilité</td>
                                            <td><!--OBJ_reservation_content_cd_civil--><select name="reservation_content_cd_civil" id="reservation_content_cd_civil" class="control_select" style="display: none;"><option selected="" value="">Veuillez sélectionner</option><option value="MM">Madame</option><option value="ML">Mademoiselle</option><option value="M">Monsieur</option></select><div class="newListSelected" tabindex="0" style="position: static;"><div class="selectedTxt">Veuillez sélectionner</div><div style="visibility: visible; top: 27px; height: 81px; left: 0px; display: none;" class="SSContainerDivWrapper"><ul class="newList" style="height: 81px;"><li><a href="JavaScript:void(0);" class="hiLite">Veuillez sélectionner</a></li><li><a href="JavaScript:void(0);">Madame</a></li><li><a href="JavaScript:void(0);">Mademoiselle</a></li><li><a href="JavaScript:void(0);">Monsieur</a></li></ul></div></div><!--END_OBJ_reservation_content_cd_civil--></td>
                                            <td class="label">Pays*</td>
                                            <td><!--OBJ_reservation_content_pol_address_country--><select name="reservation_content_pol_address_country" id="reservation_content_pol_address_country" class="control_select" style="display: none;"><option selected="" value="FR">France</option><option value="DE">Allemagne</option><option value="NL">Pays-Bas</option><option value="BE">Belgique</option><option value="CH">Suisse</option><option value="LU">Luxembourg</option><option value="ES">Espagne</option><option value="IT">Italie</option><option value="PT">Portugal</option><option value="AF">Afghanistan</option><option value="ZA">Afrique du Sud</option><option value="AL">Albanie</option><option value="DZ">Algérie</option><option value="DE">Allemagne</option><option value="AD">Andorre</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctique</option><option value="AG">Antigua-et-Barbuda</option><option value="AN">Antilles néerlandaises</option><option value="SA">Arabie saoudite</option><option value="AR">Argentine</option><option value="AM">Arménie</option><option value="AW">Aruba</option><option value="AU">Australie</option><option value="AT">Autriche</option><option value="AZ">Azerbaïdjan</option><option value="BS">Bahamas</option><option value="BH">Bahreïn</option><option value="BD">Bangladesh</option><option value="BB">Barbade</option><option value="BE">Belgique</option><option value="BZ">Belize</option><option value="BJ">Bénin</option><option value="BM">Bermudes</option><option value="BT">Bhoutan</option><option value="BY">Biélorussie</option><option value="MM">Birmanie</option><option value="BO">Bolivie</option><option value="BA">Bosnie-Herzégovine</option><option value="BW">Botswana</option><option value="BR">Brésil</option><option value="BN">Brunéi</option><option value="BG">Bulgarie</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodge</option><option value="CM">Cameroun</option><option value="CA">Canada</option><option value="CV">Cap-Vert</option><option value="CL">Chili</option><option value="CN">Chine</option><option value="CY">Chypre</option><option value="CO">Colombie</option><option value="KM">Comores</option><option value="CG">Congo (Congo-Brazzaville)</option><option value="KP">Corée du Nord</option><option value="KR">Corée du Sud</option><option value="CR">Costa Rica</option><option value="CI">Côte d'Ivoire</option><option value="HR">Croatie</option><option value="CU">Cuba</option><option value="DK">Danemark</option><option value="DJ">Djibouti</option><option value="DM">Dominique</option><option value="EG">Égypte</option><option value="AE">Émirats arabes unis</option><option value="EC">Équateur</option><option value="ER">Érythrée</option><option value="ES">Espagne</option><option value="EE">Estonie</option><option value="US">États-Unis</option><option value="ET">Éthiopie</option><option value="FJ">Fidji</option><option value="FI">Finlande</option><option selected="" value="FR">France</option><option value="GA">Gabon</option><option value="GM">Gambie</option><option value="GE">Géorgie</option><option value="GS">Géorgie et Îles Sandwich du Sud</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Grèce</option><option value="GD">Grenade</option><option value="GL">Groenland</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GN">Guinée</option><option value="GW">Guinée-Bissau</option><option value="GQ">Guinée équatoriale</option><option value="GY">Guyana</option><option value="GF">Guyane française</option><option value="HT">Haïti</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hongrie</option><option value="BV">Île Bouvet</option><option value="CX">Île Christmas</option><option value="NF">Île Norfolk</option><option value="AX">Îles Åland</option><option value="KY">Îles Caïmanes</option><option value="CC">Îles Cocos</option><option value="CK">Îles Cook</option><option value="FO">Îles Féroé</option><option value="HM">Îles Heard et McDonald</option><option value="FK">Îles Malouines (Falkland)</option><option value="MP">Îles Mariannes du Nord</option><option value="UM">Îles mineures des États-Unis</option><option value="SB">Îles Salomon</option><option value="TC">Îles Turques et Caïques</option><option value="VI">Îles Vierges américaines</option><option value="VG">Îles Vierges britanniques</option><option value="IN">Inde</option><option value="ID">Indonésie</option><option value="IR">Iran</option><option value="IQ">Iraq</option><option value="IE">Irlande</option><option value="IS">Islande</option><option value="IL">Israël</option><option value="IT">Italie</option><option value="JM">Jamaïque</option><option value="JP">Japon</option><option value="JO">Jordanie</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KG">Kirghizistan</option><option value="KI">Kiribati</option><option value="KW">Koweït</option><option value="LA">Laos</option><option value="LS">Lesotho</option><option value="LV">Lettonie</option><option value="LB">Liban</option><option value="LR">Liberia</option><option value="LY">Libye</option><option value="LI">Liechtenstein</option><option value="LT">Lituanie</option><option value="LU">Luxembourg</option><option value="MO">Macao</option><option value="MK">Macédoine</option><option value="MG">Madagascar</option><option value="MY">Malaisie</option><option value="MW">Malawi</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malte</option><option value="MA">Maroc</option><option value="MH">Marshall</option><option value="MQ">Martinique</option><option value="MU">Maurice</option><option value="MR">Mauritanie</option><option value="YT">Mayotte</option><option value="MX">Mexique</option><option value="FM">Micronésie</option><option value="MD">Moldavie</option><option value="MC">Monaco</option><option value="MN">Mongolie</option><option value="MS">Montserrat</option><option value="MZ">Mozambique</option><option value="NA">Namibie</option><option value="NR">Nauru</option><option value="NP">Népal</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NO">Norvège</option><option value="NC">Nouvelle-Calédonie</option><option value="NZ">Nouvelle-Zélande</option><option value="OM">Oman</option><option value="UG">Ouganda</option><option value="UZ">Ouzbékistan</option><option value="PK">Pakistan</option><option value="PW">Palaos</option><option value="PS">Palestine</option><option value="PA">Panama</option><option value="PG">Papouasie-Nouvelle-Guinée</option><option value="PY">Paraguay</option><option value="NL">Pays-Bas</option><option value="PE">Pérou</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Pologne</option><option value="PF">Polynésie française</option><option value="PR">Porto Rico</option><option value="PT">Portugal</option><option value="QA">Qatar</option><option value="CD">Rép. démocratique du Congo</option><option value="CF">République centrafricaine</option><option value="DO">République dominicaine</option><option value="CZ">République tchèque</option><option value="RE">Réunion</option><option value="RO">Roumanie</option><option value="GB">Royaume-Uni</option><option value="RU">Russie</option><option value="RW">Rwanda</option><option value="EH">Sahara occidental</option><option value="KN">Saint-Christophe-et-Niévès</option><option value="SH">Sainte-Hélène</option><option value="LC">Sainte-Lucie</option><option value="SM">Saint-Marin</option><option value="PM">Saint-Pierre-et-Miquelon</option><option value="VC">Saint-Vincent-et-les Grenadines</option><option value="SV">Salvador</option><option value="WS">Samoa</option><option value="AS">Samoa américaines</option><option value="ST">Sao Tomé-et-Principe</option><option value="SN">Sénégal</option><option value="RS">Serbie</option><option value="CS">Serbie-et-Monténégro</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapour</option><option value="SK">Slovaquie</option><option value="SI">Slovénie</option><option value="SO">Somalie</option><option value="SD">Soudan</option><option value="LK">Sri Lanka</option><option value="SE">Suède</option><option value="CH">Suisse</option><option value="SR">Suriname</option><option value="SJ">Svalbard et île Jan Mayen</option><option value="SZ">Swaziland</option><option value="SY">Syrie</option><option value="TJ">Tadjikistan</option><option value="TW">Taiwan</option><option value="TZ">Tanzanie</option><option value="TD">Tchad</option><option value="IO">Terr. brit. de l'océan Indien</option><option value="TF">Terres australes et antarctiques</option><option value="TH">Thaïlande</option><option value="TL">Timor oriental</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinité-et-Tobago</option><option value="TN">Tunisie</option><option value="TM">Turkménistan</option><option value="TR">Turquie</option><option value="TV">Tuvalu</option><option value="UA">Ukraine</option><option value="EU">Union européenne</option><option value="UY">Uruguay</option><option value="VU">Vanuatu</option><option value="VA">Vatican (Saint-Siège)</option><option value="VE">Venezuela</option><option value="VN">Viêt Nam</option><option value="WF">Wallis-et-Futuna</option><option value="YE">Yémen</option><option value="ZM">Zambie</option><option value="ZW">Zimbabwe</option></select><div class="newListSelected" tabindex="0" style="position: static;"><div class="selectedTxt">France</div><div style="visibility: visible; top: 27px; height: 300px; left: 0px; display: none;" class="SSContainerDivWrapper maxHeight"><ul class="newList" style="height: 300px;"><li><a href="JavaScript:void(0);">France</a></li><li><a href="JavaScript:void(0);">Allemagne</a></li><li><a href="JavaScript:void(0);">Pays-Bas</a></li><li><a href="JavaScript:void(0);">Belgique</a></li><li><a href="JavaScript:void(0);">Suisse</a></li><li><a href="JavaScript:void(0);">Luxembourg</a></li><li><a href="JavaScript:void(0);">Espagne</a></li><li><a href="JavaScript:void(0);">Italie</a></li><li><a href="JavaScript:void(0);">Portugal</a></li><li><a href="JavaScript:void(0);">Afghanistan</a></li><li><a href="JavaScript:void(0);">Afrique du Sud</a></li><li><a href="JavaScript:void(0);">Albanie</a></li><li><a href="JavaScript:void(0);">Algérie</a></li><li><a href="JavaScript:void(0);">Allemagne</a></li><li><a href="JavaScript:void(0);">Andorre</a></li><li><a href="JavaScript:void(0);">Angola</a></li><li><a href="JavaScript:void(0);">Anguilla</a></li><li><a href="JavaScript:void(0);">Antarctique</a></li><li><a href="JavaScript:void(0);">Antigua-et-Barbuda</a></li><li><a href="JavaScript:void(0);">Antilles néerlandaises</a></li><li><a href="JavaScript:void(0);">Arabie saoudite</a></li><li><a href="JavaScript:void(0);">Argentine</a></li><li><a href="JavaScript:void(0);">Arménie</a></li><li><a href="JavaScript:void(0);">Aruba</a></li><li><a href="JavaScript:void(0);">Australie</a></li><li><a href="JavaScript:void(0);">Autriche</a></li><li><a href="JavaScript:void(0);">Azerbaïdjan</a></li><li><a href="JavaScript:void(0);">Bahamas</a></li><li><a href="JavaScript:void(0);">Bahreïn</a></li><li><a href="JavaScript:void(0);">Bangladesh</a></li><li><a href="JavaScript:void(0);">Barbade</a></li><li><a href="JavaScript:void(0);">Belgique</a></li><li><a href="JavaScript:void(0);">Belize</a></li><li><a href="JavaScript:void(0);">Bénin</a></li><li><a href="JavaScript:void(0);">Bermudes</a></li><li><a href="JavaScript:void(0);">Bhoutan</a></li><li><a href="JavaScript:void(0);">Biélorussie</a></li><li><a href="JavaScript:void(0);">Birmanie</a></li><li><a href="JavaScript:void(0);">Bolivie</a></li><li><a href="JavaScript:void(0);">Bosnie-Herzégovine</a></li><li><a href="JavaScript:void(0);">Botswana</a></li><li><a href="JavaScript:void(0);">Brésil</a></li><li><a href="JavaScript:void(0);">Brunéi</a></li><li><a href="JavaScript:void(0);">Bulgarie</a></li><li><a href="JavaScript:void(0);">Burkina Faso</a></li><li><a href="JavaScript:void(0);">Burundi</a></li><li><a href="JavaScript:void(0);">Cambodge</a></li><li><a href="JavaScript:void(0);">Cameroun</a></li><li><a href="JavaScript:void(0);">Canada</a></li><li><a href="JavaScript:void(0);">Cap-Vert</a></li><li><a href="JavaScript:void(0);">Chili</a></li><li><a href="JavaScript:void(0);">Chine</a></li><li><a href="JavaScript:void(0);">Chypre</a></li><li><a href="JavaScript:void(0);">Colombie</a></li><li><a href="JavaScript:void(0);">Comores</a></li><li><a href="JavaScript:void(0);">Congo (Congo-Brazzaville)</a></li><li><a href="JavaScript:void(0);">Corée du Nord</a></li><li><a href="JavaScript:void(0);">Corée du Sud</a></li><li><a href="JavaScript:void(0);">Costa Rica</a></li><li><a href="JavaScript:void(0);">Côte d'Ivoire</a></li><li><a href="JavaScript:void(0);">Croatie</a></li><li><a href="JavaScript:void(0);">Cuba</a></li><li><a href="JavaScript:void(0);">Danemark</a></li><li><a href="JavaScript:void(0);">Djibouti</a></li><li><a href="JavaScript:void(0);">Dominique</a></li><li><a href="JavaScript:void(0);">Égypte</a></li><li><a href="JavaScript:void(0);">Émirats arabes unis</a></li><li><a href="JavaScript:void(0);">Équateur</a></li><li><a href="JavaScript:void(0);">Érythrée</a></li><li><a href="JavaScript:void(0);">Espagne</a></li><li><a href="JavaScript:void(0);">Estonie</a></li><li><a href="JavaScript:void(0);">États-Unis</a></li><li><a href="JavaScript:void(0);">Éthiopie</a></li><li><a href="JavaScript:void(0);">Fidji</a></li><li><a href="JavaScript:void(0);">Finlande</a></li><li><a href="JavaScript:void(0);" class="hiLite">France</a></li><li><a href="JavaScript:void(0);">Gabon</a></li><li><a href="JavaScript:void(0);">Gambie</a></li><li><a href="JavaScript:void(0);">Géorgie</a></li><li><a href="JavaScript:void(0);">Géorgie et Îles Sandwich du Sud</a></li><li><a href="JavaScript:void(0);">Ghana</a></li><li><a href="JavaScript:void(0);">Gibraltar</a></li><li><a href="JavaScript:void(0);">Grèce</a></li><li><a href="JavaScript:void(0);">Grenade</a></li><li><a href="JavaScript:void(0);">Groenland</a></li><li><a href="JavaScript:void(0);">Guadeloupe</a></li><li><a href="JavaScript:void(0);">Guam</a></li><li><a href="JavaScript:void(0);">Guatemala</a></li><li><a href="JavaScript:void(0);">Guinée</a></li><li><a href="JavaScript:void(0);">Guinée-Bissau</a></li><li><a href="JavaScript:void(0);">Guinée équatoriale</a></li><li><a href="JavaScript:void(0);">Guyana</a></li><li><a href="JavaScript:void(0);">Guyane française</a></li><li><a href="JavaScript:void(0);">Haïti</a></li><li><a href="JavaScript:void(0);">Honduras</a></li><li><a href="JavaScript:void(0);">Hong Kong</a></li><li><a href="JavaScript:void(0);">Hongrie</a></li><li><a href="JavaScript:void(0);">Île Bouvet</a></li><li><a href="JavaScript:void(0);">Île Christmas</a></li><li><a href="JavaScript:void(0);">Île Norfolk</a></li><li><a href="JavaScript:void(0);">Îles Åland</a></li><li><a href="JavaScript:void(0);">Îles Caïmanes</a></li><li><a href="JavaScript:void(0);">Îles Cocos</a></li><li><a href="JavaScript:void(0);">Îles Cook</a></li><li><a href="JavaScript:void(0);">Îles Féroé</a></li><li><a href="JavaScript:void(0);">Îles Heard et McDonald</a></li><li><a href="JavaScript:void(0);">Îles Malouines (Falkland)</a></li><li><a href="JavaScript:void(0);">Îles Mariannes du Nord</a></li><li><a href="JavaScript:void(0);">Îles mineures des États-Unis</a></li><li><a href="JavaScript:void(0);">Îles Salomon</a></li><li><a href="JavaScript:void(0);">Îles Turques et Caïques</a></li><li><a href="JavaScript:void(0);">Îles Vierges américaines</a></li><li><a href="JavaScript:void(0);">Îles Vierges britanniques</a></li><li><a href="JavaScript:void(0);">Inde</a></li><li><a href="JavaScript:void(0);">Indonésie</a></li><li><a href="JavaScript:void(0);">Iran</a></li><li><a href="JavaScript:void(0);">Iraq</a></li><li><a href="JavaScript:void(0);">Irlande</a></li><li><a href="JavaScript:void(0);">Islande</a></li><li><a href="JavaScript:void(0);">Israël</a></li><li><a href="JavaScript:void(0);">Italie</a></li><li><a href="JavaScript:void(0);">Jamaïque</a></li><li><a href="JavaScript:void(0);">Japon</a></li><li><a href="JavaScript:void(0);">Jordanie</a></li><li><a href="JavaScript:void(0);">Kazakhstan</a></li><li><a href="JavaScript:void(0);">Kenya</a></li><li><a href="JavaScript:void(0);">Kirghizistan</a></li><li><a href="JavaScript:void(0);">Kiribati</a></li><li><a href="JavaScript:void(0);">Koweït</a></li><li><a href="JavaScript:void(0);">Laos</a></li><li><a href="JavaScript:void(0);">Lesotho</a></li><li><a href="JavaScript:void(0);">Lettonie</a></li><li><a href="JavaScript:void(0);">Liban</a></li><li><a href="JavaScript:void(0);">Liberia</a></li><li><a href="JavaScript:void(0);">Libye</a></li><li><a href="JavaScript:void(0);">Liechtenstein</a></li><li><a href="JavaScript:void(0);">Lituanie</a></li><li><a href="JavaScript:void(0);">Luxembourg</a></li><li><a href="JavaScript:void(0);">Macao</a></li><li><a href="JavaScript:void(0);">Macédoine</a></li><li><a href="JavaScript:void(0);">Madagascar</a></li><li><a href="JavaScript:void(0);">Malaisie</a></li><li><a href="JavaScript:void(0);">Malawi</a></li><li><a href="JavaScript:void(0);">Maldives</a></li><li><a href="JavaScript:void(0);">Mali</a></li><li><a href="JavaScript:void(0);">Malte</a></li><li><a href="JavaScript:void(0);">Maroc</a></li><li><a href="JavaScript:void(0);">Marshall</a></li><li><a href="JavaScript:void(0);">Martinique</a></li><li><a href="JavaScript:void(0);">Maurice</a></li><li><a href="JavaScript:void(0);">Mauritanie</a></li><li><a href="JavaScript:void(0);">Mayotte</a></li><li><a href="JavaScript:void(0);">Mexique</a></li><li><a href="JavaScript:void(0);">Micronésie</a></li><li><a href="JavaScript:void(0);">Moldavie</a></li><li><a href="JavaScript:void(0);">Monaco</a></li><li><a href="JavaScript:void(0);">Mongolie</a></li><li><a href="JavaScript:void(0);">Montserrat</a></li><li><a href="JavaScript:void(0);">Mozambique</a></li><li><a href="JavaScript:void(0);">Namibie</a></li><li><a href="JavaScript:void(0);">Nauru</a></li><li><a href="JavaScript:void(0);">Népal</a></li><li><a href="JavaScript:void(0);">Nicaragua</a></li><li><a href="JavaScript:void(0);">Niger</a></li><li><a href="JavaScript:void(0);">Nigeria</a></li><li><a href="JavaScript:void(0);">Niue</a></li><li><a href="JavaScript:void(0);">Norvège</a></li><li><a href="JavaScript:void(0);">Nouvelle-Calédonie</a></li><li><a href="JavaScript:void(0);">Nouvelle-Zélande</a></li><li><a href="JavaScript:void(0);">Oman</a></li><li><a href="JavaScript:void(0);">Ouganda</a></li><li><a href="JavaScript:void(0);">Ouzbékistan</a></li><li><a href="JavaScript:void(0);">Pakistan</a></li><li><a href="JavaScript:void(0);">Palaos</a></li><li><a href="JavaScript:void(0);">Palestine</a></li><li><a href="JavaScript:void(0);">Panama</a></li><li><a href="JavaScript:void(0);">Papouasie-Nouvelle-Guinée</a></li><li><a href="JavaScript:void(0);">Paraguay</a></li><li><a href="JavaScript:void(0);">Pays-Bas</a></li><li><a href="JavaScript:void(0);">Pérou</a></li><li><a href="JavaScript:void(0);">Philippines</a></li><li><a href="JavaScript:void(0);">Pitcairn</a></li><li><a href="JavaScript:void(0);">Pologne</a></li><li><a href="JavaScript:void(0);">Polynésie française</a></li><li><a href="JavaScript:void(0);">Porto Rico</a></li><li><a href="JavaScript:void(0);">Portugal</a></li><li><a href="JavaScript:void(0);">Qatar</a></li><li><a href="JavaScript:void(0);">Rép. démocratique du Congo</a></li><li><a href="JavaScript:void(0);">République centrafricaine</a></li><li><a href="JavaScript:void(0);">République dominicaine</a></li><li><a href="JavaScript:void(0);">République tchèque</a></li><li><a href="JavaScript:void(0);">Réunion</a></li><li><a href="JavaScript:void(0);">Roumanie</a></li><li><a href="JavaScript:void(0);">Royaume-Uni</a></li><li><a href="JavaScript:void(0);">Russie</a></li><li><a href="JavaScript:void(0);">Rwanda</a></li><li><a href="JavaScript:void(0);">Sahara occidental</a></li><li><a href="JavaScript:void(0);">Saint-Christophe-et-Niévès</a></li><li><a href="JavaScript:void(0);">Sainte-Hélène</a></li><li><a href="JavaScript:void(0);">Sainte-Lucie</a></li><li><a href="JavaScript:void(0);">Saint-Marin</a></li><li><a href="JavaScript:void(0);">Saint-Pierre-et-Miquelon</a></li><li><a href="JavaScript:void(0);">Saint-Vincent-et-les Grenadines</a></li><li><a href="JavaScript:void(0);">Salvador</a></li><li><a href="JavaScript:void(0);">Samoa</a></li><li><a href="JavaScript:void(0);">Samoa américaines</a></li><li><a href="JavaScript:void(0);">Sao Tomé-et-Principe</a></li><li><a href="JavaScript:void(0);">Sénégal</a></li><li><a href="JavaScript:void(0);">Serbie</a></li><li><a href="JavaScript:void(0);">Serbie-et-Monténégro</a></li><li><a href="JavaScript:void(0);">Seychelles</a></li><li><a href="JavaScript:void(0);">Sierra Leone</a></li><li><a href="JavaScript:void(0);">Singapour</a></li><li><a href="JavaScript:void(0);">Slovaquie</a></li><li><a href="JavaScript:void(0);">Slovénie</a></li><li><a href="JavaScript:void(0);">Somalie</a></li><li><a href="JavaScript:void(0);">Soudan</a></li><li><a href="JavaScript:void(0);">Sri Lanka</a></li><li><a href="JavaScript:void(0);">Suède</a></li><li><a href="JavaScript:void(0);">Suisse</a></li><li><a href="JavaScript:void(0);">Suriname</a></li><li><a href="JavaScript:void(0);">Svalbard et île Jan Mayen</a></li><li><a href="JavaScript:void(0);">Swaziland</a></li><li><a href="JavaScript:void(0);">Syrie</a></li><li><a href="JavaScript:void(0);">Tadjikistan</a></li><li><a href="JavaScript:void(0);">Taiwan</a></li><li><a href="JavaScript:void(0);">Tanzanie</a></li><li><a href="JavaScript:void(0);">Tchad</a></li><li><a href="JavaScript:void(0);">Terr. brit. de l'océan Indien</a></li><li><a href="JavaScript:void(0);">Terres australes et antarctiques</a></li><li><a href="JavaScript:void(0);">Thaïlande</a></li><li><a href="JavaScript:void(0);">Timor oriental</a></li><li><a href="JavaScript:void(0);">Togo</a></li><li><a href="JavaScript:void(0);">Tokelau</a></li><li><a href="JavaScript:void(0);">Tonga</a></li><li><a href="JavaScript:void(0);">Trinité-et-Tobago</a></li><li><a href="JavaScript:void(0);">Tunisie</a></li><li><a href="JavaScript:void(0);">Turkménistan</a></li><li><a href="JavaScript:void(0);">Turquie</a></li><li><a href="JavaScript:void(0);">Tuvalu</a></li><li><a href="JavaScript:void(0);">Ukraine</a></li><li><a href="JavaScript:void(0);">Union européenne</a></li><li><a href="JavaScript:void(0);">Uruguay</a></li><li><a href="JavaScript:void(0);">Vanuatu</a></li><li><a href="JavaScript:void(0);">Vatican (Saint-Siège)</a></li><li><a href="JavaScript:void(0);">Venezuela</a></li><li><a href="JavaScript:void(0);">Viêt Nam</a></li><li><a href="JavaScript:void(0);">Wallis-et-Futuna</a></li><li><a href="JavaScript:void(0);">Yémen</a></li><li><a href="JavaScript:void(0);">Zambie</a></li><li><a href="JavaScript:void(0);">Zimbabwe</a></li></ul></div></div><!--END_OBJ_reservation_content_pol_address_country--></td>
                                        </tr>
                                        <tr>
                                            <td class="label">N° et voie*</td>
                                            <td><!--OBJ_reservation_content_pol_address_street--><input type="text" size="60" maxlength="60" id="reservation_content_pol_address_street" class="control_text" value="" name="reservation_content_pol_address_street"><!--END_OBJ_reservation_content_pol_address_street--></td>
                                            <td class="label" rowspan="2">Complément d'adresse 1 (app, esc)</td>
                                            <td rowspan="2">

                                                <textarea size="60" maxlength="60" id="reservation_content_pol_address_address1" class="control_text" name="reservation_content_pol_address_address1"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="label"> Lieu-dit / Boite postale </td>
                                            <td class="listrow1"><!--OBJ_reservation_content_pol_address_postal_locality--><input type="text" size="60" maxlength="60" id="reservation_content_pol_address_postal_locality" class="control_text" value="" name="reservation_content_pol_address_postal_locality"><!--END_OBJ_reservation_content_pol_address_postal_locality--></td>
                                        </tr>
                                        <tr>
                                            <td class="label">Code postal*</td>
                                            <td><!--OBJ_reservation_content_pol_address_zip--><input type="text" size="12" maxlength="20" id="reservation_content_pol_address_zip" class="control_text" value="" name="reservation_content_pol_address_zip"><!--END_OBJ_reservation_content_pol_address_zip--></td>
                                            <td class="label" rowspan="2">Complément d'adresse 2 (bat, lotissement)</td>
                                            <td rowspan="2">

                                                <textarea size="60" maxlength="60" id="reservation_content_pol_address_address2" class="control_text" name="reservation_content_pol_address_address2"></textarea>
                                            </td>
                                        </tr>
                                        <tr><td class="label">Ville*</td>
                                            <td><!--OBJ_reservation_content_pol_address_city--><input type="text" size="24" onchange=";formatText( 'reservation_content_pol_address_city', null, 'reservation_content', 1 );" maxlength="60" id="reservation_content_pol_address_city" class="control_text" value="" name="reservation_content_pol_address_city"><!--END_OBJ_reservation_content_pol_address_city--></td>
                                        </tr>
                                        <tr>
                                            <td class="label">Téléphone 1</td>
                                            <td><!--OBJ_reservation_content_pol_address_phone--><input type="text" size="24" onblur=";if(!checkAndUpdatePhoneField( this, ' ' )) return false;" maxlength="60" id="reservation_content_pol_address_phone" class="upper" value="" name="reservation_content_pol_address_phone"><!--END_OBJ_reservation_content_pol_address_phone--></td>
                                            <td class="label">Téléphone 2</td>
                                            <td><!--OBJ_reservation_content_pol_address_phone2--><input type="text" size="24" onblur=";if(!checkAndUpdatePhoneField( this, ' ' )) return false;" maxlength="60" id="reservation_content_pol_address_phone2" class="upper" value="" name="reservation_content_pol_address_phone2"><!--END_OBJ_reservation_content_pol_address_phone2--></td>
                                        </tr>
                                        <tr>
                                            <td class="label">Mail*</td>
                                            <td>
                                                <!--OBJ_reservation_content_pol_address_email--><input type="text" size="24" onchange=";if ( !checkEmailAddress( this, false )) return false;" maxlength="512" id="reservation_content_pol_address_email" class="control_text" value="" name="reservation_content_pol_address_email"><!--END_OBJ_reservation_content_pol_address_email-->
                                            </td>
                                            <td class="label">Fax</td>
                                            <td><!--OBJ_reservation_content_pol_address_fax--><input type="text" size="24" onblur=";if(!checkAndUpdatePhoneField( this, ' ' )) return false;" maxlength="60" id="reservation_content_pol_address_fax" class="upper" value="" name="reservation_content_pol_address_fax"><!--END_OBJ_reservation_content_pol_address_fax--></td>
                                        </tr>


                                        </tbody></table>

                                    <table style="display:none" class="warning" id="reservation_content_pol_address_partialAdressContent">
                                        <tbody><tr>
                                            <td>Choisissez votre adresse</td>
                                        </tr>
                                        <tr>
                                            <td><select onchange="qasOndemandGetWebResAddress( this.value, 'reservation_content_pol_address', 'reservation_content' );" name="reservation_content_pol_address_partial_address_select" style="display: none;"></select><div class="newListSelected" tabindex="0" style="position: static;"><div class="selectedTxt">Please select</div><div style="visibility: visible; top: 27px; height: 0px; left: 0px; display: none;" class="SSContainerDivWrapper"><ul class="newList" style="height: 0px;"></ul></div></div></td>
                                        </tr>
                                        </tbody></table>

                                </div>
                                <div id="others">
                                    <h4><span>Informations complémentaires</span></h4>
                                    <table>


                                        <tbody><tr>
                                            <td class="label">Inscription à la newsletter</td>
                                            <td><!--OBJ_stat_NEWS_combo--><select name="stat_NEWS_combo" class="control_select" style="display: none;"><option value="0">Non</option><option selected="" value="1">Oui</option></select><div class="newListSelected" tabindex="0" style="position: static;"><div class="selectedTxt">Oui</div><div style="visibility: visible; top: 27px; height: 27px; left: 0px; display: none;" class="SSContainerDivWrapper"><ul class="newList" style="height: 27px;"><li><a href="JavaScript:void(0);">Non</a></li><li><a href="JavaScript:void(0);" class="hiLite">Oui</a></li></ul></div></div><!--END_OBJ_stat_NEWS_combo--></td>
                                        </tr>

                                        <tr>
                                            <td class="label">Comment nous avez-vous connus ?</td>
                                            <td><!--OBJ_stat_ORIG_combo--><select name="stat_ORIG_combo" class="control_select" style="display: none;"><option selected="" value="118218">118218</option><option value="AWEB">Annonce web</option><option value="AUTRE">Autre</option><option value="BAO">Bouche à oreille</option><option value="CAMPING">Camping</option><option value="ANCV">Chèque-Vacances</option><option value="VIACE">Comité d'Entreprise</option><option value="MAG">Magazine</option><option value="MAIL">Mailing</option><option value="MRECH">Moteur de recherche</option><option value="NR">Non renseigne</option><option value="OT">Office de Tourisme</option><option value="PQR">Presse quotidienne</option><option value="RADI">Radio</option><option value="SAL">Salons</option></select><div class="newListSelected" tabindex="0" style="position: static;"><div class="selectedTxt">118218</div><div style="visibility: visible; top: 27px; height: 300px; left: 0px; display: none;" class="SSContainerDivWrapper maxHeight"><ul class="newList" style="height: 300px;"><li><a href="JavaScript:void(0);" class="hiLite">118218</a></li><li><a href="JavaScript:void(0);">Annonce web</a></li><li><a href="JavaScript:void(0);">Autre</a></li><li><a href="JavaScript:void(0);">Bouche à oreille</a></li><li><a href="JavaScript:void(0);">Camping</a></li><li><a href="JavaScript:void(0);">Chèque-Vacances</a></li><li><a href="JavaScript:void(0);">Comité d'Entreprise</a></li><li><a href="JavaScript:void(0);">Magazine</a></li><li><a href="JavaScript:void(0);">Mailing</a></li><li><a href="JavaScript:void(0);">Moteur de recherche</a></li><li><a href="JavaScript:void(0);">Non renseigne</a></li><li><a href="JavaScript:void(0);">Office de Tourisme</a></li><li><a href="JavaScript:void(0);">Presse quotidienne</a></li><li><a href="JavaScript:void(0);">Radio</a></li><li><a href="JavaScript:void(0);">Salons</a></li></ul></div></div><!--END_OBJ_stat_ORIG_combo--></td>
                                        </tr>


                                        </tbody></table>
                                </div>

                                <p class="loginLink"><a class="bt fushia ib" onclick="saveAccount();return false;" href="#">Créer mon compte</a></p>

                            </div><!-- /// newCustomerLayer -->

                        </div><!-- /// authentication -->
                    </div>

                </div>

            </div>

        </div><!-- /// contentContener -->

        <div id="footerContener">
            <div class="footerNavigation gauche">

                <!--Mode sans panier (retour à la résa)-->
                <a title="Retour" href="/rsl/clickbooking?webuser=web_fr&amp;page_after_auth=cart_payment&amp;edit_cart_item_id=7684533&amp;session=vacancesdirectes_preprod_v6_6_we3MZoKtCdAESsK&amp;page_before_auth=cart_payment&amp;tokens=MTQxMzEzNTQyMDQ2MjM3MTY&amp;formAction=&amp;display=reservation_content&amp;actions=&amp;" class="bt gris ib">Retour</a>

                &nbsp;
            </div>
            <div class="footerNavigation">
                &nbsp;
            </div>
            <div class="footerNavigation droite">
                &nbsp;
                <div id="save_reservation_link">
                    <a title="Réserver" href="javascript:saveCart()">Réserver</a>
                </div>
            </div>
            <div class="mentions">
                <span>Powered by </span><a title="Resalys" href="http://www.resalys.com/">RESALYS</a>
            </div>
        </div><!-- /// footerContener -->
    </div>
    <aside class="column right">
        <div class="contentBlock proposals">



            <!-- Récapitulatif des séjours, boucle sur les réservations-->


            <div class="proposal radiusBox fushia">
                <p class="proposalDates">du 24/07/2013 au 31/07/2013</p>
                <p class="proposalEtab">Ajoncs d'Or - Pays de Loire</p>


                <img width="228" height="129" class="proposalPicture" src="http://pimg.devlint.fr/228x129/ccc">

                <p class="proposalLength">1 semaine</p>
                <!--<p class="proposalDescription">Location Mobil-home Résidential<br/></p>-->
                <p class="proposalOccupants">1 adulte

                </p>
                <p class="proposalRoomDistribution">1 Résidential (5 places, max. 4 adultes)</p>



                <table class="prestations">


                    <tbody><tr>
                        <td class="productBase">Location Mobil-home Résidential</td>
                        <td class="optionPrice productBase">

                            <div id="f_7684533_0_0_0_productPrice">511,00&nbsp;€</div>

                        </td>
                    </tr>


                    <tr>
                        <td class="productOption">Assurance annulation (valable pour l'ensemble du dossier) </td>
                        <td class="optionPrice productOption">

                            <div id="f_7684533_0_0_1_productPrice">20,44&nbsp;€</div>

                        </td>
                    </tr>


                    <tr>
                        <td class="productOption">Frais de réservation </td>
                        <td class="optionPrice productOption">

                            <div id="f_7684533_0_0_2_productPrice">20,00&nbsp;€</div>

                        </td>
                    </tr>


                    </tbody></table>
                <table class="occupants">

                    <tbody><tr><td class="occupant" colspan="2">Fsqfsq QQ</td></tr>


                    <tr><td colspan="2">&nbsp;</td></tr>



                    </tbody></table>

                <div class="total stain cover">
                    <span>Total
                        <br>
                        <span class="price">551,44&nbsp;€</span>
                    </span>
                </div>
            </div>

            <!-- /// Cart.Reservations, Récapitulatif des séjours -->

        </div>
    </aside>
</div>
    <script type="text/javascript">
        var fStartDate = '2013/04/06',                  // must be a saturday
                fEndDate = '2013/10/26',                // must be a saturday
                fHighSeasonStartDate = '2013/06/29',    // must be a saturday
                fHighSeasonEndDate = '2013/08/31',      // must be a saturday
                linear,
                numMinWeeks = 6;                       // minimum number of weeks selectable (for linear mini)
    </script>

