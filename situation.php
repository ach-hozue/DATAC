<!DOCTYPE html>
<html>
	<?php
	// Connexion à la base de données
	require("connect.php");
	mysqli_set_charset($BDD, "utf8");
	// Recherche de l’indentifiant et du nom de la déficience sur laquelle on vient de cliquer
	$idSit = $_GET["idSit"];
	$RqtAriane = "SELECT * FROM situation WHERE id_sit_cat = $idSit AND niveau=1";
	$TabAriane = mysqli_query($BDD, $RqtAriane);
	$LgnAriane = mysqli_fetch_array($TabAriane);
	$nomSit = $LgnAriane["nom_sit"];
	mysqli_free_result($TabAriane);
	?>
	<head>
		<meta charset="UTF-8">
		<title>DATÀC – <?php print $nomSit; ?></title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
		<link id="css" rel="stylesheet" href="mise_en_forme.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script href="bootstrap/js/bootstrap.js"></script>
		<script href="bootstrap/js/npm.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<!--import pour le modal("i")-->
		<link href="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.css" rel="stylesheet">
		<script src="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.js"></script>
	</head>
	<body>
	<!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
	<div class="container-fluid">
		<!--header = bannière blance avec logos, connexion et recherche + titre sur fond bleu-->
		<?php include("header.php"); ?>
		<!--suite bannière bleu (après titre)-->
		<div class="row" id="rArianne">
			<!--Fil d’Ariane-->
			<p class="ariane col-sm-offset-1">
				<a class="ariane" href="accueil.php">Accueil</a>
				// <?php echo $nomSit; ?>
			</p>
		</div>
		<!--fond bleu penché-->
		<div class="row penche"></div>
		<!--fond gris penché haut-->
		<div class="row pencheSect"></div>
		<!--bannière grise avec boutons catégories + modal(s) d'information(s)-->
		<section class="row" id="rSect">
			<article>
				<p class="col-sm-offset-1 col-sm-10 sousTitre">Pour cette situation, il existe les catégories d'actions suivantes :</p>
				<br>
				<br>
				<br>
				<?php
				// Recupération des catégories de situation à afficher
				$RqtSituation = "SELECT * FROM situation WHERE id_sit_cat = $idSit AND niveau = 2";
				$TabSituation = mysqli_query($BDD, $RqtSituation);
				$comparaison=0;
				$comparaisonCat=0;
				$déficience=0;
				while ($LgnSituation = mysqli_fetch_array($TabSituation)) 
				{
					
					$idSituation=$LgnSituation['id_situation'];
					?>	
					<div class="col-md-4 bar" >
						<!--Affichage du bouton de la situation -->
						<button type="button" class="iconeSituation" onclick="toggle_div(this,'id_du_div<?php echo $LgnSituation["nom_sit"]; ?>');"><?php echo $LgnSituation["nom_sit"]; ?></button>
							<div id="id_du_div<?php echo $LgnSituation["nom_sit"]; ?>" style="display:none;">
								<br>
								<br>
								<br>
									<?php
									$RqtSousSit = "SELECT * FROM situation WHERE id_cat_prec=$idSituation";
									$TabSousSit = mysqli_query($BDD, $RqtSousSit); 
									if (mysqli_num_rows($TabSousSit) != 0) // On rentre dans la condition si la situation possède des sous-situations
									{
										while ($LgnSousSit = mysqli_fetch_array($TabSousSit))
										{
											$idSituationCategorie= $LgnSousSit["id_situation"];
										?>
										<!--Affichage des informations liées au bouton -->
										<div class="row about">
											<br>
											<br>
											<br>
											<div class="col-md-12 conteneurSousCat">
												<button type="button" class="sousCat" onclick="toggle_div(this,'id_du_div<?php echo $LgnSousSit["id_situation"]; ?>');"><?php echo $LgnSousSit["nom_sit"]; ?></button>
													<div  id="id_du_div<?php echo $LgnSousSit["id_situation"]; ?>" style="display:none;">
														<?php 
														$RqtPreparation="SELECT * FROM association_situation_categorie WHERE id_situation=$idSituationCategorie";
														$TabPreparation= mysqli_query($BDD, $RqtPreparation); 
															while ($LgnPreparation = mysqli_fetch_array($TabPreparation))
															{
																$cat=$LgnPreparation["id_categorie"];
																$RqtCategorie="SELECT id_categorie FROM categorie WHERE id_categorie = (SELECT id_cat_prec FROM categorie WHERE id_categorie=$cat)";
																$TabCategorie= mysqli_query($BDD, $RqtCategorie);
																
																	while ($LgnCategorie =mysqli_fetch_array($TabCategorie))
																	{	
																		if ($LgnCategorie["id_categorie"]!=$comparaison)// comparaison pour n'avoir qu'une fois l'identifiant 
																		{
																			$tableau["id"]=$LgnCategorie["id_categorie"];
																			$comparaison=$LgnCategorie["id_categorie"];
																			
																			foreach ($tableau as $key =>$element) // on parcourt le tableau 
																			{ 
																				$RqtDeficience="SELECT * FROM categorie WHERE id_categorie=$element";
																				$TabDeficience= mysqli_query($BDD, $RqtDeficience);
																				while ($LgnDeficience =mysqli_fetch_array($TabDeficience))
																				{
																					if ($déficience!=$LgnDeficience['id_def_cat'])
																					{
																						if ($LgnDeficience['id_def_cat']==1)
																						{
																							?> 
																							<div class="texteSituation">Difficulté à voir :</div>
																							<?php
																						}
					
																						elseif ($LgnDeficience['id_def_cat']==2)
																						{
																							?>
																							<div class="texteSituation">Difficulté à entendre :</div>
																							<?php
																						}
					
																						
																						elseif ($LgnDeficience['id_def_cat']==3)
																						{
																							?>
																							<div class="texteSituation">Difficulté à se mouvoir :</div>
																							<?php
																						}
					
																						
																						elseif ($LgnDeficience['id_def_cat']==4)
																						{
																							?>
																							<div class="texteSituation">Difficulté à réfléchir :</div>
																							<?php
																						}
					
																						else
																						{
																							?>
																							<div class="texteSituation">Difficulté à s'exprimer à l'oral :</div>
																							<?php
																						}
																						$déficience=$LgnDeficience['id_def_cat'];
																					}
																				?>
																					<a  href="categorieSituation.php?idNiv=<?php echo $LgnDeficience["niveau"];?>&idCat=<?php echo $LgnDeficience["id_categorie"];?>&idSsSit=<?php echo $idSituationCategorie ?>&idSit=<?php echo $idSit ?>&niv=<?php echo $LgnDeficience['niveau'] ?>" class="sousCat2"><?php echo $LgnDeficience['nom_cat'] ?> </a> <!--on affiche le bouton--> 
 

																					<?php
																				}
																			}
																		}									
																	}											
																	mysqli_free_result($TabCategorie);
															}													
														mysqli_free_result($TabPreparation);												
														?>
													</div>
											</div>
										</div>
										<?php
										}
									}
									else //On rentre dans la boucle else lorsque la situation ne possède pas de sous-situation
									{ ?>
										<div class="row about">
											<br>
											<br>
											<br>
											<div class="col-md-12 conteneurSousCat">
												<?php
												$RqtAssociative="SELECT id_cat_prec FROM categorie,association_situation_categorie WHERE association_situation_categorie.id_situation=$idSituation AND categorie.id_categorie=association_situation_categorie.id_categorie";
												$TabAssociative= mysqli_query($BDD, $RqtAssociative);	
												while ($LgnAssociative=mysqli_fetch_array($TabAssociative))
												{
													if ($LgnAssociative["id_cat_prec"]!=$comparaisonCat)// comparaison pour n'avoir qu'une fois l'identifiant 
													{
														$tableau2["id_prec"]=$LgnAssociative["id_cat_prec"];
														$comparaisonCat=$LgnAssociative["id_cat_prec"];
													
														foreach ($tableau2 as $key2=>$element2)
														{
															$RqtDeficience2="SELECT * FROM categorie WHERE id_categorie = $element2";
															$TabDeficience2= mysqli_query($BDD, $RqtDeficience2);
															while ($LgnDeficience2=mysqli_fetch_array($TabDeficience2))
															{ 
																if ($déficience!=$LgnDeficience2['id_def_cat'])
																{
																	if ($LgnDeficience2['id_def_cat']==1)
																	{
																		?> 
																		<div class="texteSituation">Difficulté à voir :</div>
																		<?php
																	}

																	elseif ($LgnDeficience2['id_def_cat']==2)
																	{
																		?>
																		<div class="texteSituation">Difficulté à entendre :</div>
																		<?php
																	}

																	
																	elseif ($LgnDeficience2['id_def_cat']==3)
																	{
																		?>
																		<div class="texteSituation">Difficulté à se mouvoir :</div>
																		<?php
																	}

																	
																	elseif ($LgnDeficience2['id_def_cat']==4)
																	{
																		?>
																		<div class="texteSituation">Difficulté à réfléchir :</div>
																		<?php
																	}

																	else
																	{
																		?>
																		<div class="texteSituation">Difficulté à s'exprimer à l'oral :</div>
																		<?php
																	}
																	$déficience=$LgnDeficience2['id_def_cat'];
																}
																?>
																<a href="categorieSituation.php?idNiv=<?php echo $LgnDeficience2["niveau"];?>&idCat=<?php echo $LgnDeficience2["id_categorie"];?>&idSsSit=<?php echo $idSituation ?>&idSit=<?php echo $idSit ?>&niv=<?php echo $LgnDeficience2['niveau'] ?>" class="sousCat2"><?php echo $LgnDeficience2['nom_cat'] ?></a>


																<?php
															}
														}
													}
												}
													?>
												
											</div>
										</div>
									<?php
									}
								?>
							</div>	
					</div>
				
				<?php
				}
				?>
			</article>
		</section>
				<?php
				//libère la ressource TabDef
				mysqli_free_result($TabSituation);
				mysqli_free_result($TabSousSit);	
				//ferme la base de donnée
				mysqli_close($BDD);?>	
		<div class="row" id="rFooter">
			<?php include("bas.php"); ?>
		</div>
	</div>
	<!-- definition de la flèche précédent (retour à accueil) -->
	<a class="pagePreced" href="accueil.php"><img class="logoRetour" src="images/retour_fleche.png"> </a>
	</body>
		<script type="text/javascript">
			function toggle_div(bouton, id) 
			{ // On déclare la fonction toggle_div qui prend en param le bouton et un id
				var div = document.getElementById(id); // On récupère le div ciblé grâce à l'id
				if(div.style.display=="none")
				{ // Si le div est masqué...
					div.style.display = "block"; // ... on l'affiche...
				} 
				else 
				{ // S'il est visible...
					div.style.display = "none"; // ... on le masque..
				}
			}
        </script> 
</html>