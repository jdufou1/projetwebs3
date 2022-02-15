<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Exclure un membre</title>
    <link rel="stylesheet" href="../public/css/accueil.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
</head>
<body>

    <!-- inclure le header -->
    <?php
            include('./header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
        
            <?php
                // On récupere l'id du groupe et l'id de la proposition : 
                $idGroupe = $_GET['idGroupe'];
                //echo 'group : '.$idGroupe;
            ?>  <div class="col-sm-4">
                    <h3 class="group-titleh3">Les membres du groupe</h3>
                    <hr class="group-hr"/>
                    <?php
                        //On ouvre une connexion
                        $bd = new Bd();
                        $co = $bd->ouvrirConnexion();

                        $resultNbMembers = mysqli_query($co,"SELECT DISTINCT m.idGroup, j.profilPic, j.nameUser, j.firstNameUser, j.loginUser,j.idUser
                                                            FROM memberlist m, JUSER j, JGROUP g
                                                            WHERE m.idUser = j.idUser
                                                            AND m.idGroup = g.idGroup
                                                            AND g.idGroup = ".$idGroupe);
                        if(mysqli_num_rows($resultNbMembers)==1){
                            echo "<p>Il n'y a aucun membre à exclure.</p>";
                        }
                        else{
                            while($donnee = mysqli_fetch_array($resultNbMembers)){
                                if($donnee['idUser'] != $_SESSION['idUser'])
                                    echo '<p><img src="../public/img/icons/userHomme.png" class="userPic"/>'.$donnee['nameUser'].' '.$donnee['firstNameUser'].'<a href="../controleurs/supMember.php?idGroupe='.$idGroupe.'&idUser='.$donnee['idUser'].'">exclure</a></p>';
                            }
                        }

                    ?>
                    <hr class="group-hr"/>  
                    <a href="./vueGroupe.php?id=<?php echo $idGroupe;?>">retour</a>
                </div>
                <div class="col-sm-4"> 
                </div>
                <div class="col-sm-4"> 
                </div>
            



        </div>
    </div>

    <!-- inclure le footer -->
    <?php
            include('./footer.php');
    ?>
</body>
</html>
<style>
body{ 
    background-color: #DCDCDC; 


}
.container-fluid{
    min-height: 600px;
    height: auto;
}

.userPic{
    height: auto;
    width: 35px;
}

</style>