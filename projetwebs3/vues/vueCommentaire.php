<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Tous les commentaires</title>
    <link rel="stylesheet" href="../public/css/vueGroupe.css"/>
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
                    <h3 class="group-titleh3">Tous les commentaires</h3>
                    <hr class="group-hr"/>
                    <div class="group-big">
                        <?php
                            //On ouvre une connexion
                            $bd = new Bd();
                            $co = $bd->ouvrirConnexion();
                            $idProposition = $_GET['idProposition'];
                            $idGroupe = $_GET['idGroupe'];

                            $request = "SELECT textComment,dateComment,loginUser,C.idComment 
                                        FROM JCOMMENT C, commentary CY, JUSER U
                                        WHERE CY.idComment = C.idComment 
                                        AND U.idUser = CY.idUser
                                        AND CY.idProposition = ".$idProposition;
                            $resultComment = mysqli_query($co,$request);
                            //echo $request;
                            while($donneeComment = mysqli_fetch_array($resultComment)){
                                echo '<div class="group">';
                                echo '    <p class="group-groupName"> De '.$donneeComment['loginUser'].'</p>  ';
                                echo '    <p class="group-groupDate"> commentée le : '.$donneeComment['dateComment'].'</p>';
                                echo '    <p class="group-groupMember"></p>';


                                // Affichage des signalement : 
                                $requestReport = "SELECT DISTINCT idUser FROM REPORTCOMMENT WHERE idComment = ".$donneeComment['idComment'];
                                $resultReport = mysqli_query($co,$requestReport);
                                if(mysqli_num_rows($resultReport)>0){
                                    echo '<p class="group-groupMember"><img src="../public/img/icons/warningActive.png" class="filledLike"/><b> '.mysqli_num_rows($resultReport).'</b> signalement(s)</p>';
                                }


                                echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';
                                echo '    <p class="group-groupLongDesc">'.$donneeComment['textComment'].'</p>';


                                $reportMy = "SELECT DISTINCT idComment FROM REPORTCOMMENT WHERE idUser = ".$_SESSION['idUser']." AND idComment  = ".$donneeComment['idComment'];
                                
                                $myReport = mysqli_query($co,$reportMy);
                                if(mysqli_num_rows($myReport) != 1){
                                    echo '      <span><a href="../controleurs/control_SignalerComment.php?idComment='.$donneeComment['idComment'].'&idGroupe='.$idGroupe.'"><img src="../public/img/icons/report.png" class="optionPic report" /></a></span>';
                                }


                                echo '</div>';
                            }



                        ?>
                    </div>

            </div>
            <div class="col-sm-4"> 
                <h3 class="group-titleh3">Informations</h3>
                <hr class="group-hr"/>
                <a href="./vueGroupe.php?id=<?php echo $idGroupe;?>">retour au groupe</a>
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

.group-big{
    height: 600px;
    overflow-y: scroll;
    padding: 2%;
}

</style>

