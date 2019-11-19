#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: motard
#------------------------------------------------------------

CREATE TABLE motard(
        id_motard     Int  Auto_increment  NOT NULL ,
        nom           Varchar (64) NOT NULL ,
        Prenom        Varchar (64) NOT NULL ,
        adresse       Varchar (128) NOT NULL ,
        code_postal   Int NOT NULL ,
        mail          Varchar (128) NOT NULL ,
        numero_de_tel Int NOT NULL ,
        permis        Varchar (3) NOT NULL ,
        mdpMotard     Varchar (128) NOT NULL
	,CONSTRAINT motard_PK PRIMARY KEY (id_motard)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: entreprise
#------------------------------------------------------------

CREATE TABLE entreprise(
        SIRET              Int NOT NULL ,
        denomination       Varchar (128) NOT NULL ,
        adresse            Varchar (128) NOT NULL ,
        code_postale       Int NOT NULL ,
        numero_tel         Int NOT NULL ,
        date_d_affiliation Date NOT NULL ,
        mdpEntreprise      Varchar (128) NOT NULL
	,CONSTRAINT entreprise_PK PRIMARY KEY (SIRET)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: circuit
#------------------------------------------------------------

CREATE TABLE circuit(
        id_circuit   Int  Auto_increment  NOT NULL ,
        adresse      Varchar (128) NOT NULL ,
        code_postale Int NOT NULL ,
        longueur     Int NOT NULL ,
        nom          Varchar (128) NOT NULL ,
        SIRET        Int NOT NULL
	,CONSTRAINT circuit_PK PRIMARY KEY (id_circuit)

	,CONSTRAINT circuit_entreprise_FK FOREIGN KEY (SIRET) REFERENCES entreprise(SIRET)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: session
#------------------------------------------------------------

CREATE TABLE session(
        id_session     Int  Auto_increment  NOT NULL ,
        date           Date NOT NULL ,
        duree          Int NOT NULL ,
        nb_place       Int NOT NULL ,
        tarif          Int NOT NULL ,
        status         Varchar (50) NOT NULL ,
        nb_participant Int NOT NULL ,
        SIRET          Int NOT NULL ,
        id_circuit     Int NOT NULL
	,CONSTRAINT session_PK PRIMARY KEY (id_session)

	,CONSTRAINT session_entreprise_FK FOREIGN KEY (SIRET) REFERENCES entreprise(SIRET)
	,CONSTRAINT session_circuit0_FK FOREIGN KEY (id_circuit) REFERENCES circuit(id_circuit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: moto
#------------------------------------------------------------

CREATE TABLE moto(
        immatriculation Varchar (10) NOT NULL ,
        marque          Varchar (50) NOT NULL ,
        modele          Varchar (50) NOT NULL ,
        cylindree       Int NOT NULL ,
        annee           Date NOT NULL ,
        type            Varchar (50) NOT NULL ,
        puissance       Int NOT NULL ,
        id_motard       Int NOT NULL
	,CONSTRAINT moto_PK PRIMARY KEY (immatriculation)

	,CONSTRAINT moto_motard_FK FOREIGN KEY (id_motard) REFERENCES motard(id_motard)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: avis
#------------------------------------------------------------

CREATE TABLE avis(
        id_avis     Int  Auto_increment  NOT NULL ,
        note        Int NOT NULL ,
        commentaire Varchar (256) NOT NULL ,
        id_circuit  Int NOT NULL ,
        id_motard   Int NOT NULL
	,CONSTRAINT avis_PK PRIMARY KEY (id_avis)

	,CONSTRAINT avis_circuit_FK FOREIGN KEY (id_circuit) REFERENCES circuit(id_circuit)
	,CONSTRAINT avis_motard0_FK FOREIGN KEY (id_motard) REFERENCES motard(id_motard)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Effectuer
#------------------------------------------------------------

CREATE TABLE Effectuer(
        id_session Int NOT NULL ,
        id_motard  Int NOT NULL
	,CONSTRAINT Effectuer_PK PRIMARY KEY (id_session,id_motard)

	,CONSTRAINT Effectuer_session_FK FOREIGN KEY (id_session) REFERENCES session(id_session)
	,CONSTRAINT Effectuer_motard0_FK FOREIGN KEY (id_motard) REFERENCES motard(id_motard)
)ENGINE=InnoDB;

