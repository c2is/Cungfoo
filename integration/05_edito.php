<?php
    $title = 'Vacances directes | Le mobil-home et vous';
    $page = 'edito';
    include('includes/inc_header.php');
    include('includes/top.php'); ?>

    <div id="wrap" class="fixed-width clear">
    <!-- colonne gauche -->
        <div class="column left">
            <nav id="ficheShare">
                <a href="#_" class="icon facebook" title="Partager sur Facebook">Partager sur Facebook</a>
                <a href="#_" class="icon twitter" title="Partager sur Twitter">Partager sur Twitter</a>
                <a href="#_" class="icon email" title="Partager par email">Partager par email</a>
                <a href="#_" class="icon print" title="Imprimer">Imprimer</a>
            </nav>


            <a href="#r" class="bt gris left goto">&lt; Retour</a>

            <ol class="pathway" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Accueil</span></a></li>
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Nos campings : Campings France</span></a></li>
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Location mobil home Languedoc-Roussillon</span></a></li>
                <li>&gt; <a href="#_" itemprop="url"><span itemprop="title">Le Petit Mousse</span></a></li>
            </ol>


            <h1>Titre de la page (région / type d'hébergement ...)</h1>
            <h2>Sous-titre / informations supplémentaires<br>
            </h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="http://loripsum.net/">Perge porro;</a> Praeclarae mortes sunt imperatoriae; Quid est, quod ab ea absolvi et perfici debeat? </p>

            <p><b>Optime, inquam.</b> Rapior illuc, revocat autem Antiochus, nec est praeterea, quem audiamus. <i>Frater et T.</i> Sint ista Graecorum; Atque his de rebus et splendida est eorum et illustris oratio. <i>Immo alio genere;</i> Utilitatis causa amicitia est quaesita. Venit ad extremum; </p>

            <p>Duo Reges: constructio interrete. <i>Quid ad utilitatem tantae pecuniae?</i> Cuius quidem, quoniam Stoicus fuit, sententia condemnata mihi videtur esse inanitas ista verborum. Illa argumenta propria videamus, cur omnia sint paria peccata. Qua igitur re ab deo vincitur, si aeternitate non vincitur? Videamus animi partes, quarum est conspectus illustrior; Sed quanta sit alias, nunc tantum possitne esse tanta. <b>Tu quidem reddes;</b><a href="http://loripsum.net/">Certe non potest.</a></p>

            <p>Ad eos igitur converte te, quaeso. Quis enim confidit semper sibi illud stabile et firmum permansurum, quod fragile et caducum sit? <i>Rhetorice igitur, inquam, nos mavis quam dialectice disputare?</i> Iam id ipsum absurdum, maximum malum neglegi. Unum est sine dolore esse, alterum cum voluptate. Tu enim ista lenius, hic Stoicorum more nos vexat. Deinde disputat, quod cuiusque generis animantium statui deceat extremum. Quis enim potest ea, quae probabilia videantur ei, non probare? Et ille ridens: Video, inquit, quid agas; </p>

            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Itaque his sapiens semper vacabit. Non semper, inquam; Poterat autem inpune; Duo Reges: constructio interrete. Non igitur bene. Dat enim intervalla et relaxat. An eiusdem modi?</li>
                <li>Nihil opus est exemplis hoc facere longius. Quid ait Aristoteles reliquique Platonis alumni? Quid vero? Comprehensum, quod cognitum non habet?</li>
                <li>Simus igitur contenti his. Quid est enim aliud esse versutum? Velut ego nunc moveor. Sed nimis multa. Sint modo partes vitae beatae. Quis hoc dicit? Nunc agendum est subtilius.</li>
            </ul><h2>Confecta res esset.</h2>

            <img class="thumb" src="http://viaimage.viafrance.com/images/evts/16471.jpg" style="cursor: default;">
            <p>Sin laboramus, quis est, qui alienae modum statuat industriae? Sic enim censent, oportunitatis esse beate vivere. De ingenio eius in his disputationibus, non de moribus quaeritur. <b>Tubulo putas dicere?</b> Deinde prima illa, quae in congressu solemus: Quid tu, inquit, huc? Equidem e Cn. <i>Ne discipulum abducam, times.</i> Graccho, eius fere, aequalí? Ut placet, inquit, etsi enim illud erat aptius, aequum cuique concedere. Respondent extrema primis, media utrisque, omnia omnibus. <br>
            </p>
            <h2>Confecta res esset.</h2>

            <p>Sin laboramus, quis est, qui alienae modum statuat industriae? Sic enim censent, oportunitatis esse beate vivere. De ingenio eius in his disputationibus, non de moribus quaeritur. <b>Tubulo putas dicere?</b> Deinde prima illa, quae in congressu solemus: Quid tu, inquit, huc? Equidem e Cn. <i>Ne discipulum abducam, times.</i> Graccho, eius fere, aequalí? Ut placet, inquit, etsi enim illud erat aptius, aequum cuique concedere. Respondent extrema primis, media utrisque, omnia omnibus.</p>
            <div class="banner">
                <div class="bannerStain first cover">
                    <div class="content">
                        <p class="headline">Au camping comme à la maison</p>
                    </div>
                </div>
                <img class="bdPict" src="../web/images/vacancesdirectes/dyn/results/bandeau-result-hebergement.jpg" alt="" >
            </div>

        </div>
    <!-- // colonne gauche -->
    <!-- colonne droite -->
        <aside class="column right">
            <?php include('blocs/search.php') ?>
            <div id="greyBoxes" class="clear">
                <?php include('blocs/offresSpeciales.php') ?>
                <?php include('blocs/dejaVu.php') ?>
                <?php include('blocs/communaute.php') ?>
                <?php include('blocs/vacancesReussies.php') ?>
                <?php include('blocs/aimerezAussi.php') ?>
                <?php include('blocs/infoResa.php') ?>
            </div>
        </aside>
    <!-- // colonne droite -->
    </div>

<?php include('includes/bottom.php'); ?>
<?php include('includes/inc_footer.php'); ?>

