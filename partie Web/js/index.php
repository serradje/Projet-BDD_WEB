<?php
	require_once 'functions.php'; connect();
?>

<!DOCTYPE HTML>
<html lan="fr">
<head>
	<meta charset="utf-8">
	<title>products</title>
	<link href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> 
	<style type="text/css">
		body{
			background: url(img/first_aid_kit.png);
			padding: 60px;
		}
		.container{
			background: #fff;
			border-radius: 5px;
			padding: 10px;
			width: 700px;
			box-shadow: 0 0 5px #ccc;
		}
		.well{
			margin-top: 15px;
		}
		.hidden{
			display: none;
		}
	</style>
</head>
<body>









	<div class="container">
			Bienvenue Nous sommes le <?php print date("m/d/y G.i:s<br>", time()); ?> 
			La boutique en ligne openSHOP est un travail réalisé par MOSSI 
				puis modifié et adapté au cours de different Avancés.
				Dans la partie haute, vous trouverez un moyen pour vous identifiez ou créer un compte si vous n'en n'avez aucun. Le champ de recherche 
				vous permet d'afficher simplement les produits correspondants à ce que vous souhaitez. Vous pouvez aussi naviguer entre les différentes 
				catégorie de produits en cliquant sur celle que vous désirez voir.
				Bonne naviguation !
	</div>
	<div class="container">
		<div class="page-header">
			<h2>Current Products</h2>
		</div>
		<div class="row">
		<?php $products = getProducts(); ?>
		<?php foreach ($products as $p): ?>

			<div class="span4" style="text-align: center;">
				<h3><a href="view.php?id=<?php echo $p['id']; ?>"><?php echo $p['name']; ?></a></h3>
				<img  src="http://placehold.it/150x200" alt="">
				<div class="likes well">
				<?php if (!liked($p['id'], $_SERVER['REMOTE_ADDR'])): ?>
					<a href="#" class='like' data-id="<?php echo $p['id']; ?>"><img src="img/thumb-up.png"></a> 
					<a href="#" class='unlike hidden' data-id="<?php echo $p['id']; ?>"><img src="img/thumb-down.png"></a>

				<?php else: ?>
					<a href="#" class='like hidden' data-id="<?php echo $p['id']; ?>"><img src="img/thumb-up.png"></a> 
					<a href="#" class='unlike' data-id="<?php echo $p['id']; ?>"><img src="img/thumb-down.png"></a> 

				<?php endif ?>
					<span class="badge badge-success like-count"><?php echo getLikes($p['id']); ?></span> |
					<img src="img/eye.png" alt="">  <span class="badge badge-info"><?php echo $p['views']; ?></span> |
					<span><a id="thanks" data-toggle="modal" href="#form-content" class="btn btn-primary"><img src="img/telephone.png"></a></span>
				</div>
			</div>


		<?php endforeach ?>
			
		</div>

	</div>	

 <!-- model content --> 
 <div id="form-content" class="modal hide fade in" style="display: none; ">
         <div class="modal-header">
               <a class="close" data-dismiss="modal">×</a>
               <h3>Contact</h3>
         </div>
 <div>
 <form class="contact">
 <fieldset>
          <div class="modal-body">
          <ul class="nav nav-list">
 <li class="nav-header">Numero</li>
 <li><input class="input-xlarge" placeholder="telephone" type="text" name="name" required></li>
 <li class="nav-header">Email</li>
 <li><input class="input-xlarge" placeholder="mail" type="text" name="Email"></li>
 </ul> 
         </div>
 </fieldset>
 </form>
 </div>
      <div class="modal-footer">
          <button class="btn btn-success" id="submit" data-dismiss="modal">submit</button>
          <a href="#" class="btn" data-dismiss="modal">Close</a>
   </div>
 </div>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script src="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/comportement.js"></script>
	<script type="text/javascript">
		 $(function() {

//twitter bootstrap script
 $("button#submit").click(function(){
    $.ajax({
    		   type: "POST",
 url: "process.php",
 data: $('form.contact').serialize(),
         success: function(msg){
           		  $("#thanks").html(msg)
          $("#form-content").modal('hide'); 
         },
 error: function(){
 alert("failure");
 }
       });
 });
});
	</script>
</body>
</html>