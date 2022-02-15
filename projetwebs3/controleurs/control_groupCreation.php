<?php 

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

    // Récupération des infos

    $name = $_POST['groupName'];
    $desc = $_POST['groupDesc'];
    $category = $_POST['groupCategory'].=",";
    $emailMember = $_POST['emailMemberGroup'];

    $protectedName = str_replace("'", "\'", $name);


    // Traitements des infos
    // Scinde en fonction des virgules
    $categories = preg_split("/[,]+/",$category);
    $emails = preg_split("/[,]+/",$emailMember);

    $date = date("Y-m-d");
    //On ouvre une connexion
    echo $date;
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    // Insertion du groupe 

    $tmp = "INSERT INTO JGROUP(descGroup,nameGroup,dateGroup)VALUES("."'".$desc."'".","."'".$protectedName."'".","."'".$date."'".")";
    echo $tmp;
    $request1 = mysqli_query($co,$tmp);

    $requestId = mysqli_query($co,"SELECT idGroup
                                   FROM JGROUP
                                   WHERE descGroup = '$desc'
                                   AND nameGroup = '$protectedName'
                                   AND dateGroup = '$date'");
    while($donnee = mysqli_fetch_array($requestId)){ $idGroup = $donnee['idGroup'];}

    $request2 = mysqli_query($co,"INSERT INTO memberlist(idUser,idGroup)VALUES(".$_SESSION['idUser'].",".$idGroup.")");
    $request2bis = mysqli_query($co,"INSERT INTO adminList(idUser,idGroup)VALUES(".$_SESSION['idUser'].",".$idGroup.")");

    // Insertion des catégories

    foreach ($categories as $value) {
        if($value != "")
            $request3 = mysqli_query($co,"INSERT INTO CATEGORY(nameCategory,idGroup)VALUES('".$value."',".$idGroup.")");
    }
    // Envoi des invitations :
    
    $fullNameUser = $_SESSION['firstNameUser']." ".$_SESSION['nameUser'];
    foreach ($emails as $value) {
        if($value != "")
            invitationGroupMail($fullNameUser,$value,$name,$desc,$idGroup);
    }

    header("Location: ../vues/groupes.php");







?>