<?php 

 
// Connexion à la base de données MySQL 
$conn = mysqli_connect("localhost","chaima","","moduleconnexion");

// Vérifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
if (isset($_POST['login'], $_POST['password'],$_POST['nom'], $_POST['prenom'])){
  
  // récupérer login et supprimer les antislashes ajoutés par le formulaire
  $login = stripslashes($_POST['login']);
  $login = mysqli_real_escape_string($conn, $login); 

  // récupérer le prenom et supprimer les antislashes ajoutés par le formulaire
  $prenom = stripslashes($_POST['prenom']);
  $prenom = mysqli_real_escape_string($conn, $prenom); 

  // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
  $nom = stripslashes($_POST['nom']);
  $nom = mysqli_real_escape_string($conn, $nom); 
 
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($conn, $password);

  //requéte SQL + mot de passe crypté
    $query = "INSERT into `utilisateurs` (login,prenom,nom, password)
              VALUES ('$login','$prenom', '$nom', '".hash('sha256', $password)."')";

  // Exécuter la requête sur la base de données
    $res = mysqli_query($conn, $query);
    if(isset($res)){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='connexion.php'>connecter</a></p>
       </div>";
    }
}else{
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
      
      <div style="justify-content:center;">
        <input type="submit" value="Login" name="submitBtn"/>
      </div>
      
    </form>
  </div>
  <?php } ?>
</body>
</html>
