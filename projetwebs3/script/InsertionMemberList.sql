#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 22/11/2019
#------------------------------------------------------------

#-SCRIPT DINSERTION DE FAUSSES VALEURS-------------------
#-MEMBERLIST

# Individu 1 du groupe 1 fait 5 propositions : 1,2,3,4,5

INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(1,1,1);
INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(1,1,2);
INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(1,1,3);
INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(1,1,4);
INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(1,1,5);

# Individu 2 du groupe 1 fait 1 proposition : 6

INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(2,1,6);


# Individu 3 du groupe 1 fait 0 proposition : 

INSERT INTO memberlist(idUser,idGroup)VALUES(3,1);


# Individu 4 du groupe 2 fait 4 proposition : 7,8,9,10

INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(4,2,7);
INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(4,2,8);
INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(4,2,9);
INSERT INTO memberlist(idUser,idGroup,idProposition)VALUES(4,2,10);