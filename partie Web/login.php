<?php
		
	
	session_start();

	require('connexion.php');

	if (isset($_POST['valider'])) {


	if(isset($_POST['login']) && isset($_POST['pass']) && !empty($_POST['login']) && !empty($_POST['pass']))
	{
		$login = htmlentities(trim($_POST['login']));
		$password = htmlentities(trim($_POST['pass']));

		$password=hash('sha256',$password);
		
		$reg=$connexion->query("SELECT * FROM client WHERE motpasse ='$password'");
		$rows=$reg->fetchAll(PDO::FETCH_ASSOC);
		if (!empty($rows)) 
		{

			$reg=$connexion->query("SELECT * FROM client WHERE email='$login'");
			$rows=$reg->fetchAll(PDO::FETCH_ASSOC);
			if (!empty($rows)) {
				foreach($rows as $key => $value)
   				{
   				 	$_SESSION['nom'] = $value['nom'];
     				$_SESSION['prenom'] = $value['prenom'];
     				$_SESSION['civilite'] = $value['civilite'];
     				$_SESSION['id_client'] = $value['id_client'];
   				}
			
			
			header('location:index.php');


			}else {echo"email incorrect";}


		}else {echo" password incorrect\n";}

	}
	else
	{
		echo "remplissez tout les champs";
	}
}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<title>login</title>
</head>
<body>



<section>
		
		<header>	<h2>Identification</h2></header>
		<form id="login" action="login.php" method='post'>
					
					<div>
						<label for="mail">email</label>
						<input type="text" name="login" maxlength="250" id="mail" />
					</div>
					<div>			
						<label for="pass">Mot de passe</label>
						<input type="password" name="pass" maxlength="10" id="pass"/>
					</div>
					<div class="button">				
						<input type="submit" value="valider" name="valider" />
					</div>
			</form>
		
					
</section>


</body>
</html>