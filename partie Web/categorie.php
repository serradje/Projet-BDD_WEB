
<?php
	session_start(); 

 	require("connexion.php");
	?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Accueil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

</head>
<body>

<div class="navbar navbar-inverse navbar-static-top">
  
  <div class="container">
    
    <?php 
        if (isset($_SESSION)) {
            if (!empty($_SESSION['prenom']) && !empty($_SESSION['nom']) && !empty($_SESSION['civilite'])) {
              $chaine=" Bonjour ".$_SESSION['civilite']." ".$_SESSION['prenom']." ".$_SESSION['prenom'];
              echo "<a href='#' class='navbar-brand'>".$chaine."</a>";
              //echo "<li class='smenu'><a href='deconnexion.php'>Deconnexion</a></li>";
            }
          } 
      ?>

    <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <div class="collapse navbar-collapse navHeaderCollapse">
      
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="index.php">Accueil</a></li>
        <?php
          if (empty($_SESSION)) {
            if (empty($_SESSION['prenom']) && empty($_SESSION['nom']) && empty($_SESSION['civilite'])) {
              echo "<li><a href='login.php'>login</a></li>";
              echo "<li><a href='creer_compte.php'>créer compte</a></li>";
            }
          }
        
          else{


        ?>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Type<b class="caret"></b></a>
        <ul class="dropdown-menu" style="background-color: white;">
          <li><a href="categorie.php?cat=all&val=0">TOUS</a></li>
          <li><a href="categorie.php?cat=1&val=2">ODO</a></li>
          <li><a href="categorie.php?cat=3&val=4">PS</a></li>
          <li><a href="categorie.php?cat=5&val=6">SB</a></li>
          <li><a href="categorie.php?cat=7&val=0">SLOW</a></li>
        </ul>
      </li>

      <li><a href="mois.php">Planning Mois</a></li>
      <li><a href="#contact" data-toggle="modal">Contactez nous</a></li>
	<li><a href="abs.php">Abscence</a></li>

      <?php
      } 
        if (isset($_SESSION)) {
            if (!empty($_SESSION['prenom']) && !empty($_SESSION['nom']) && !empty($_SESSION['civilite'])) {
            echo "<li><a href='deconnexion.php'>Deconnexion</a></li>";
            }
          } 
      ?>      
    </ul>

    </div>

  </div>

</div>

<div class="container">

<?php
	 if(!empty($_GET['cat']))
	 {	
	  $id_cat = $_GET['cat'];
	  $val = $_GET['val'];
	  
	  	if($_GET['cat']=='all')
		{
			$query1 = $connexion->query("select * from equipe where idAgent =".$_SESSION['id_client']);
		}
		else
		{
			$query1 = $connexion->query("select * from equipe where idAgent=".$_SESSION['id_client']." and id_astreinte in (".$id_cat.",".$val.")");
		
		}
		
		$res = $query1->fetchAll(PDO::FETCH_ASSOC);
		foreach($res as $key => $value)
            {
              
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
            	echo $value['date_t']." ". $n; 
            	echo "</p>\n";
            	echo "<strong>";
            	echo "EQUIPIER";
            	echo "</strong>";
            	$query2 = $connexion->query("select * from equipe where num_equipe=".$value['num_equipe']." and idAgent not in (".$_SESSION['id_client'].")");
            	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            	foreach ($res2 as $k => $v) {

            		$query3 = $connexion->query("select * from agents where idAgent=".$v['idAgent']);
            		$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
            		foreach ($res3 as $k1 => $v1){
	            		echo "<p>";
	            		echo $v1['nom']." ". $v1['prenom']; 
	            		echo "</p>\n";
            		}
            	}
            	
            
            }
	 }
?>
<br>
<br>
<br>
<br>
</div>

<div class="navbar navbar-default navbar-fixed-bottom">
  
<div class="container">
  <p class="navbar-text pull-left"><strong>Site Web Avancés - Année 2017 - version HTML 5:</strong></p>  
  <a href="admin/index.php" class="navbar-btn btn-danger btn pull-right">Admin</a>
</div>

</div>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="bootstrap/bootstrap/js/bootstrap.js"></script>

</body>
</html>
