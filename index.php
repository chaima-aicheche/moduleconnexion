
			<?php
				session_start();
				if(!isset($_SESSION["login"]))
				{
					echo '<div class=reg> <a id="connexionLink"  href="php/connexion.php">Login</a>
						  <a id="inscriptionLink" href="php/inscription.php">Registration</a> </div>';				
				}
				else
				{   
					echo '<a href="php/profil.php">Your Profil</a>
						  <form method="post" action="#">
							<input id="decoBtn" type="submit" value="Disconnect" name="decoBtn"/>
						  </form>';
						  
					if($_SESSION["login"] == "admin")
					{
						echo"<a href='php/admin.php' style='width:100%;'>Page Admin</a>";
					}	
				}
				
				if(isset($_POST["decoBtn"]))
				{
					session_destroy();
					header("location:#");
				}
			?>
	</div>

	<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/index.css">
	</head>
 <!-- Body -->
<body>
    <!-- Header -->
    <header>
    
        <div class = "connect">
		    <a href="php/index.php"><img src="image/logo.jpg"  width= "40%" height ="auto" /></a>
            <a href="php/connexion.php"> </a>
            <a href="php/inscription.php"></a>
        </div>
    </header>
    <!-- Main -->     
    <main>
    
        <h2 id="titre_con"> Les meilleures promo que pour VOUS ! </h2>
        
    </main>


    <!-- Footer -->
    <footer>
    
    <a href="https://github.com/chaima-aicheche/moduleconnexion"> <img alt="Qries" src="image/logo.png" width="150" height="70"></a>
    </footer>
</body>
