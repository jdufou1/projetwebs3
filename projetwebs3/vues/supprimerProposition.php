<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Supprimer une proposition</title>
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
                    <h3 class="group-titleh3">Les propositions du groupe</h3>
                    <hr class="group-hr"/>
            <?php
                // On récupere l'id du groupe et l'id de la proposition : 
                $idGroupe = $_GET['idGroupe'];
                
                //On ouvre une connexion
                $bd = new Bd();
                $co = $bd->ouvrirConnexion();

                $request = "SELECT P.idProposition,shortDescProposition 
                FROM PROPOSITION P,memberlist MB 
                WHERE MB.idProposition = P.idProposition
                AND MB.idGroup = ".$idGroupe;
                //echo $request;
                $result = mysqli_query($co,$request);
                if(mysqli_num_rows($result) == 0){
                    echo "<p>Il n'y a aucune proposition à supprimer.</p>";
                }else{
                    while($donnee = mysqli_fetch_array($result)){
                            echo '<p>#'.$donnee['shortDescProposition'].'<a href="../controleurs/control_supProposition.php?idProposition='.$donnee['idProposition'].'&idGroupe='.$idGroupe.'">  supprimer</a></p>';
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