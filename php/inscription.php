<?php

	// Connexion à la base de données MySQL 
  $conn = mysqli_connect("localhost","root","root","moduleconnexion");

  // Vérifier la connexion
  if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
  }


//Je vérifie que les requètes existent 
if (isset($_REQUEST['login'] , $_REQUEST['nom'] , $_REQUEST['prenom'] , $_REQUEST['password'])) {

    $login = stripslashes($_REQUEST['login']); //Retire les antislashes des formulaires

    $login = mysqli_real_escape_string($conn , htmlspecialchars($login)); //Permet de rendre compréhensibles les caractères spécieux pour la$conn

    $nom = stripslashes($_REQUEST['nom']);//Retire les antislashes des formulaires

    $nom = mysqli_real_escape_string($conn , htmlspecialchars ($nom)); //Permet de rendre compréhensibles les caractères spécieux pour la$conn

    $prenom = stripslashes($_REQUEST['prenom']);//Retire les antislashes des formulaires

    $prenom = mysqli_real_escape_string($conn , htmlspecialchars ($prenom)); //Permet de rendre compréhensibles les caractères spécieux pour la$conn

    $password = stripslashes($_REQUEST['password']);//Retire les antislashes des formulaires

    $password = mysqli_real_escape_string($conn , htmlspecialchars ($password));//Permet de rendre compréhensibles les caractères spécieux pour la$conn
   


    
    if (isset($_POST['login'])) {

        $query = "SELECT login FROM utilisateurs WHERE login='$login'";//Ecriture de la requête 

        $result = mysqli_query($conn,$query) or die(mysql_error());//Requête à la base de données 

        $rows = mysqli_num_rows($result);
        if($rows==1){   
            echo "Ce nom d'utilisateur est déjà attribué, veuillez en choisir un autre";
        }
        else{
        
        //Je vérifie que les "POST" existent pour faire comprendre à PHP que la valeur est "null" et non pas inexistante (--> erreur)
        if (isset($_POST['password'] , $_POST['password2'])){

            $password = htmlspecialchars($_POST['password']); //On rajoute htmlspecialchars pour empêcher les injections SQL

            $confirmation = htmlspecialchars($_POST['password2']); //On rajoute htmlspecialchars pour empêcher les injections SQL
        
        
            //On vérifie si les mot de passe sont les mêmes 
            if ($password == $confirmation ) {

                //Requète SQL qui va permettre d'insérer des valeurs dans la base de données
                $query = "INSERT into utilisateurs (login, nom, prenom , password)

                VALUES ('$login', '$nom', '$prenom' ,  '".hash('sha256', $password)."')";
                //Utilisation de ".hash" pour 'hacher' le mot de passe dans la base de données


                 
                //Requète pour récupérer les données de la$conn
                $res = mysqli_query($conn , $query);

                    echo "<div class='sucess'>
                     <h3>Vous êtes inscrit avec succès.</h3>
                      <p>Cliquez ici pour vous <a href='connexion.php'>connecter</a></p>
                    </div>";

                    
            }

            //Si les mot de passe ne sont pas les mêmes on affiche un message d'erreur et la requête ne s'effectue pas car la condition est "false"
            else{
                echo "ERREUR = Le mot de passe que vous avez attribué n'est pas le même dans les deux champs.";
            }
        }
        
    
    }

}
}    
else {
  




    

?>

<html lang="fr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/inscription.css">
  <title>Inscription</title>
</head>

<body>
  <div id="mainWrapper">
    <div id="mainTitle">
      <div>
        <a href="index.php" id="title"><h1> Inscription Vente Privée</h1></a>
      </div>
      
    </div>			

    <form method="post" action="#">
      <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" required/>
      </div>
      
      <div>
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" required/>
      </div>

      <div>
        <label for="login">Username</label>
        <input type="text" name="login" required/>
      </div>

      <div>
        <label for="password">Password</label>
        <input type="password" name="password" required/>
      </div>

      <div>
        <label for="password">Confirmer</label>
        <input type="password" name="password2" required/>
      </div>
      
      <div style="justify-content:center;">
        <input type="submit" value="Login" name="submitBtn"/>
      </div>
      
    </form>
  </div>
  <?php } ?>
</body>
</html>
