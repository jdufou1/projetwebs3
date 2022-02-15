#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 29/11/2019
#------------------------------------------------------------

#-SCRIPT DINSERTION DE FAUSSES VALEURS-------------------
#-COMMENTARY

# Utilisateur 1 (Groupe 1) commente 5 propositions : 1,2,3,4,5 

INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(1,1,1);
INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(1,2,2);
INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(1,3,3);
INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(1,4,4);
INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(1,5,5);

# Utilisateur 2 (Groupe 1) commente 2 fois la proposition 2 : 6,7

INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(2,2,6);
INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(2,2,7);

# Utilisateur 3 (Groupe 1) commente 3 fois la proposition 1 : 8,9,10

INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(3,1,8);
INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(3,1,9);
INSERT INTO COMMENTARY(idUser,idProposition,idComment)VALUES(3,1,10);
