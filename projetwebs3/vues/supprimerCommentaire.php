<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Supprimer un commentaire</title>
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
                    <h3 class="group-titleh3">Les commentaires du groupe</h3>
                    <hr class="group-hr"/>
                        <?php
                            // On récupere l'id du groupe et l'id de la proposition : 
                            $idGroupe = $_GET['idGroupe'];
                            $request = "SELECT C.idComment,textComment, dateComment, loginUser 
                            FROM JCOMMENT C,commentary CY,memberlist MB, JUSER U 
                            WHERE C.idComment = CY.idComment 
                            AND CY.idProposition = MB.idProposition 
                            AND U.idUser = MB.idUser 
                            AND MB.idGroup = ".$idGroupe;
                            $result = mysqli_query($co,$request);
                            if(mysqli_num_rows($result) == 0){
                                echo "<p>Il n'y a aucun commentaire à supprimer.</p>";
                            }else{
                                while($donnee = mysqli_fetch_array($result)){
                                        echo '<p><b>#'.$donnee['textComment'].'</b><a href="../controleurs/control_supComment.php?idComment='.$donnee['idComment'].'&idGroupe='.$idGroupe.'">  supprimer</a>, de '.$donnee['loginUser'].'</p>';
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

</style>