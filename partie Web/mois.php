
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
  
<form method="POST" action="mois.php" enctype="multipart/form-data">
    <fieldset id="credentials">
        <legend>Planning des mois</legend>
        <table>
          <p>
          <tr>
            <td><label for "idCat">Mois</label></td>
            <td><select name="cat">
              <option>01</option>
              <option>02</option>
              <option>03</option>
              <option>04</option>
              <option>05</option>
              <option>06</option>
              <option>07</option>
              <option>08</option>
              <option>09</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
            </select></td>
          </tr>
          </p>
          
          </table>
          
        
  </fieldset>

          <p>
        <input type="submit" value="Envoyer" name="valide"/>
      </p>
    </form>

</div>

<div class="container">
  
<form method="POST" action="mois.php" enctype="multipart/form-data">
    <fieldset id="credentials">
        <legend>Planning Agents donnée</legend>
        <table>
          <p>
          <tr>
            <td><label for "idCat">Agent</label></td>
            <td><select name="cat1">
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
        <input type="submit" value="Envoyer" name="valide1"/>
      </p>
    </form>

</div>

<div class="container">

<?php
if (isset($_POST['valide'])) {
  
    
    $categorie = $_POST['cat'];
    echo "<p>";
    echo "Toutes ces astreintes du mois sélectionner";
    echo "</p>";
    /*$req0='select * from agents where nom="'.$categorie.'"';
    $resultat0=$connexion->query($req0);
    $res0=$resultat0->fetchALL(PDO::FETCH_ASSOC);
    $id_cat=$res0[0]['idAgent'];*/
    //echo $id_cat;

    $req1= "select * from equipe where idAgent=".$_SESSION['id_client']." and MONTH(date_t) in (".$categorie.")";

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
<br>
<br>
<br>
<br>
</div>

<div class="container">
  
<?php

if (isset($_POST['valide1'])) {
  
    
    $categorie = $_POST['cat1'];
    echo "<p>";
    echo "Toutes ces astreintes du mois encour";
    echo "</p>";
    $req0='select idAgent from agents where nom="'.$categorie.'"';
    $resultat0=$connexion->query($req0);
    $res0=$resultat0->fetchALL(PDO::FETCH_ASSOC);
    $id_cat=$res0[0]['idAgent'];
    //echo $id_cat;
    $req1="select * from equipe where idAgent=".$id_cat." and MONTH(date_t) = MONTH(SYSDATE())";

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
