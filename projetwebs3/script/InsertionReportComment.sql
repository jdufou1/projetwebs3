#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 01/12/2019
#------------------------------------------------------------

#-SCRIPT DINSERTION DE FAUSSES VALEURS-------------------
#-REPORTCOMMENT


# Utilisateur 1 a signalé 2 commentaires

INSERT INTO REPORTCOMMENT(idUser,idComment,messageReport,typeReport) VALUES (1,6,"test-messageReport","offensant");
INSERT INTO REPORTCOMMENT(idUser,idComment,messageReport,typeReport) VALUES (1,7,"test-messageReport","sexuel");

# Utilisateur 2 a signalé 3 commentaires

INSERT INTO REPORTCOMMENT(idUser,idComment,messageReport,typeReport) VALUES (2,1,"test-messageReport","violent");
INSERT INTO REPORTCOMMENT(idUser,idComment,messageReport) VALUES (2,2,"test-messageReport");
INSERT INTO REPORTCOMMENT(idUser,idComment,messageReport,typeReport) VALUES (2,3,"test-messageReport","violent");

# Utilisateur 3 a signalé 1 commentaires

INSERT INTO REPORTCOMMENT(idUser,idComment,messageReport,typeReport) VALUES (3,1,"test-messageReport","antisémite");

