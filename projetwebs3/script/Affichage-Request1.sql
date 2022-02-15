#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 28/11/2019
#------------------------------------------------------------

#-SCRIPT DAFFICHAGE DE FAUSSES VALEURS----------------------

# Retourne les mots de passe de tous les membres du groupe nommé "testNameGroup-1"

SELECT DISTINCT pwdUser
FROM JUSER U,memberList MB, JGROUP G
WHERE U.idUser = MB.idUser
AND MB.idGroup = G.idGroup
AND nameGroup = "testNameGroup-1";


# Requete sur les likes

# Retourne le nombre de likes sur la proposition 1

SELECT COUNT(*) AS NombredeLike, L.idProposition
FROM JLIKE L
WHERE L.IdProposition = 1
AND L.voteValue = 1;

# Retourne le nombre de likes pour chaque proposition

SELECT COUNT(*), P.IdProposition
FROM PROPOSITION P, JLIKE L
WHERE L.IdProposition = P.IdProposition
AND L.voteValue = 1
GROUP BY IdProposition;

# Retourne la proposition la plus aimé dans le groupe 1

SELECT COUNT(*) AS NbredeLike , P.idProposition
FROM PROPOSITION P, JLIKE L, MEMBERLIST MB, JGROUP G
WHERE MB.idGroup = G.idGroup
AND MB.IdProposition = P.idProposition
AND L.IdProposition = P.IdProposition
AND voteValue = 1
AND G.IdGroup = 1
GROUP BY L.idproposition
ORDER BY COUNT(*) DESC 
LIMIT 1;

# Retourne les 3 propositions les moins aimées dans le groupe 2

SELECT COUNT(*) AS NbredeDislike , P.idProposition
FROM PROPOSITION P, JLIKE L, MEMBERLIST MB, JGROUP G
WHERE MB.idGroup = G.idGroup
AND MB.IdProposition = P.idProposition
AND L.IdProposition = P.IdProposition
AND voteValue = 0
AND G.IdGroup = 2
GROUP BY L.idproposition
ORDER BY COUNT(*) DESC 
LIMIT 3;


# Retourne tous les commentaires de la proposition 1 :

SELECT textComment,photoComment,dateComment
FROM JCOMMENT C,COMMENTARY CY
WHERE C.idComment = CY.idComment
AND CY.idProposition = 1;

# Retourne tous les commentaires du groupe 1 :

SELECT DISTINCT textComment,photoComment,dateComment
FROM JCOMMENT C,COMMENTARY CY,MEMBERLIST MB, PROPOSITION P
WHERE CY.idProposition = P.idProposition
AND MB.idProposition = P.idProposition
AND C.idComment = CY.idComment
AND MB.idGroup = 1;

# Retourne le nombre de commentaires du groupe 1 :

SELECT COUNT(*) AS NombreDeCommentaires
FROM JCOMMENT C,COMMENTARY CY,MEMBERLIST MB, PROPOSITION P
WHERE CY.idProposition = P.idProposition
AND MB.idProposition = P.idProposition
AND C.idComment = CY.idComment
AND MB.idGroup = 1;

# Retourne le nombre d utilisateur sur le Site

SELECT COUNT(*) NbUtilisateurs
FROM JUSER

# Retourne le nombre d utilisateurs inscrits aujourdhui

SELECT COUNT(*) NbUtilisateurs
FROM JUSER
WHERE inscriptionDate = DATE_FORMAT(NOW(),"%Y-%m-%d");

