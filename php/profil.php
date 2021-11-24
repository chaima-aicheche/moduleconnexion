<?php

	session_start();
	$connect = mysqli_connect("localhost","chaima","","moduleconnexion");
	$request= "SELECT login,prenom,nom,password FROM utilisateurs WHERE login = '".$_SESSION["login"]."';";
	$query = mysqli_query($connect,$request);
	$result = mysqli_fetch_all($query);	
	
	if(isset($_POST["submitBtn"])) 
	{
		if(password_verify($_POST["password"], $result[0][3]))
		{	
			foreach($_POST as $key => $value)
			{
				if($key != "password"  && $key != "passwordChange" && $key != "submitBtn")
				{
				$request= "SELECT ".$key." FROM utilisateurs WHERE login = '".$_SESSION["login"]."';";
				$queryCheck = mysqli_query($connect,$request);
				$response = mysqli_fetch_all($queryCheck);
					
					
				
				if ($value != $response[0][0])
				{
				$request= "UPDATE utilisateurs SET ".$key." = '".$value."' WHERE login = '".$_SESSION["login"]."';";
				mysqli_query($connect,$request);
				}		
				}
				else if($key == "passwordChange" && strlen($value) > 0)
				{
				$request= "UPDATE utilisateurs SET password = '".password_hash($value,PASSWORD_BCRYPT)."' WHERE login = '".$_SESSION["login"]."';";
				$query = mysqli_query($connect,$request);
				}
			}
		}
	}
	
	$request= "SELECT login,prenom,nom,password FROM utilisateurs WHERE login = '".$_SESSION["login"]."';";
	$query = mysqli_query($connect,$request);
	$result = mysqli_fetch_all($query);	


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
		
			<form method="post" action="">

				<div>
					<label for="login">Username</label>
					<input type="text" name="login" value='<?php echo $result[0][0]; ?>' required/>
				</div>
				
				<div>
					<label for="prenom">Name</label>
					<input type="text" name="prenom" value='<?php echo $result[0][1]; ?>' required/>
				</div>

				<div>
					<label for="nom">Lastname</label>
					<input type="text" name="nom" value='<?php echo $result[0][2]; ?>' required/>
				</div>
								
				<div id="password">
					<label for="password">Password</label>
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

