<?php 

session_start(); 

/*if(isset($_session))
	{*/
		session_destroy();
		
	/*}*/
	header('location:login.php');
?>

