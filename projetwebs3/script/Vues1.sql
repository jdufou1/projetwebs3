#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 01/12/2019
#------------------------------------------------------------

#-SCRIPT DE CREATION DES VUES--------------------------------

# 1 - Vue sur les propositions d un groupe

CREATE OR REPLACE VIEW V_PropositionGroup
AS SELECT u.profilPic,u.nameUser,u.firstNameUser,u.loginUser,g.nameGroup,p.idProposition,p.dateProposition,p.shortDescProposition,g.idGroup
FROM memberlist m, jgroup g, proposition p, juser u
WHERE m.idProposition = p.idProposition
AND m.idGroup = g.idGroup
AND u.idUser = m.idUser;


# 2 - Vue sur les membres d un groupe

CREATE OR REPLACE VIEW V_MemberGroup
AS SELECT m.idGroup,j.idUser, j.profilPic, j.nameUser, j.firstNameUser, j.loginUser
FROM memberlist m, juser j, jgroup g
WHERE m.idUser = j.idUser
AND m.idGroup = g.idGroup;

# 3 - Vue sur les admins dun groupe

CREATE OR REPLACE VIEW V_AdminGroup
AS SELECT a.idGroup, j.idUser, j.profilPic, j.nameUser, j.firstNameUser, j.loginUser
FROM adminlist a, juser j, jgroup g
WHERE a.idUser = j.idUser
AND a.idGroup = g.idGroup;

# 4 - Vue sur les commentaires de propositions

CREATE OR REPLACE VIEW V_CommentProposition
AS SELECT textComment,photoComment,dateComment , C.idComment, CY.idProposition
FROM JCOMMENT C,COMMENTARY CY
WHERE C.idComment = CY.idComment;



