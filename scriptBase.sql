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
        adresse       Varchar (128) ,
        code_postal   Int ,
        mail          Varchar (128) NOT NULL ,
        numero_de_tel Int NOT NULL ,
        permis        Varchar (3) NOT NULL ,
        mdp           Varchar (268) NOT NULL ,
        imageProfile  Varchar (450)
	,CONSTRAINT motard_PK PRIMARY KEY (id_motard)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: entreprise
#------------------------------------------------------------

CREATE TABLE entreprise(
        SIRET              BigInt NOT NULL ,
        denomination       Varchar (128) NOT NULL ,
        adresse            Varchar (128) NOT NULL ,
        code_postal       Int NOT NULL ,
        numero_tel         Int ,
        date_d_affiliation Date NOT NULL ,
        mdp                Varchar (268) NOT NULL ,
        mail_entreprise    Varchar (268) NOT NULL ,
        image_gerant       Varchar (500) NOT NULL
	,CONSTRAINT entreprise_PK PRIMARY KEY (SIRET)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: circuit
#------------------------------------------------------------

CREATE TABLE circuit(
        id_circuit    Int  Auto_increment  NOT NULL ,
        adresse       Varchar (128) NOT NULL ,
        code_postal  Int NOT NULL ,
        longueur      Int ,
        nom           Varchar (128) NOT NULL ,
        image_circuit Varchar (500) NOT NULL ,
        SIRET         BigInt NOT NULL
	,CONSTRAINT circuit_PK PRIMARY KEY (id_circuit)

	,CONSTRAINT circuit_entreprise_FK FOREIGN KEY (SIRET) REFERENCES entreprise(SIRET)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: session
#------------------------------------------------------------

CREATE TABLE session(
        id_session     Int  Auto_increment  NOT NULL ,
        date           Date NOT NULL ,
        nb_place       Int NOT NULL ,
        tarif          Int NOT NULL ,
        status         Varchar (50) NOT NULL ,
        nb_participant Int NOT NULL ,
        heure_debut    Time NOT NULL ,
        heure_fin      Time NOT NULL ,
        image          Varchar (500) NOT NULL ,
        id_circuit     Int NOT NULL
	,CONSTRAINT session_PK PRIMARY KEY (id_session)

	,CONSTRAINT session_circuit_FK FOREIGN KEY (id_circuit) REFERENCES circuit(id_circuit)
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
# Table: modele moto
#------------------------------------------------------------

CREATE TABLE modele_moto(
        marque    Varchar (64) NOT NULL ,
        modele    Varchar (64) NOT NULL ,
        cylindree Int NOT NULL ,
        type      Varchar (64) NOT NULL ,
        puissance Int NOT NULL
	,CONSTRAINT modele_moto_PK PRIMARY KEY (marque,modele)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: moto
#------------------------------------------------------------

CREATE TABLE moto(
        immatriculation Varchar (10) NOT NULL ,
        annee           Date NOT NULL ,
        image_ma_moto   Varchar (500) NOT NULL ,
        id_motard       Int NOT NULL ,
        marque          Varchar (64) ,
        modele          Varchar (64)
	,CONSTRAINT moto_PK PRIMARY KEY (immatriculation)

	,CONSTRAINT moto_motard_FK FOREIGN KEY (id_motard) REFERENCES motard(id_motard)
	,CONSTRAINT moto_modele_moto0_FK FOREIGN KEY (marque,modele) REFERENCES modele_moto(marque,modele)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Reserver
#------------------------------------------------------------

CREATE TABLE Reserver(
        id_session Int NOT NULL ,
        id_motard  Int NOT NULL ,
        temps_tour Int NOT NULL
	,CONSTRAINT Reserver_PK PRIMARY KEY (id_session,id_motard)

	,CONSTRAINT Reserver_session_FK FOREIGN KEY (id_session) REFERENCES session(id_session)
	,CONSTRAINT Reserver_motard0_FK FOREIGN KEY (id_motard) REFERENCES motard(id_motard)
)ENGINE=InnoDB;

