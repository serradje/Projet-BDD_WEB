set serveroutput on size 30000;
col nom format a20;
col prenom format a20; 
col adresse format a20;
col type_astreinte format a20;
set trimout on;

--Q1: liste	des	personnes en astreinte de nuit et de	jour pour le mois en cours et le mois à venir.

 select distinct nom from agents a, equipe e where to_char(date_t,'MM') in (to_char(ADD_MONTHS(sysdate,1),'MM'),to_char(sysdate,'MM')) and a.id_Agent=e.id_Agent;
 

-- Q2: la personne réalisant le plus d'astreinte et	celle en réalisant le moins.

select nom  as "Nom Prenom", prenom as "realisant le +/- d_astreinte", count(id_astreinte) as "nombre astreinte"
from equipe e, agents a 
where e.id_Agent=a.id_Agent group by nom,prenom
having count(*) = (select max(count(*))  from equipe group by id_Agent)
or count(*) = (select min(count(*))from equipe group by id_Agent);


--Q3: sélectionner pour une	période	donnée les personnes faisant partie	de la même équipe qu'une personne donnée.

select distinct nom,prenom from equipe e1, equipe e2, agents a, astreinte ast
where e1.id_periode=e2.id_periode and a.id_Agent=e1.id_Agent and ast.id_astreinte=e1.id_astreinte;
-- -- --
--Q4: compter le nombre	d'astreinte	différente	pour le	mois en	cours.

select count( distinct id_astreinte) as "NBR d_astreinte differente" from equipe where TO_CHAR(date_t, 'MM')= TO_CHAR(sysdate, 'MM');


--Q5:pour	 chaque	 personnel	 son	 identifiant,	 son	 nom,	 son	 prénom,	 son	 adresse,
-- le nombre moyen d'astreinte par mois, le nombre moyen de jour travaillé	par	mois, le	nombre	moyen d'absence	par	mois.

select distinct ag.id_Agent as "identifiant",  nom, prenom, adresse, AVG(ast.id_astreinte) as "moyenne d_astreinte",
	AVG(nb_jour) as "moyenne de jour travaillé", AVG( nbr_abs) as "moyenne jour d_absence"
	from agents ag, statistique s,planning p ,astreinte ast,absence ab, effect af, equipe e
	where s.id_stat=p.id_stat and p.id_Agent=ag.id_Agent and ab.id_abs=af.id_abs and ag.id_Agent=af.id_Agent
	group by ag.id_Agent,nom,prenom,adresse,nb_jour,nbr_abs,ast.id_astreinte, (TO_char(e.date_t,'MM'));



