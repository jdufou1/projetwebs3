<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Accueil</title>
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
            <div class="col-sm-4 groupList">
                
                    <h3 class="group-titleh3">Les meilleurs groupes</h3>
                    <hr class="group-hr"/>
                    <?php
                        //On ouvre une connexion
                        $bd = new Bd();
                        $co = $bd->ouvrirConnexion();
                        // requete pour avoir les  5 groupes avec le plus de proposition:
                        $resultGroup = mysqli_query($co,"SELECT COUNT(*) AS NbredeProposition , G.idGroup, G.nameGroup,G.dateGroup,G.descGroup 
                                                         FROM JGROUP G, memberlist MB 
                                                         WHERE G.idGroup = MB.idGroup 
                                                         GROUP BY G.idGroup 
                                                         ORDER BY COUNT(*) 
                                                         DESC LIMIT 5");
                        if(mysqli_num_rows($resultGroup)<1){
                            echo "<p> Aucun groupe trouvé </p>";
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
                                echo '<p class="group-groupMember"><b>'.mysqli_num_rows($resultNbMembers).'</b> membres</p>';
                                echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';
                                echo '    <p class="group-groupDesc">'.$donnee['descGroup'].'</p>';
                                echo '</div>';
                                //echo '<li>'.$donnee['idGroup']." - ";
                            }
                        }


                    ?>
                
            </div>
            <div class="col-sm-8">
                <h3 class="group-titleh3">Actualités et informations</h3>
                <hr class="group-hr"/>
                <!-- Mettre ici les nouveautés du site (fonctionnalité etc...) -->
                <p><b>Pas encore fonctionnel : </b> le menu Message, la barre de recherche et la page d'aide.</p>
                <p>A la création de votre compte un mail de vérification vous sera envoyé.</p>
                <p>Sur ce site, vous pourrez créer, rejoindre, inviter une personne à un groupe.</p>
                <p>Au sein d'un groupe, vous pourrez publier, aimer, signaler une proposition.</p>
                <p>Au sein d'un groupe, si vous êtes <b>administrateur</b>, vous pourrez inviter, exclure, supprimer une proposition ou un commentaire.</p>
                <p>Vous pouvez modifier vos informations en cliquant sur votre nom en haut à droite.</p>
                <p>Une proposition peut être considérée comme un vote, alors une date limite de visibilité lui sera fixé.</p>
                <p>Site développé avec : <b>PHP</b>,<b>HTML</b>,<b>CSS</b>,<b>JavaScript</b>,<b>bootstrap</b>.</p>
                <p>Base de données : <b>MySQL</b>,<b>PhpMyAdmin</b></p>
            </div>
        </div>
    </div>


</body>

<!-- inclure le footer -->

<?php include('./footer.php'); ?>
</html>

<style>

    h2{color: #696969;}
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



