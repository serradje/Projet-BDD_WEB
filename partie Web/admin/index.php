<?php


include('includes/connexion.php');

?>
<html>
<head>
	<meta charset="utf-8" />
	<link href="style/styleAdmin.css" rel="stylesheet" type="text/css" />
	<title>SHOP </title>
</head>
<body>


<div id="container">

<h1> Administration du site</h1>

<form method="POST" action="index.php" enctype="multipart/form-data">
		<fieldset id="credentials">
				<legend>Planning des Agents</legend>
				<table>
					<p>
					<tr>
						<td><label for "idCat">Agent</label></td>
						<td><select name="cat">
							<?php
								$requete='select * from agents';
								$result=$connexion->query($requete);
								$resultat=$result-> fetchALL(PDO::FETCH_ASSOC);
								foreach ($resultat as $key => $value) {
									echo "<option>".$value['nom']."</option>";  	
								}  
							?>
						</select></td>
					</tr>
					</p>
					
					</table>
					
				
	</fieldset>

					<p>
				<input type="submit" value="Envoyer" name="valide"/>
			</p>
		</form>

			<?php

if (isset($_POST['valide'])) {
	
		
		$categorie = $_POST['cat'];
		echo "<p>";
		echo "Toutes ces astreintes";
		echo "</p>";
		$req0='select idAgent from agents where nom="'.$categorie.'"';
		$resultat0=$connexion->query($req0);
		$res0=$resultat0->fetchALL(PDO::FETCH_ASSOC);
		$id_cat=$res0[0]['idAgent'];
		//echo $id_cat;

		$req1='select * from equipe where idAgent="'.$id_cat.'"';

	 	$resultat1=$connexion->query($req1);
		$res=$resultat1->fetchALL(PDO::FETCH_ASSOC);

		foreach ($res as $key => $value) {
			if ($value['id_astreinte'] == 1 || $value['id_astreinte'] == 2) {
				$n = "ODO";
			}
			if ($value['id_astreinte'] == 3 || $value['id_astreinte'] == 4) {
				$n = "PS";
			}
			if ($value['id_astreinte'] == 5 || $value['id_astreinte'] == 6) {
				$n = "SB";
			}
			if ($value['id_astreinte'] == 7 ) {
				$n = "SLOW";
			}
			echo "<p>";
			echo $categorie." ".$n." ". $value['date_t'];
			echo "</p>";

		} 
}

?>

		</div>
			
</body>
</html>