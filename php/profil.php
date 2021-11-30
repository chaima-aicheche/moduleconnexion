<?php
session_start();
	
	$bdd = mysqli_connect("localhost","root","root","moduleconnexion");
	$sesslogin = $_SESSION["login"];
	$req= mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$sesslogin'");
	$res= mysqli_fetch_all($req,MYSQLI_ASSOC);
	$login = $res[0]['login'];
	$prenom = $res[0]['prenom'];
	$nom = $res[0]['nom'];
	$password = $res[0]['password']; 

	

if (isset($_POST['submitBtn']))
{
    $nom10 = $_POST['nom'];
    $prenom10 = $_POST['prenom'];
	$lastpass =  $_POST['password'];
    $password10 = $_POST['passwordChange'];
    $login10 = $_POST['login'];
		$requete = "UPDATE utilisateurs SET login='$login10', prenom='$prenom10', nom='$nom10', password= '".hash('sha256', $password10)."' WHERE  login = '$sesslogin' and password='".hash('sha256', $lastpass)."'";
		echo var_dump($requete);
		$req2= mysqli_query($bdd, $requete) or die(mysql_error()) ;
		$rows = mysqli_num_rows($req2);
		// var_dump($bdd);
		if($rows == 1){header("Location: ../index.php");}
		else{echo 'mauvais';header("Location: profil.php");}

}

?>

<html lang="fr">

	<head>
		<meta charset="utf-8">
        <link rel="stylesheet" href="../css/moduleconnexion.css">
		<title>Vente Privée - profil</title>
	</head>
	
	<body>
		<div id="mainWrapper">
			<div id="mainTitle">
				<div>
					<a href="index.php" id="title"></a>
					<p id="discovered">Profil <?php echo $_SESSION["login"]; ?></p>
			<form method="post" action="#">
		

				<div>
					<label for="login">Login</label>
					<input type="text" name="login" value="<?php echo $login?>"  required/>
				</div>
				
				<div>
					<label for="prenom">Nom</label>
					<input type="text" name="prenom"  value='<?php echo $nom ?> 'required/>
				</div>

				<div>
					<label for="nom">Prénom</label>
					<input type="text" name="nom"  value='<?php echo $prenom ?> 'required/>
				</div>
								
				<div id="password">
					<label for="password">Last Password</label>
					<input type="password" name="password" required/>
				</div>
				

				<div id="passwordChange">
					<label for="passwordChange">New Password</label>
					<input type="password" name="passwordChange"/>
				</div>				

				<a class="aaa" href='../index.php'> Accueil</a>
				<input type="submit" value="Edit" name="submitBtn" />
			</div>
			</form>
		</div>
	</body>
	
</html>

