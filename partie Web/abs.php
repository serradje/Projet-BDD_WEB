
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
  
<form method="POST" action="abs.php" enctype="multipart/form-data">
    <fieldset id="credentials">
        <legend>Congés ou date de mission</legend>
        <table>

        <p>
          <tr>
            <td><label for "idCat">Motif</label></td>
            <td><input type="text" name="motif"></td>
          </tr>
          </p>
          
          <p>
          <tr>
            <td><label for "idCat">DateDebut</label></td>
            <td><input type="date" name="cat"></td>
          </tr>
          </p>

          <p>
          <tr>
            <td><label for "idCat">dateFin</label></td>
            <td><input type="date" name="cat1"></td>
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

<?php
if (isset($_POST['valide'])) {
  
    if (isset($_POST['cat']) && isset($_POST['cat1']) && isset($_POST['motif'])) {
        $categorie = $_POST['cat'];
      $categorie1 = $_POST['cat1'];
      $motif = $_POST['motif'];
      /*echo "<p>";
      echo "Toutes ces astreintes du mois sélectionner";
      echo "</p>";*/
      /*$req0='select * from agents where nom="'.$categorie.'"';
      $resultat0=$connexion->query($req0);
      $res0=$resultat0->fetchALL(PDO::FETCH_ASSOC);
      $id_cat=$res0[0]['idAgent'];*/
      //echo $id_cat;
   
      $req1= 'insert into abscence values(null,"'.$_SESSION['id_client'].'","'.$motif.'","'.$categorie.'","'.$categorie1.'")';

      $resultat1=$connexion->exec($req1);
      //$res=$resultat1->fetchALL(PDO::FETCH_ASSOC);
echo "Abscence POSER";
    $req2= "select * from abscence where idAgent=".$_SESSION['id_client'];

    $resultat2=$connexion->query($req2);
    $res=$resultat2->fetchALL(PDO::FETCH_ASSOC);

    foreach ($res as $key => $value) {
      
      echo "<p>";
      echo $value['motif']." A partir de : ".$value['date_debut']." jusqu'au: ".$value['date_fin'];
      echo "</p>";

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
