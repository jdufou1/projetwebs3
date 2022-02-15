#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 28/11/2019
#------------------------------------------------------------

#-SCRIPT DINSERTION DE FAUSSES VALEURS-------------------
#-Category


# Groupe 1 à 5 catégories : 1,2,3,4,5

INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(1,"testNameCategory-1",1);
INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(2,"testNameCategory-2",1);
INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(3,"testNameCategory-3",1);
INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(4,"testNameCategory-4",1);
INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(5,"testNameCategory-5",1);

# Groupe 2 à 3 catégories : 6,7,8

INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(6,"testNameCategory-6",2);
INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(7,"testNameCategory-7",2);
INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(8,"testNameCategory-8",2);

# Groupe 3 à 2 catégories : 9,10

INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(9,"testNameCategory-9",3);
INSERT INTO Category(idCategory,nameCategory,idGroup)VALUES(10,"testNameCategory-10",3);