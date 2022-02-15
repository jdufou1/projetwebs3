#------------------------------------------------------------
#        Script MySQL - Copyright DUFOURMANTELLE Jérémy
#                                 BODIN Stefan 
# 28/11/2019
#------------------------------------------------------------

#------------------------------------------------------------
# Table: JCOMMENT
#------------------------------------------------------------

CREATE TABLE JCOMMENT(
        idComment    Int  Auto_increment  NOT NULL ,
        textComment  Varchar (60) NOT NULL ,
        photoComment Varchar (400) NOT NULL ,
        dateComment  Date NOT NULL,
        report INT,
	
        CONSTRAINT COMMENT_PK PRIMARY KEY (idComment)
);

#------------------------------------------------------------
# Table: PROPOSITION
#------------------------------------------------------------

CREATE TABLE PROPOSITION(
        idProposition        Int  Auto_increment  NOT NULL ,
        shortDescProposition Varchar (20) NOT NULL ,
        longDescProposition  Varchar (60) NOT NULL ,
        dateProposition      Date NOT NULL ,
        photoProposition     Varchar (400) NOT NULL ,
        vote                 Int NOT NULL ,
        deadLine Date,

        CONSTRAINT PROPOSITION_PK PRIMARY KEY (idProposition)
);

#------------------------------------------------------------
# Table: JUSER
#------------------------------------------------------------

CREATE TABLE JUSER(
        idUser          Int  Auto_increment  NOT NULL ,
        nameUser        Varchar (20) NOT NULL ,
        firstNameUser   Varchar (20) NOT NULL ,
        loginUser       Varchar (20) NOT NULL ,
        pwdUser         Varchar (20) NOT NULL ,
        inscriptionDate Date NOT NULL ,
        mailUser        Varchar (30) NOT NULL ,
        validationEmail Int NOT NULL ,
        profilPic       Varchar (500) NOT NULL,

        CONSTRAINT USER_PK PRIMARY KEY (idUser)
);

#------------------------------------------------------------
# Table: JGROUP
#------------------------------------------------------------

CREATE TABLE JGROUP(
        idGroup   Int  Auto_increment  NOT NULL ,
        descGroup Varchar (60) NOT NULL ,
        nameGroup Varchar (20) NOT NULL ,
        dateGroup Date NOT NULL ,

	CONSTRAINT GROUP_PK PRIMARY KEY (idGroup)
);



#------------------------------------------------------------
# Table: CATEGORY
#------------------------------------------------------------

CREATE TABLE CATEGORY(
        idCategory   Int  Auto_increment  NOT NULL ,
        nameCategory Varchar (40) NOT NULL ,
        idGroup      Int NOT NULL,
	
        CONSTRAINT CATEGORY_PK PRIMARY KEY (idCategory),
	CONSTRAINT CATEGORY_GROUP_FK FOREIGN KEY (idGroup) REFERENCES JGROUP(idGroup)
);

#------------------------------------------------------------
# Table: commentary
#------------------------------------------------------------

CREATE TABLE commentary(
        idUser        Int NOT NULL ,
        idProposition Int NOT NULL ,
        idComment     Int NOT NULL,
	
        CONSTRAINT commentary_PK PRIMARY KEY (idUser,idProposition,idComment),
	CONSTRAINT commentary_USER_FK FOREIGN KEY (idUser) REFERENCES JUSER(idUser),
	CONSTRAINT commentary_PROPOSITION0_FK FOREIGN KEY (idProposition) REFERENCES PROPOSITION(idProposition),
	CONSTRAINT commentary_COMMENT1_FK FOREIGN KEY (idComment) REFERENCES JCOMMENT(idComment)
);


#------------------------------------------------------------
# Table: Jshare
#------------------------------------------------------------

CREATE TABLE Jshare(
        idProposition Int NOT NULL ,
        idGroup       Int NOT NULL ,
        idUser        Int NOT NULL,
        dateShare Date NOT NULL,
	
        CONSTRAINT share_PK PRIMARY KEY (idProposition,idGroup),
	CONSTRAINT share_PROPOSITION_FK FOREIGN KEY (idProposition) REFERENCES PROPOSITION(idProposition),
	CONSTRAINT share_GROUP0_FK FOREIGN KEY (idGroup) REFERENCES JGROUP(idGroup)
);

#------------------------------------------------------------
# Table: categoryList
#------------------------------------------------------------

CREATE TABLE categoryList(
        idCategory    Int NOT NULL ,
        idProposition Int NOT NULL ,
        categoryLevel Varchar (400) NOT NULL,
	
        CONSTRAINT categoryList_PK PRIMARY KEY (idCategory,idProposition),
	CONSTRAINT categoryList_CATEGORY_FK FOREIGN KEY (idCategory) REFERENCES CATEGORY(idCategory),
	CONSTRAINT categoryList_PROPOSITION0_FK FOREIGN KEY (idProposition) REFERENCES PROPOSITION(idProposition)
);


#------------------------------------------------------------
# Table: memberList
#------------------------------------------------------------

CREATE TABLE memberList(
        idUser        Int NOT NULL ,
        idGroup       Int NOT NULL ,
        idProposition Int,
	
	CONSTRAINT memberList_USER_FK FOREIGN KEY (idUser) REFERENCES JUSER(idUser),
	CONSTRAINT memberList_GROUP0_FK FOREIGN KEY (idGroup) REFERENCES JGROUP(idGroup)
);


CREATE TABLE adminList(

        idUser        Int NOT NULL ,
        idGroup       Int NOT NULL ,

        CONSTRAINT adminList_USER_FK FOREIGN KEY (idUser) REFERENCES JUSER(idUser),
        CONSTRAINT adminList_GROUP0_FK FOREIGN KEY (idGroup) REFERENCES JGROUP(idGroup)
);

CREATE TABLE JLIKE(

        idUser        Int NOT NULL ,
        idProposition Int NOT NULL ,
        voteValue INT NOT NULL,

        CONSTRAINT JLIKE_USER_FK FOREIGN KEY (idUser) REFERENCES JUSER(idUser),
        CONSTRAINT JLIKE_PROPOSITION0_FK FOREIGN KEY (idProposition) REFERENCES PROPOSITION(idProposition)
);


CREATE TABLE REPORTPROPOSITION(
        idUser        Int NOT NULL ,
        idProposition Int NOT NULL ,

        CONSTRAINT REPORTPROPOSITION_USER_FK FOREIGN KEY (idUser) REFERENCES JUSER(idUser),
        CONSTRAINT REPORTPROPOSITION_PROPOSITION0_FK FOREIGN KEY (idProposition) REFERENCES PROPOSITION(idProposition)
);


CREATE TABLE REPORTCOMMENT(
        idUser        Int NOT NULL ,
        idComment     Int NOT NULL ,

        CONSTRAINT REPORTCOMMENT_USER_FK FOREIGN KEY (idUser) REFERENCES JUSER(idUser),
        CONSTRAINT REPORTCOMMENT_COMMENT1_FK FOREIGN KEY (idComment) REFERENCES JCOMMENT(idComment)
);
