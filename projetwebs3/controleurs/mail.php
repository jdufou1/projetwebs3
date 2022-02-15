<?php


function invitationGroupMail($by,$email,$groupName,$desc,$idGroup){    
    // Le message
    $message = "<body>
                    <p> Bonjour ".$by." vient de créer son groupe </p>
                    <p> ".$by." vous invite à le rejoindre dans le groupe <b>".$groupName."</b></p>
                    <p class='desc'>.$desc.</p>
                    <a href='http://projetwebs3.alwaysdata.net/vues/rejoindre.php?id=".$idGroup."'>cliquez ici</a>
                </body>";


    // Style du message
    $message.= 
    "<style>
        body{
            font-family: 'Arial';
            text-align: center;
        }
        .desc{
            font-style: italic;
        }

    </style>";

    

    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';

    // Envoi du mail
    mail($email, 'Groups4Votes : Invitation à un groupe', $message,implode("\r\n", $headers));
}

function newMemberMail($by,$email,$groupName,$desc,$idGroup){
    // Le message
    $message = "<body>
                    <p> Bonjour, $by vous invite à rejoindre son groupe </p>
                    <p> $by vous invite à le rejoindre dans le groupe <b>".$groupName."</b></p>
                    <p class='desc'>$desc</p>
                    <a href='http://projetwebs3.alwaysdata.net/vues/rejoindre.php?id=$idGroup'>cliquez ici pour rejoindre</a>
                </body>";


    // Style du message
    $message.= 
    "<style>
        body{
            font-family: 'Arial';
            text-align: center;
        }
        .desc{
            font-style: italic;
        }

    </style>";

    

    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';

    // Envoi du mail
    mail($email, 'Groups4Votes : Invitation à un groupe', $message,implode("\r\n", $headers));
}


function mailValidation($idUser,$name,$firstName,$email){


    // Le message
    $message = "<body>
    <p> Bonjour $name $firstName, </p>
    <p> Bienvenue sur Groups4Vote </p>
    <p> Pour valider votre compte, veuillez cliquez sur le lien ci-dessous</p>
    <p class='desc'>$desc</p>
    <a href='http://projetwebs3.alwaysdata.net/controleurs/control_validation.php?idUser=$idUser'>Confirmer mon compte</a>
    </body>";


    // Style du message
    $message.= 
    "<style>
    body{
    font-family: 'Arial';
    }
    .desc{
    font-style: italic;
    }

    </style>";



    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';

    // Envoi du mail
    mail($email, 'Groups4Votes : Validation du compte', $message,implode("\r\n", $headers));


}


?>