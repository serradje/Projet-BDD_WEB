<?php
	require('connexion.php');

		function MAilDansBase($mail)
		{
			//Création des variables
			$PARAM_hote="localhost"; // le chemin vers le serveur
			$PARAM_nom_bd="sitewebshop"; // le nom de votre base de données
			$PARAM_utilisateur="root"; // nom d'utilisateur pour se connecter au serveur
			$PARAM_mdp=""; // mot de passe de l'utilisateur pour se connecter
			//Création de la connexion
			try
			{
				$connexion = new PDO('mysql:host='.$PARAM_hote.';
				dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mdp);

			}
			//gestion des erreurs
			catch(Exception $e)
			{
				echo 'Erreur : '.$e->getMessage().'<br />';
				echo 'N° : '.$e->getCode();

			}
			$reg=$connexion->query("SELECT * FROM client WHERE email='$mail'");
			$rows=$reg->fetchAll(PDO::FETCH_ASSOC);
			if(empty ($rows)){
				return false;
			}
			else{
				return true;
			}
			
		}
if (isset($_POST['envoyer'])) 
{
	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['civilite']) && isset($_POST['nom']) && isset($_POST['prenom']) &&
		isset($_POST['adresse']) && isset($_POST['code']) && isset($_POST['ville']) && isset($_POST['pays']) && isset($_POST['telephone']) && 
		!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['civilite']) && !empty($_POST['nom']) && !empty($_POST['prenom']) &&
		!empty($_POST['adresse']) && !empty($_POST['code']) && !empty($_POST['ville']) && !empty($_POST['pays']) && !empty($_POST['telephone'])) 
	{
		
		$email = htmlentities(addcslashes($_POST['email'],"\0..\37!@\177..\377"));
		$password = htmlentities(addcslashes($_POST['password'],"\0..\37!@\177..\377"));
		$civilite = htmlentities(addcslashes($_POST['civilite'],"\0..\37!@\177..\377"));
		$nom = htmlentities(addcslashes($_POST['nom'],"\0..\37!@\177..\377"));
		$prenom = htmlentities(addcslashes($_POST['prenom'],"\0..\37!@\177..\377"));
		$adresse = htmlentities(addcslashes($_POST['adresse'],"\0..\37!@\177..\377"));
		$code = htmlentities(addcslashes($_POST['code'],"\0..\37!@\177..\377"));
		$ville = htmlentities(addcslashes($_POST['ville'],"\0..\37!@\177..\377"));
		$pays = htmlentities(addcslashes($_POST['pays'],"\0..\37!@\177..\377"));
		$telephone = htmlentities(addcslashes($_POST['telephone'],"\0..\37!@\177..\377"));


		/*$password=hash('sha256',$password);

		$reg=$connexion->query("SELECT * FROM client WHERE email='$email'");
			$rows=$reg->fetchAll(PDO::FETCH_ASSOC);
			if(empty ($rows))
			{

			
				$query=$connexion->exec("INSERT INTO client VALUES (null,'$email','$password','$civilite','$nom','$prenom','$adresse','$code','$ville','$pays',
				'$telephone')");
				mail($email, "confrimation d'inscription", "votre inscription c'est bien dérouler");
				die("inscription terminer <a href='login.php'>connectez </a> vous");

			

			}else {echo"cet mail est deja utilise choisir un autre";}*/






		$password=hash('sha256',$password);


		if (MAilDansBase($email)==false) {
			
			$query=$connexion->exec("INSERT INTO client VALUES (null,'$email','$password','$civilite','$nom','$prenom','$adresse','$code','$ville','$pays',
				'$telephone')");

			/*mail($email, "confrimation d'inscription", "votre inscription c'est bien dérouler");*/

			/*die("inscription terminer <a href='login.php'>connectez </a> vous");*/
			header("location:login.php");
		}
		else
		{
			echo "email deja utiliser";
		}


	}else{
		echo "veillez remplir tout les champs";
	}
}



?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<meta charset="utf-8" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />

</head>
<body>


		<section>
         <header> <h2>Créer un compte</h2></header>
		 <form action="creer_compte.php" method="post" id="creer-compte">

		<div>
		<label for="mail">E-mail:</label>
		<input type="email" id="mail" name="email" placeholder="mail" required>
		</div>
		
		<div>
		<label for="pass">mot de passe:</label>
		<input type="password" id="pass" name="password" placeholder="mot de passe" required>
		</div>

		<div>
		<label for="civil">civilité:</label>
		<select id="civil" name="civilite">
		<option value="MR">Mr</option>
		<option value="Mme">Mme</option>
		</select>
		</div>

		<div>
		<label for="nom">Nom:</label>
		<input type="text" id="nom" name="nom" placeholder="nom" required>
		</div>

		<div>
		<label for="prenom">Prenom:</label></td>
		<input type="text" id="prenom" name="prenom" placeholder="prenom" required>
		</div>

		<div> 
		<label for="adresse">Adresse:</label>
		<input type="text" id="adresse" name="adresse" placeholder="adresse" required>
		</div>

		<div>
		<label for="code">Code postal:</label>
		<input type="numerique" id="code" name="code" placeholder="code postal" required>
		</div>
		 
		<div>
		<label for="ville">Ville:</label>
		<input type="text" id="ville" name="ville" placeholder="votre ville" required>
		</div>

		<div>
		<label for="pays">Pays:</label>
		<input type="text" id="pays" name="pays" placeholder="votre pays" required>
		</div>

		<div>
		<label for="tel">Telephone:</label>
		<input type="numerique" id="tel" name="telephone" placeholder="numero de telephone" required>
		</div>

			<div class="button">
				<input type="submit" value="Envoyer" name="envoyer">
			</div>
		 </form>
		 
		 <p>merci de renseigner tous les champs</p>	
		 
       </section>
	

</body>
</html>