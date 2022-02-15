#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 28/11/2019
#------------------------------------------------------------

#-SCRIPT DINSERTION DE FAUSSES VALEURS-------------------
#-LIKES

# 0 : proposition non aimé / 1 : proposition aimé

# Individu 1 à aimé 5 propositions : 1,2,3,4,5

INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(1,1,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(1,2,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(1,3,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(1,4,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(1,5,1);

# Individu 2 n a pas aimé 5 propositions : 6,7,8,9,10

INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(2,6,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(2,7,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(2,8,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(2,9,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(2,10,0);

# Individu 3 à aimé 5 propositions : 1,2,3,4,5 et n a pas aimé 5 propositions : 6,7,8,9,10

INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,1,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,2,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,3,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,4,1);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,5,1);

INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,6,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,7,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,8,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,9,0);
INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(3,10,0);

# Individu 4 à aimé 1 propositions : 1

INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(4,1,1);

# Individu 5 n a pas aimé 1 propositions : 10

INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(5,10,0);

# Individu 6 a aimé 1 propositions : 1

INSERT INTO JLIKE(idUser,idProposition,voteValue)VALUES(6,1,1);