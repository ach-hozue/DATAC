<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>DATÀC – Qui sommes nous ?</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
        <link id="css" rel="stylesheet" href="mise_en_forme.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script href="bootstrap/js/bootstrap.js"></script>
        <script href="bootstrap/js/npm.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    </head>
    <body>
    <!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
    <div class="container-fluid">

        <!--header = bannière blance avec logos, connexion et recherche + titre sur fond bleu-->
        <?php include ("header.php"); ?>

        <!--suite bannière bleu (après titre)-->
        <div class="row" id="rArianne">
            <!--Fil d’Ariane-->
            <p class="ariane col-sm-offset-1">
                <a class="ariane" href="accueil.php">Accueil</a> // Qui sommes nous ?
            </p>
        </div>

        <!--fond bleu penché-->
        <div class="row penche"></div>
        <!--fond gris penché haut-->
        <div class="row pencheSect"></div>

        <!--bannière grise avec tout le texte-->
        <section class="row" id="rSect">
			<article>
				<fieldset>
					<h2 class="sousTitre">L’équipe de DATÀC</h2>
                    <br>
                    <div class="col-sm-offset-1 col-sm-10" id="equipe">
					<p>
						DATÀC est composé de 7 membres :
					</p>
					<ul>
                        <li>Maxime DULIEU</li>
                        <li>Achille GAUTHERON</li>
                        <li>Marie GUIRAUTE</li>
                        <li>Louise MATHIEU</li>
						<li>Marwa MATHLOUTHI</li>
						<li>Émilie ROGER</li>
						<li>Alexia TARTAS</li> 
					</ul>
					<p>
						Ce site web s’inscrit dans le projet « <a href="http://www.fracturesnumeriques.fr/" target="_blank">
						Fratures corporelles, fractures numériques : enjeux, risques et solutions</a> » piloté par 
						<a href="mailto:vlespinet@ensc.fr">Véronique LESPINET-NAJIB</a> et <a href="mailto:npinede@ensc.fr">Nathalie PINÈDE</a>.
					</p>
					<p>
						Il a été réalisé dans le cadre de notre formation à l’<a href="https://www.ensc.fr/" target="_blank">ENSC</a>
						(École Nationale Supérieure de Cognitique) qui se site au :
					</p>
					<p style="text-align:center">
						109 avenue Roul
						<br/>
						33400 Talence
						<br/>
						FRANCE
					</p>
					<p>
						Nous tenions tout particulièrement à remercier la start-up <a href="http://iuserlab.com/" target="_blank">iUserLab</a>,
						sans laquelle nous n’aurions pas de moteur de recherche.
					</p>
					<p style="text-align:center">
						<a href="mailto:marie.guiraute@ensc.fr;marwa.mathlouthi@ensc.fr;emilie.roger@ensc.fr;alexia.tartas@ensc.fr;m.dulieu@outlook.fr">NOUS CONTACTER</a>
					</p>
                    </div>
				</fieldset>
				<br/>
			</article>
		</section>
        <footer class="row">
        <div class="col-lg-12">
            <?php include("bas.php"); ?>
        </div>
    </footer>
    </div>
    <!-- definition de la flèche précédent (retour à accueil) -->
    <a class="pagePreced" href="accueil.php"><img class="logoRetour" src="images/retour_fleche.png"> </a>
	</body>
</html>