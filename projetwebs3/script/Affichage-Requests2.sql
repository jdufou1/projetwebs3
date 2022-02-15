FAIRE LES REQUETES SUIVANTES SQL :

REQUETES SUR LES GROUPES

GET

- Pouvoir afficher la liste de toutes les propositions d'un groupe A (idGroupe = 1)

SELECT u.profilPic,u.nameUser,u.firstNameUser,u.loginUser,g.nameGroup,p.dateProposition,p.shortDescProposition
FROM memberlist m, jgroup g, proposition p, juser u
WHERE m.idProposition = p.idProposition
AND m.idGroup = g.idGroup
AND u.idUser = m.idUser
AND g.nameGroup = "testNameGroup-1";




- Pouvoir afficher la liste des membres d'un groupe A (id = A)

SELECT m.idGroup, j.profilPic, j.nameUser, j.firstNameUser, j.loginUser
FROM memberlist m, juser j, jgroup g
WHERE m.idUser = j.idUser
AND m.idGroup = g.idGroup
AND g.nameGroup = "testNameGroup-1";




- Pouvoir afficher la liste des admins d'un groupe A (id = A)


SELECT a.idGroup, j.profilPic, j.nameUser, j.firstNameUser, j.loginUser
FROM adminlist a, juser j, jgroup g
WHERE a.idUser = j.idUser
AND a.idGroup = g.idGroup
AND g.nameGroup = "testNameGroup-1";


- Pouvoir afficher les propositions les plus populaires d'un groupe A (id = A)



- Pouvoir afficher les différentes catégories d'un groupe A (id = A)




 REQUETES SUR LES PROPOSITIONS

GET

- Pouvoir afficher les commentaires d'une proposition
- Pouvoir afficher les votes d'une proposition
- 