<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Groupe</title>
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
            <?php                         
            //On ouvre une connexion
            $bd = new Bd();
            $co = $bd->ouvrirConnexion();
            // Test pour savoir si l'utilisateur fait partie du groupe : 
            $requestVerif = "SELECT DISTINCT idGroup FROM memberlist mb WHERE mb.idGroup = ".$_GET['id']." AND idUser = ".$_SESSION['idUser'];
            $resultVerif = mysqli_query($co,$requestVerif);
            if(mysqli_num_rows($resultVerif) == 1){
                echo '<div class="col-sm-3">';
            }else{
                echo '<div class="col-sm-4">';
            }
                    
                        
                        // requete pour avoir les information du groupe :
                        $resultGroup = mysqli_query($co,"SELECT * 
                                                        FROM JGROUP G 
                                                        WHERE G.idGroup = ".$_GET['id']);
                        if(mysqli_num_rows($resultGroup)<1){
                            echo '<h3 class="group-titleh3">Information</h3>';
                            echo '<hr class="group-hr"/>';
                            echo "<p> Aucune informations sur ce groupe.</p>";
                        }else{  
                            while($donnee = mysqli_fetch_array($resultGroup)){
                                echo '<h3 class="group-titleh3">Identifiant</h3>';
                                echo '<hr class="group-hr"/>';
                                echo '<p>'.$donnee['idGroup'].'</p>';  
                                echo '<h3 class="group-titleh3">Nom du groupe</h3>';
                                echo '<hr class="group-hr"/>';
                                echo '<p>'.$donnee['nameGroup'].'</p>';
                                echo '<h3 class="group-titleh3">Date de création</h3>';
                                echo '<hr class="group-hr"/>';
                                echo '<p>'.$donnee['dateGroup'].'</p>';
                                echo '<h3 class="group-titleh3">Description</h3>';
                                echo '<hr class="group-hr"/>';
                                echo '<p>'.$donnee['descGroup'].'</p>';
                            }
                            echo '<h3 class="group-titleh3">Nombre de membres</h3>';
                            echo '<hr class="group-hr"/>';
                            $resultNbMembers = mysqli_query($co,"SELECT DISTINCT m.idUser
                                                                FROM memberlist m 
                                                                WHERE m.idGroup = ".$_GET['id']." 
                                                                AND m.idProposition IS NULL
                                                                GROUP BY m.idUser");
                            if(mysqli_num_rows($resultNbMembers)<1){
                                echo "<p>Groupe avec aucun membres.</p>";
                            }
                            else{
                                echo '<p>'.mysqli_num_rows($resultNbMembers).'</p>';
                            }
                            echo '<h3 class="group-titleh3">Nombre de publications</h3>';
                            echo '<hr class="group-hr"/>';
                            $resultNbProposition = mysqli_query($co,"SELECT DISTINCT COUNT(*) as nbProposition 
                                                                    FROM memberlist m, PROPOSITION P 
                                                                    WHERE P.idProposition = m.idProposition 
                                                                    AND m.idGroup = ".$_GET['id']);
                            if(mysqli_num_rows($resultNbProposition)<1){
                                echo "<p>Groupe avec aucune publication.</p>";
                            }
                            else{
                                while($donneeNbProposition = mysqli_fetch_array($resultNbProposition)){
                                    echo '<p>'.$donneeNbProposition['nbProposition'].'</p>';
                                }
                            }

                        }
                    ?>

                </div>

            <?php 
            if(mysqli_num_rows($resultVerif) == 1){
            echo '<div class="col-sm-6">';
            echo '<h3 class="group-titleh3" style="">Toutes les publications</h3>';
                        echo '<hr class="group-hr"/>';
                        $resultMostPopularProposition = mysqli_query($co,"SELECT DISTINCT P.idProposition, P.shortDescProposition,P.dateProposition,U.loginUser,P.longDescProposition,P.photoProposition,P.vote,P.deadline
                                                                            FROM memberlist MB, PROPOSITION P, JUSER U
                                                                            WHERE MB.idProposition = P.idProposition
                                                                            AND U.idUser = MB.idUser
                                                                            AND MB.idGroup = ".$_GET['id']." 
                                                                            AND MB.idProposition IS NOT NULL");
                        if(mysqli_num_rows($resultMostPopularProposition)<1){
                            echo "<p>Groupe avec aucune publication.</p>";
                            ?>
                                <input type="button"value="Faire une proposition"class="form-control" onClick="javascript:document.location.href='./proposition.php?idGroupe=<?php echo $_GET['id']; ?>'">
                            <?php
                        }
                        else{
                            while($donneeProposition = mysqli_fetch_array($resultMostPopularProposition)){
                                // faire une requeste pour compter le nbr de like pour cette prop
                                $requestLike2 = "SELECT COUNT(*) AS NbredeLike
                                FROM JLIKE 
                                WHERE idProposition = ".$donneeProposition['idProposition']."
                                AND voteValue = 1";
                                $resultLike2 = mysqli_query($co,$requestLike2);
                                while($donneeLike = mysqli_fetch_array($resultLike2)){ $likeResult = $donneeLike['NbredeLike'];}

                                // requete pour savoir si l'user courant a aimé la prop
                                $requestLike = "SELECT idUser FROM JLIKE WHERE idProposition = ".$donneeProposition['idProposition']." AND idUser = ".$_SESSION['idUser']."
                                AND voteValue = 1";
                                $resultLike = mysqli_query($co,$requestLike);
                                echo '<div class="group">'; // DEBUT DIV VIEW PROPOSITION

                                echo '    <p class="group-groupName">De '.$donneeProposition['loginUser'].'</p>';
                                echo '    <p class="group-groupDate"> publiée le : '.$donneeProposition['dateProposition'].'</p>';
                                if($donneeProposition['vote'] == 0 || date($donneeProposition['deadline']) < date("Y-m-d")){
                                    if(mysqli_num_rows($resultLike)<1){
                                        echo '    <p class="group-groupMember"><img src="../public/img/icons/filledLike.png" class="filledLike"/>Aimé par <b>'.$likeResult.'</b> personne(s)</p>';
                                    }else{
                                        

                                        $nbLikePeople = $likeResult-1;
                                        if($nbLikePeople != 0){
                                            echo '    <p class="group-groupMember"><img src="../public/img/icons/filledLike.png" class="filledLike"/>Aimé par vous et <b>'.$nbLikePeople.'</b> personne(s)</p>';
                                        }
                                        else{
                                            echo '    <p class="group-groupMember"><img src="../public/img/icons/filledLike.png" class="filledLike"/>Aimé par vous</p>';
                                        }
                                    }
                                }
                                // Afficher le nombre de commentaires : 

                                $requestComment =  'SELECT COUNT(*) AS nbComment
                                                    FROM commentary
                                                    WHERE idProposition = '.$donneeProposition['idProposition'].'
                                                    AND idComment IS NOT NULL';
                                $resultComment = mysqli_query($co,$requestComment);
                                while($donneeComment = mysqli_fetch_array($resultComment)){ $nbComment = $donneeComment['nbComment'];}
                                if($nbComment > 0 ){ 
                                    echo '<p class="group-groupMember"><img src="../public/img/icons/comment.png" class="filledLike"/><b> '.$nbComment.'</b> commentaire(s)
                                    <a href="./vueCommentaire.php?idProposition='.$donneeProposition['idProposition'].'&idGroupe='.$_GET['id'].'" style="font-size: 110%;"> - voir</a></p>';

                                }
                                else{
                                    echo '<p class="group-groupMember"><img src="../public/img/icons/comment.png" class="filledLike"/><b> '.$nbComment.'</b> commentaire(s)</p>';
                                }
                                // Affichage des signalement : 
                                $requestReport = "SELECT DISTINCT idUser FROM REPORTPROPOSITION WHERE idProposition = ".$donneeProposition['idProposition'];
                                $resultReport = mysqli_query($co,$requestReport);
                                if(mysqli_num_rows($resultReport)>0){
                                    echo '<p class="group-groupMember"><img src="../public/img/icons/warningActive.png" class="filledLike"/><b> '.mysqli_num_rows($resultReport).'</b> signalement(s)</p>';
                                }








                                // afficher les catégories de la proposition : 
                                $requestCategories = "SELECT DISTINCT C.nameCategory, CL.categoryLevel
                                                      FROM CATEGORY C, categoryList CL
                                                      WHERE CL.idCategory = C.idCategory
                                                      AND CL.idProposition = ".$donneeProposition['idProposition'];
                                $resultCategories = mysqli_query($co,$requestCategories);
                                $cat = "<div></div>";
                                if(mysqli_num_rows($resultCategories)<1){
                                    echo '<div style="font-size: 90%;">Cette proposition n\'a pas de catégories</div>';
                                }else{
                                    while($donneeCat = mysqli_fetch_array($resultCategories)){
                                        if($donneeCat['categoryLevel'] == "primaire"){
                                            $cat .= "<div style='display: inline-block;margin-left: 3px;'
                                            class='badge badge-pill badge-primary'><b>".$donneeCat['nameCategory']."</b></div>";
                                        }else{
                                            $cat .= "<div style='display: inline-block;margin-left: 3px;'
                                            class='badge badge-pill badge-secondary'><b>".$donneeCat['nameCategory']."</b></div>";
                                        }
                                    }
                                }
                                echo $cat;
                                
                                echo '    <p class="group-groupDesc">'.$donneeProposition['shortDescProposition'].'</p>';
                                echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';
                                // Photo et longDesc field
                                echo '    <div class="propContent">';
                                if($donneeProposition['photoProposition'] != "../public/img/users/none"){
                                    echo '      <img class="picProposition" src="'.$donneeProposition["photoProposition"].'"/>';    
                                }
                                echo '      <p class="group-groupLongDesc">'.$donneeProposition['longDescProposition'].'</p>';
                                // VOTE FIELD DEBUT

                                if($donneeProposition['vote'] == 1){
                                    echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';

                                    // Savoir les votes pour et contre
                                    $voteContre = "SELECT COUNT(*) AS nbDislike
                                                   FROM JLIKE 
                                                   WHERE idProposition = ".$donneeProposition['idProposition']
                                                 ." AND voteValue = 0";
                                                 //echo $voteContre;
                                    $resultvoteUser = mysqli_query($co,$voteContre);
                                    while($donneeDislike = mysqli_fetch_array($resultvoteUser)){$nbDislike = $donneeDislike['nbDislike'];}

                                    if(date($donneeProposition['deadline']) < date("Y-m-d")){
                                        echo "<p>Ce vote a été cloturé le : <b>".$donneeProposition['deadline']."</b></p>";
                                        echo "<div>".$likeResult." membres ont aimé ce vote.</div>";
                                        //echo $voteContre;
                                        echo "<div>".$nbDislike." membres n'ont pas aimé ce vote.</div>";
                                    }else{
                                        $dateRestante = date($donneeProposition['deadline']);
                                        echo "<p>Ce vote ce cloture le <b>".$dateRestante."</b></p>";
                                    }

                                }

                                // Savoir si l'user a vote contre
                                $userContre = "SELECT idUser
                                                   FROM JLIKE 
                                                   WHERE idProposition = ".$donneeProposition['idProposition']
                                                 ." AND voteValue = 0
                                                 AND idUser = ".$_SESSION['idUser'];
                                                 //echo $voteContre;
                                $resultcontreUser = mysqli_query($co,$userContre);




                                // VOTE FIELD FIN





                                echo '    </div>';
                                echo '    <div class ="optionField">';
                                if($donneeProposition['vote'] == 0 || (date($donneeProposition['deadline']) > date("Y-m-d") && $donneeProposition['vote'] == 1 )){
                                    if(mysqli_num_rows($resultLike)<1 && mysqli_num_rows($resultcontreUser)<1){
                                        echo '      <span><a href="../controleurs/control_propUpdate.php?idProposition='.$donneeProposition['idProposition'].'&idGroupe='.$_GET['id'].'"><img src="../public/img/icons/emptyLike.png" class="optionPic emptyLikeAction" /></a></span>';
                                        echo '      <span><a href="../controleurs/control_dislike.php?idProposition='.$donneeProposition['idProposition'].'&idGroupe='.$_GET['id'].'"><img src="../public/img/icons/dislike.png" class="optionPic emptyLikeAction" /></a></span>';
                                        
                                    }else if(mysqli_num_rows($resultLike)>0){
                                        echo '      <span><img src="../public/img/icons/filledLike.png" class="optionPic filledLikeAction" id="'.$donneeProposition['idProposition'].'"/></span>';
                                    }
                                    else if(mysqli_num_rows($resultcontreUser)>0){
                                        echo '      <span><img src="../public/img/icons/filledDislike.png" class="optionPic filledLikeAction" id="'.$donneeProposition['idProposition'].'"/></span>';

                                    }
                                }



                                echo '      <span><img src="../public/img/icons/comment.png" class="optionPic comment" id="idProposition='.$donneeProposition['idProposition'].'&idGroupe='.$_GET['id'].'"/></span>';
                                
                                
                                $reportMy = "SELECT DISTINCT idProposition FROM REPORTPROPOSITION WHERE idUser = ".$_SESSION['idUser']." AND idProposition  = ".$donneeProposition['idProposition'];
                                $myReport = mysqli_query($co,$reportMy);
                                if(mysqli_num_rows($myReport) != 1){
                                    echo '      <span><a href="../controleurs/control_Signaler.php?idProposition='.$donneeProposition['idProposition'].'&idGroupe='.$_GET['id'].'"><img src="../public/img/icons/report.png" class="optionPic report" /></a></span>';
                                }
                                echo '    </div>';
                                echo '</div>'; // FIN DIV VIEW PROPOSITION
                                //DEBUT AFFICHAGE COMMENTAIRE DE LA PROPOSITION
                                
                            }
                            ?>
                            <input type="button"value="Faire une proposition"class="form-control" onClick="javascript:document.location.href='./proposition.php?idGroupe=<?php echo $_GET['id']; ?>'">
                            <?php
                        }
            echo '</div>';
            }else{
            ?>
                <div class="col-sm-4">
                    <?php
                        echo '<h3 class="group-titleh3">Les 5 meilleurs publications</h3>';
                        echo '<hr class="group-hr"/>';
                        $resultMostPopularProposition = mysqli_query($co,"SELECT P.idProposition, P.shortDescProposition,P.dateProposition,P.photoProposition,U.loginUser
                                                                            FROM memberlist MB, PROPOSITION P, JUSER U
                                                                            WHERE MB.idProposition = P.idProposition
                                                                            AND U.idUser = MB.idUser
                                                                            AND MB.idGroup = ".$_GET['id']." 
                                                                            AND MB.idProposition IS NOT NULL
                                                                            LIMIT 5");
                        if(mysqli_num_rows($resultMostPopularProposition)<1){
                            echo "<p>Groupe avec aucune publication.</p>";
                        }
                        else{

                            while($donneeProposition = mysqli_fetch_array($resultMostPopularProposition)){

                                // faire une requeste pour compter le nbr de like pour cette prop
                                $requestLike2 = "SELECT COUNT(*) AS NbredeLike
                                FROM JLIKE 
                                WHERE idProposition = ".$donneeProposition['idProposition']."
                                AND voteValue = 1";
                                $resultLike2 = mysqli_query($co,$requestLike2);
                                while($donneeLike = mysqli_fetch_array($resultLike2)){ $likeResult = $donneeLike['NbredeLike'];}

                                echo '<div class="group">';
                                echo '    <p class="group-groupName">De '.$donneeProposition['loginUser'].'</p>';
                                echo '    <p class="group-groupDate"> publiée le : '.$donneeProposition['dateProposition'].'</p>';
                                echo '    <p class="group-groupMember"><img src="../public/img/icons/filledLike.png" class="filledLike"/>Aimé par <b>'.$likeResult.'</b> personnes</p>';
                                echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';
                                echo '    <p class="group-groupDesc">'.$donneeProposition['shortDescProposition'].'</p>';
                                echo '</div>';
                            }
                        }
                        
                    ?>
                </div>
            <?php }
            if(mysqli_num_rows($resultVerif) == 1){
                echo '<div class="col-sm-3">';
            }else{
                echo '<div class="col-sm-4">';          
            }   
                    echo '<h3 class="group-titleh3">Liste des membres</h3>';
                    echo '<hr class="group-hr"/>';

                    $resultNbMembers = mysqli_query($co,"SELECT DISTINCT m.idGroup, j.profilPic, j.nameUser, j.firstNameUser, j.loginUser
                                                         FROM memberlist m, JUSER j, JGROUP g
                                                         WHERE m.idUser = j.idUser
                                                         AND m.idGroup = g.idGroup
                                                         AND g.idGroup = ".$_GET['id']."
                                                         AND m.idProposition IS NULL");
                    if(mysqli_num_rows($resultNbMembers)<1){
                        echo "<p>Groupe avec aucun membres.</p>";
                    }
                    else{
                        while($donnee = mysqli_fetch_array($resultNbMembers)){
                            echo '<p><img src="../public/img/icons/userHomme.png" class="userPic"/>'.$donnee['nameUser'].' '.$donnee['firstNameUser'].'</p>';
                        }
                    }

                    // Affichage du panneau administratif : 
                    
                    $admin = "SELECT idUser FROM adminList WHERE idGroup = ".$_GET['id']." AND idUser = ".$_SESSION['idUser'];
                    $resultAdmin = mysqli_query($co,$admin);

                    if(mysqli_num_rows($resultAdmin)>0){
                        echo '<h3 class="group-titleh3">Panneau administratif</h3>';
                        echo '<hr class="group-hr"/>';
                        echo '<p><a href="./exclure.php?idGroupe='.$_GET['id'].'">Exclure un membre</a></p>';
                        echo '<p><a href="./supprimerProposition.php?idGroupe='.$_GET['id'].'">Supprimer une proposition</a></p>';
                        echo '<p><a href="./supprimerCommentaire.php?idGroupe='.$_GET['id'].'">Supprimer un commentaire</a></p>';
                        echo '<p><a href="./ajouterMembre.php?idGroupe='.$_GET['id'].'">Inviter une personne</a></p>';
                    }


                    
                    


                
            echo '</div>';
            
            ?>
        </div>
    </div>

    <?php
    echo '<div id="idGroup" class="'.$_GET['id'].'"></div>';
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

<script>

    var idGroupe = document.getElementById('idGroup').className;

    var comment = document.getElementsByClassName('comment');
    
    //var emptyLikeAction = document.getElementByClassName('emptyLikeAction');
    /*
    Array.from(document.getElementsByClassName("emptyLikeAction")).forEach(function(proposition) {
        proposition.onclick = function(){          
            var request = new XMLHttpRequest();

            request.onreadystatechange = function() {
                   if (request.readyState === 4 && request.status === 200){
                      console.log("transmis");
                      console.log(request.responseText);
                   }
           }
           request.open('POST',"../controleurs/control_propUpdate.php");
           request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
           // Variables
           request.send("idProposition="+proposition.id);
           document.location.href="./vueGroupe.php?id="+idGroupe;
        }
    });
    */

    Array.from(document.getElementsByClassName("comment")).forEach(function(proposition) {
        proposition.onclick = function(){ 
            document.location.href="./commentaire.php?"+proposition.id;
        }
    });

    


</script>