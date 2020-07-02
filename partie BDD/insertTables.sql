--
-- Contenu de la table agents
--

INSERT INTO agents VALUES(1, 'Mr', 'le Grand', 'Wissembourg', 651668);
INSERT INTO agents VALUES(2, 'Serradj', 'Elhadi', 'Haguenau', 4464);
INSERT INTO agents VALUES(3, 'kratos', 'Aron', 'strasbourg', 1565106);
INSERT INTO agents VALUES(4, 'samo', 'Asura', 'Mulhouse', 1654);
INSERT INTO agents VALUES(5, 'Tina', 'Camus', 'Colmar', 6665);
INSERT INTO agents VALUES(6, 'mila', 'melina', 'kleber', 16515);

--
-- Contenu de la table absence
--

INSERT INTO absence VALUES(100,1);
INSERT INTO absence VALUES(101,2);
INSERT INTO absence VALUES(102,3);
INSERT INTO absence VALUES(103,4);
INSERT INTO absence VALUES(104,7);

--
-- Contenu de la table affect
--

INSERT INTO effect VALUES(1,100);
INSERT INTO effect VALUES(2,101);
INSERT INTO effect VALUES(3,104);
INSERT INTO effect VALUES(4,102);
INSERT INTO effect VALUES(5,102);
INSERT INTO effect VALUES(6,104);

--
-- Contenu de la table statistique
--

INSERT INTO statistique VALUES(001, 10, 'ODO', 1, 1, 2); 
INSERT INTO statistique VALUES(002, 22, 'SLOW', 2, 1, 1); 
INSERT INTO statistique VALUES(003, 8, 'PS', 1, 2, 2); 
INSERT INTO statistique VALUES(004, 30, 'SB', 1, 0, 0); 
--~ INSERT INTO statistique VALUES(05, 8, 'ODO', 1, 0, 1); 
--~ INSERT INTO statistique VALUES(06, 28, 'ODO', 1, 2, 0); 
--~ INSERT INTO statistique VALUES(07, 20, 'ODO', 1, 0, 1); 

--
-- Contenu de la table planning
--

INSERT INTO planning VALUES(1, 001);
INSERT INTO planning VALUES(2, 003);
INSERT INTO planning VALUES(3, 002);
INSERT INTO planning VALUES(4, 001);
INSERT INTO planning VALUES(5, 004);
INSERT INTO planning VALUES(6, 004);

--
-- Contenu de la table equipement
--

INSERT INTO equipement VALUES(1, 'Ordinateur et TélephoneN1');
INSERT INTO equipement VALUES(3, 'Télephone');

--
-- Contenu de la table periode
--

INSERT INTO periode  VALUES(1,'08:00:00','20:00:00', 'Jour');
INSERT INTO periode  VALUES(2,'20:00:00', '08:00:00', 'Nuit');
INSERT INTO periode  VALUES(3, '00:00:00', '23:00:00', 'H24');


--
-- Contenu de la table astreinte
--

INSERT INTO astreinte VALUES(1, 'ODO', 'Vert', 1);
INSERT INTO astreinte VALUES(2, 'ODO', 'Rouge', 2);
INSERT INTO astreinte VALUES(3, 'PS', 'Vert', 1);
INSERT INTO astreinte VALUES(4, 'PS', 'Rouge', 2);
INSERT INTO astreinte VALUES(5, 'SB', 'Vert', 1);
INSERT INTO astreinte VALUES(6, 'SB', 'Rouge', 2);
INSERT INTO astreinte VALUES(7, 'SLOW', 'Jaune', 3);


--
-- Contenu de la table equipe
--

INSERT INTO equipe  VALUES(1, 1, 1,1, TO_DATE ('2017-03-01','YYYY/MM/DD'), 1);
INSERT INTO equipe  VALUES(2, 3, 2,1, TO_DATE ('2017-03-01','YYYY/MM/DD'), 1);
INSERT INTO equipe  VALUES(3, 3, 3,1, TO_DATE ('2017-03-05','YYYY/MM/DD'), 2);
INSERT INTO equipe  VALUES(4, 3, 3,2, TO_DATE ('2017-03-05','YYYY/MM/DD'), 2);
INSERT INTO equipe  VALUES(5, 3, 3,3, TO_DATE ('2017-03-05','YYYY/MM/DD'), 2);
INSERT INTO equipe  VALUES(6, 3, 4,2, TO_DATE ('2017-03-05','YYYY/MM/DD'), 3);
INSERT INTO equipe  VALUES(1, 3, 4,2, TO_DATE ('2017-03-05','YYYY/MM/DD'), 3);
INSERT INTO equipe  VALUES(2, 3, 4,3, TO_DATE ('2017-03-05','YYYY/MM/DD'), 3);
INSERT INTO equipe  VALUES(3, 3, 7,3, TO_DATE ('2017-03-10','YYYY/MM/DD'), 4);
INSERT INTO equipe  VALUES(4, 3, 7,1, TO_DATE ('2017-03-10','YYYY/MM/DD'), 4);
INSERT INTO equipe  VALUES(5, 3, 7,1, TO_DATE ('2017-03-10','YYYY/MM/DD'), 4);
INSERT INTO equipe  VALUES(5, 3, 5,3, TO_DATE ('2017-03-19','YYYY/MM/DD'), 5);
INSERT INTO equipe  VALUES(6, 3, 5,3, TO_DATE ('2017-03-19','YYYY/MM/DD'), 5);
INSERT INTO equipe  VALUES(1, 3, 5,3, TO_DATE ('2017-03-19','YYYY/MM/DD'), 5);
INSERT INTO equipe  VALUES(2, 3, 6,2, TO_DATE ('2017-06-21','YYYY/MM/DD'), 6);
INSERT INTO equipe  VALUES(2, 3, 6,2, TO_DATE ('2017-04-22','YYYY/MM/DD'), 6);
INSERT INTO equipe  VALUES(3, 3, 6,1, TO_DATE ('2017-05-22','YYYY/MM/DD'), 6);



