<?php
	session_start();
	
		$login = $_POST['login'];
		$password = $_POST['password'];

		// Connexion à la base de données MySQL 
        $conn = mysqli_connect("localhost","root","root","moduleconnexion");

		// Vérifier la connexion
		if($conn === false){
    	die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
		}

if (isset($_POST['login'],$_POST['password'])){
  $login = stripslashes($_POST['login']);
  $login = mysqli_real_escape_string($conn, $login);
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `utilisateurs` WHERE login='$login' and password='".hash('sha256', $password)."'";
  $result = mysqli_query($conn,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);
  if($rows==1){
      $_SESSION['login'] = $login;

	  $_SESSION ["id"] = $res [0][0];
      header("Location: ../index.php");


  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }

}
?>
 
 <html lang="fr">

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/moduleconnexion.css ">
		<title>Connexion</title>
	</head>
	
	<body>
		<div id="mainWrapper">
			<div id="mainTitle">
				<div>
					<a href="index.php" id="title"><h1>Connexion Vente Privée</h1></a>	
				</div>
				
			</div>			

			<form method="post" action="#">
				<div>
					<label for="login">Your Username</label>
					<input type="text" name="login" required/>
				</div>
				
				<div>
					<label for="password">Your Password</label>
					<input type="password" name="password" required/>
				</div>
				
				<div style="justify-content:center;">
					<input type="submit" value="Login" name="submitBtn"/>
				</div>
				
			</form>

		</div>
	
	</body>
</html>


