<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Faire un commentaire</title>
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
            <div class="col-sm-4"> 
                <?php
                    // On récupere l'id du groupe et l'id de la proposition : 
                    $idProposition = $_GET['idProposition'];
                    $idGroupe = $_GET['idGroupe'];
                    
                ?>
                    <h3 class="group-titleh3">Commenter une proposition</h3>
                    <hr class="group-hr"/>
                    <form action="../controleurs/creerCommentaire.php?idGroupe=<?php echo $idGroupe ?>&idProposition=<?php echo $idProposition ?>" method="POST">
                        <span>Contenue de votre commentaire :</span>
                        <textarea type="text" class="form-control" name="textComment" placeholder="Aa" ></textarea>
                        <input type="submit" class="form-control" style="width: auto; margin-top: 10px;" value="Envoyer"/>
                    </form>
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