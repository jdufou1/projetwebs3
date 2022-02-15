<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Vos Groupes</title>
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
            <div class="col-sm-6"> 
                <h3 class="group-titleh3">Vos groupes admins</h3>
                <hr class="group-hr"/>
                <?php
                        //On ouvre une connexion
                        $bd = new Bd();
                        $co = $bd->ouvrirConnexion();
                        // requete pour avoir les  5 groupes avec le plus de proposition:
                        $resultGroup = mysqli_query($co,"SELECT COUNT(*) AS NbredeProposition , G.idGroup, G.nameGroup,G.dateGroup,G.descGroup 
                                                         FROM JGROUP G, adminList AL 
                                                         WHERE G.idGroup = AL.idGroup
                                                         AND AL.idUser = ".$_SESSION['idUser']." 
                                                         GROUP BY G.idGroup 
                                                         ORDER BY COUNT(*) 
                                                         ");
                        if(mysqli_num_rows($resultGroup)<1){
                            echo "<p> Aucun groupe trouvé. </p>";
                        }else{
                            while($donnee = mysqli_fetch_array($resultGroup)){
                                echo '<div class="group" id='.$donnee['idGroup'].'>';
                                echo '    <p class="group-groupName">'.$donnee['nameGroup'].'</p>';
                                echo '    <p class="group-groupDate"> Créée le : '.$donnee['dateGroup'].'</p>';
                                // requete pour avoir le nombre de membres du groupe
                                $resultNbMembers = mysqli_query($co,"SELECT DISTINCT m.idUser
                                                                     FROM memberlist m 
                                                                     WHERE m.idGroup = ".$donnee['idGroup']." 
                                                                     AND idProposition IS NULL
                                                                     GROUP BY m.idUser");
                                echo '<p class="group-groupMember">'.mysqli_num_rows($resultNbMembers).' membre(s)</p>';
                                echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';
                                echo '    <p class="group-groupDesc">'.$donnee['descGroup'].'</p>';
                                echo '</div>';
                                //echo '<li>'.$donnee['idGroup']." - ";
                            }
                        }


                    ?>

                
            </div>
            <div class="col-sm-6"> 
                <h3 class="group-titleh3">Vos groupes membres</h3>
                <hr class="group-hr"/>
                <?php
                        //On ouvre une connexion
                        $bd = new Bd();
                        $co = $bd->ouvrirConnexion();
                        // requete pour avoir les  5 groupes avec le plus de proposition:
                        $resultGroup = mysqli_query($co,"SELECT COUNT(*) AS NbredeProposition , G.idGroup, G.nameGroup,G.dateGroup,G.descGroup 
                                                         FROM JGROUP G, memberlist MB 
                                                         WHERE G.idGroup = MB.idGroup
                                                         AND MB.idUser = ".$_SESSION['idUser']." 
                                                         AND idProposition IS NULL
                                                         GROUP BY G.idGroup 
                                                         ORDER BY COUNT(*)
                                                         ");
                        if(mysqli_num_rows($resultGroup)<1){
                            echo "<p> Aucun groupe trouvé. </p>";
                        }else{
                            while($donnee = mysqli_fetch_array($resultGroup)){
                                echo '<div class="group" id='.$donnee['idGroup'].'>';
                                echo '    <p class="group-groupName">'.$donnee['nameGroup'].'</p>';
                                echo '    <p class="group-groupDate"> Créée le : '.$donnee['dateGroup'].'</p>';
                                // requete pour avoir le nombre de membres du groupe
                                $resultNbMembers = mysqli_query($co,"SELECT DISTINCT m.idUser
                                                                     FROM memberlist m 
                                                                     WHERE m.idGroup = ".$donnee['idGroup']." 
                                                                     GROUP BY m.idUser");
                                echo '<p class="group-groupMember">'.mysqli_num_rows($resultNbMembers).' membre(s)</p>';
                                echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';
                                echo '    <p class="group-groupDesc">'.$donnee['descGroup'].'</p>';
                                echo '</div>';
                                //echo '<li>'.$donnee['idGroup']." - ";
                            }
                        }


                    ?>
            </div>
        </div>
</div>
<?php
    include('./footer.php');
?>

</body>
</html>

<style>

    body{background-color: #DCDCDC; }
    .container-fluid{
    min-height: 600px;
    height: auto;
    }


    @media screen and (max-width: 1280px)
    {
        h2
        {
            font-size: 100px;
        }

    }
</style>

<script>

    // Redirection vers une page de descritpion pour un groupe selectionné
    Array.from(document.getElementsByClassName("group")).forEach(function(group) {
        group.onclick = function(){          
            document.location.href="./vueGroupe.php?id="+group.id;
        }
    });
</script>