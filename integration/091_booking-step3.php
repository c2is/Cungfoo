<?php
$title = 'Vacances directes | Le mobil-home et vous';
$page = 'booking';
include('includes/inc_booking-header.php');
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


                    <p>FORM</p>

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

<?php include('includes/bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>
