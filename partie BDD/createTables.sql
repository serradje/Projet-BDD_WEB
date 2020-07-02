-- --------------------------------------------------------
--
-- Base de données :  gestion d'astreinte
--
-- --------------------------------------------------------


--
-- Structure de la table periode
--

CREATE TABLE periode 
(
  id_periode number(11) NOT NULL PRIMARY KEY,
  heure_debut varchar2(20) NOT NULL,
  heure_fin varchar2(20)NOT NULL,
  jnh varchar(22) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table agents
--

CREATE TABLE  agents
(
  id_Agent number(11) NOT NULL PRIMARY KEY,
  nom varchar2(128) NOT NULL,
  prenom varchar2(128) NOT NULL,
  adresse varchar2(128) NOT NULL,
  contact number(10) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table astreinte
--

CREATE TABLE  astreinte 
(
  id_astreinte number(11) NOT NULL PRIMARY KEY,
  type_astreinte varchar(128) NOT NULL,
  code_couleur varchar2(128) NOT NULL,
  id_periode number(11) NOT NULL,
  CONSTRAINT ck_astreinte CHECK (type_astreinte IN ('ODO','PS','SB','SLOW')),
  FOREIGN KEY (id_periode) references periode(id_periode)
);

-- --------------------------------------------------------

--
-- Structure de la table statistique
--

CREATE TABLE statistique
(
	id_stat number(10) NOT NULL,
	nb_jour number(2) NULL,
	type_astreinte varchar(128) NULL,
	NB_mois number(2) NULL,
	WE_travailler number(2) NULL,
	FERIE_travailler number(2) NULL,
	CONSTRAINT pk_statistique PRIMARY KEY (id_stat)
);


-- --------------------------------------------------------

--
-- Structure de la table equipement
--

CREATE TABLE  equipement 
(
  id_equipement number(11) NOT NULL,
  type varchar(128) NOT NULL,
  CONSTRAINT pk_equipement PRIMARY KEY (id_equipement)
);


-- --------------------------------------------------------


--
-- Structure de la table equipe
--

CREATE TABLE  equipe (
  id_Agent number(11) NOT NULL,
  id_equipement number(11) NOT NULL,
  id_astreinte number(11) NOT NULL,
  id_periode number(11) NOT NULL,
  date_t date NOT NULL,
  num_equipe number(11) NOT NULL,
   FOREIGN KEY (id_Agent) references agents(id_Agent),
   FOREIGN KEY (id_equipement) references equipement(id_equipement),
   FOREIGN KEY (id_astreinte) references astreinte(id_astreinte),  
   FOREIGN KEY (id_periode) references periode(id_periode)  
);


-- --------------------------------------------------------

--
-- Structure de la table absence
--

CREATE TABLE absence
(
	id_abs number NOT NULL,
	nbr_abs number NULL,
	CONSTRAINT pk_absence PRIMARY KEY (id_abs)
);

-- -----------------------------------------------------------

--
-- Structure de la table effect
--

CREATE TABLE effect
(
	id_Agent number NOT NULL,
	id_abs number NOT NULL,
	PRIMARY KEY (id_Agent,id_abs),
	FOREIGN KEY (id_Agent) references agents(id_Agent),  
    FOREIGN KEY (id_abs) references absence(id_abs) 
);

-- ------------------------------------------------------------

--
-- Structure de la table planning
--

CREATE TABLE planning 
(
	id_Agent number(10) NOT NULL,
	id_stat number(10) NOT NULL,
	CONSTRAINT pk_planning PRIMARY KEY (id_Agent),
	FOREIGN KEY (id_stat) references statistique(id_stat), 
	FOREIGN KEY (id_Agent) references agents(id_Agent)
);
	


