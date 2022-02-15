#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 01/12/2019
#------------------------------------------------------------

#-SCRIPT DINSERTION DE FAUSSES VALEURS-------------------
#-REPORTPROPOSITION

# Utilisateur 1 signale 1 proposition :

INSERT INTO REPORTPROPOSITION(idUser,idProposition,messageReport,typeReport)VALUES(1,6,"test-messageReport","offensant");

# Utilisateur 2 signale 4 proposition : 

INSERT INTO REPORTPROPOSITION(idUser,idProposition,messageReport,typeReport)VALUES(2,1,"test-messageReport","offensant");
INSERT INTO REPORTPROPOSITION(idUser,idProposition,messageReport,typeReport)VALUES(2,2,"test-messageReport","offensant");
INSERT INTO REPORTPROPOSITION(idUser,idProposition,messageReport,typeReport)VALUES(2,3,"test-messageReport","offensant");
INSERT INTO REPORTPROPOSITION(idUser,idProposition,messageReport,typeReport)VALUES(2,4,"test-messageReport","offensant");