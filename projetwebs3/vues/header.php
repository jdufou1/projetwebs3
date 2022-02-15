<header>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="../public/css/header.css"/>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Groups<span style="color: rgb(8, 158, 228);">4</span>Votes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
    </ul>
    
  

  <?php

  if(!isset($_SESSION['logged'])){
    echo '<form method="POST" action=" ../controleurs/connexion_utilisateur.php">';
    echo '      <input class="form-control inputCo" type="text" placeholder="E-mail..." name="email" required/>';
    echo '      <input class="form-control inputCo" type="password" placeholder="Mot de passe..." name="pwd" required/>';
    echo '      <input class="form-control inputCo" type="submit" name="submit" value="se connecter"/> ';
    echo '</form>';
  }else{
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();
    //$bdd = new PDO('mysql:host=localhost;dbname=moveit', 'admin', 'admin', [PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION]);
  
    // Requete pour savoir le nombre de compte de l'utilisateur actif :

      $requeteGroupUser = "SELECT DISTINCT m.idGroup FROM memberlist m WHERE m.idUser = ".$_SESSION['idUser']." AND idProposition IS NULL";
      //echo $_SESSION['co'];
      $resultGroup = mysqli_query($co,$requeteGroupUser) or die ("<br>Requête sur les groupes de l'utilisateur impossible : ".mysqli_error($co));
      //while ($donnee = mysqli_fetch_array($resultGroup)) { $_SESSION['nbGroup'] = $donnee['nbGroup']; }
      $_SESSION['nbGroup'] = mysqli_num_rows($resultGroup);

      echo '<hr class="headerhr"/>';

      echo '  <div class="menuNavBar">';
      echo '    <a href="accueil.php" class="nav-item nav-link">Accueil</a>';
      echo '    <a href="creer.php" class="nav-item nav-link">Créer</a>';
      echo '    <a href="groupes.php" class="nav-item nav-link">Groupes</a>';
      echo '    <a href="messages.php" class="nav-item nav-link">Messages</a>';
      echo '  </div>';
      echo '  <div class="searchGroupBar">';
      echo '    <input type="text" class="form-control searchGroupBar" placeholder="Trouver un groupe..."/>';
      echo '  </div>';
   
      echo '<hr class="headerhr"/>';



      // Affichage des informations du profil : 

      echo '<div class="profilField">';
      echo '    <div class="profilField-profilPic">';
      echo '      <img src="'.$_SESSION['profilPic'].'"/>';
      echo '    </div>';
      echo '    <div class="profilField-infoField">';
      echo '      <a href="./parametre.php"><h4 class="nameUser">'.$_SESSION["nameUser"].'</h4></a>';
      echo '      <a href="./parametre.php"><h4>'.$_SESSION["firstNameUser"].'</h4></a>';
      echo '      <p>(<b>'.$_SESSION['nbGroup'].'</b> groupes)</p>';
      echo '    </div>';
      echo '</div>';
  }
        /*
        if(!isset($_SESSION['logged'])){
        echo ' <a class="nav-link navbar-text" href="#">Connexion <span class="sr-only">(current)</span></a>';
        }
        else{
            
        }
        */
    ?>
    </div>
</nav>


</header>
