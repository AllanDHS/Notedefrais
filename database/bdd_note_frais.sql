#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: type_de_frais
#------------------------------------------------------------

CREATE TABLE type_de_frais(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL ,
        TVA  Float NOT NULL
	,CONSTRAINT type_de_frais_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: EMPLOYE
#------------------------------------------------------------

CREATE TABLE EMPLOYE(
        id           Int  Auto_increment  NOT NULL ,
        lastname     Varchar (50) NOT NULL ,
        firstname    Varchar (50) NOT NULL ,
        email_adress Varchar (50) NOT NULL ,
        phone_number Varchar (10) NOT NULL ,
        password     Varchar (255) NOT NULL
	,CONSTRAINT EMPLOYE_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: status_note
#------------------------------------------------------------

CREATE TABLE status_note(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (50) NOT NULL
	,CONSTRAINT status_note_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: renseignement_frais
#------------------------------------------------------------

CREATE TABLE renseignement_frais(
        id                  Int  Auto_increment  NOT NULL ,
        payment_date        Date NOT NULL ,
        payment_amount      DECIMAL (15,3)  NOT NULL ,
        reason_payment      Varchar (50) NOT NULL ,
        document            Varchar (50) NOT NULL ,
        validate_date       Date ,
        cancellation_reason Varchar (50) ,
        id_type_de_frais    Int NOT NULL ,
        id_EMPLOYE          Int NOT NULL ,
        id_status_note      Int NOT NULL
	,CONSTRAINT renseignement_frais_PK PRIMARY KEY (id)

	,CONSTRAINT renseignement_frais_type_de_frais_FK FOREIGN KEY (id_type_de_frais) REFERENCES type_de_frais(id)
	,CONSTRAINT renseignement_frais_EMPLOYE0_FK FOREIGN KEY (id_EMPLOYE) REFERENCES EMPLOYE(id)
	,CONSTRAINT renseignement_frais_status_note1_FK FOREIGN KEY (id_status_note) REFERENCES status_note(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RH
#------------------------------------------------------------

CREATE TABLE RH(
        id           Int  Auto_increment  NOT NULL ,
        mail_adresse Varchar (50) NOT NULL ,
        name         Varchar (50) NOT NULL ,
        password     Varchar (50) NOT NULL
	,CONSTRAINT RH_PK PRIMARY KEY (id)
)ENGINE=InnoDB;

