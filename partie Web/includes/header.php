<html>
<head>
  <title> planning </title>
  <link rel="stylesheet" type="text/css" media="screen" href="../style/style1.css" />
<body>	
	<header>
	
	<h1><a href="#">Bienvenue !!!</a></h1>
	
	
	<nav id="menu">
		<ul>
			<li><a href="index.php">accueil</a></li>
  <?php
    if (empty($_SESSION)) {
      if (empty($_SESSION['prenom']) && empty($_SESSION['nom']) && empty($_SESSION['civilite'])) {
        echo "<li><a href='login.php'>login</a></li>";
        echo "<li><a href='creer_compte.php'>créer compte</a></li>";
      }
    }
    
  ?>
		</ul>
	</nav>
	
	<form id="search" action="recherche.php" method="post" enctype="multipart/form-data">
			<p>
				<label for="searchText">Rechercher :</label>
				<input id="searchText" name="query" type="text" value="" />
				<input id ="searchBtn" type="submit" class="bouton" value="OK" />
			</p>
	</form>
	
	
		<nav id="menu-categorie">
		<ul>
			<li class="smenu"><a href="categorie.php?cat=all">Planning</a></li>
			<li class="smenu"><a href="categorie.php?cat=1">ODO</a></li>
			<li class="smenu"><a href="categorie.php?cat=2">PS</a></li>
			<li class="smenu"><a href="categorie.php?cat=3">SLOW</a></li>
			<li class="smenu"><a href="categorie.php?cat=4">SB</a></li>
			<?php 
				if (isset($_SESSION)) {
		  			if (!empty($_SESSION['prenom']) && !empty($_SESSION['nom']) && !empty($_SESSION['civilite'])) {
		  				$chaine=" Bonjour ".$_SESSION['civilite']." ".$_SESSION['prenom']." ".$_SESSION['prenom'];
		  				echo "<li class='smenu'>".$chaine."</li>";
				 		echo "<li class='smenu'><a href='deconnexion.php'>Deconnexion</a></li>";
		  			}
		  		}	
			?>
		</ul>
		</nav>
</header>

