<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Inviter une personne</title>
    <link rel="stylesheet" href="../public/css/accueil.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
</head>
<body>

    <!-- inclure le header -->
    <?php
            include('./header.php');
            $idGroupe = $_GET['idGroupe'];
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"> 
                <form action="../controleurs/control_inviterMember.php?idGroupe=<?php echo $idGroupe;?>" method="POST">
                    <h3 class="group-titleh3">Inviter une personne</h3>
                    <hr class="group-hr"/>
                    <input class="form-control" type="email" id="email" name="email" placeholder="Adresse mail..." required/>
                    <input type="submit" class="form-control" style="width: auto; margin-top: 10px;" value="Envoyer une invitation"/>
                </form>
            <?php
                // On récupere l'id du groupe et l'id de la proposition : 
                $idGroupe = $_GET['idGroupe'];
                //echo 'group : '.$idGroupe;
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

</style>