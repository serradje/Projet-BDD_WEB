set serveroutput on size 30000;
col nom format a20 
col prenom format a20 
col adresse format a20
col type_astreinte format a20
set linesize 210;
set trimout on;

--Q1: Définir un fonction permettant l'export au format csv d'un mois du planning donné en paramètre.

CREATE OR REPLACE PROCEDURE export_to_csv ( mois date)
IS

   CURSOR c_emp
   IS
      SELECT id_Agent,
             id_periode,
             id_astreinte,
             date_t
        FROM equipe where date_t=mois;
BEGIN
 

	DBMS_OUTPUT.PUT_LINE(
	' |  identifiant de l agent  |' || '  identifaint de la periode  |' ||  '  identifiant de l astreinte  |' || '  date de l astreinte du moois en cours  |' );

   FOR cur IN c_emp
   LOOP
   
   
	
     DBMS_OUTPUT.PUT_LINE(
         '           |               ' ||  cur.id_Agent ||
         '                           '  || cur.id_periode  ||
         '                           '   ||  cur.id_astreinte ||
         '                           '    ||  cur.date_t || '              	       |');
 
   END LOOP;

END;
/

show errors FUNCTION export_to_csv;
-- execute export_to_csv(TO_DATE ('2017-03-01','YYYY/MM/DD'));

-- Q2: Définir une procédure qui modifie une équipe si l'un de ses membres pose un congé pendant une période d'astreinte.

CREATE OR REPLACE PROCEDURE modif_equipe (id_emp number,date_c date)
IS
cursor e_cur is
                SELECT id_Agent FROM equipe
                WHERE id_Agent=id_emp ORDER BY id_Agent;
         
BEGIN   
      IF id_emp != 1 or id_emp != 2 or id_emp != 3 or id_emp != 4 or id_emp != 4 or id_emp != 6 THEN
                RAISE_APPLICATION_ERROR(-20000,'Numero d''agent incorrecte') ;
        END IF;
        
        FOR row IN e_cur
        LOOP
				IF row.id_Agent=id_emp -- s'il s'agit de l'element à supprimer
				THEN
						DELETE FROM equipe 
						WHERE id_Agent=id_emp and date_t=date_c;
						INSERT INTO equipe VALUES (2, 3, 2,1, date_c, 1) ; -- Insertion d'un replaçant
				END IF;
				                         
		END LOOP;
END;
/
show errors PROCEDURE modif_equipe;
-- execute modif_equipe(8,TO_DATE ('2018-03-03','YYYY/MM/DD');


--Q3: Définir une fonction qui liste les jours d_astreintes de deux personnes données en paramètre travaillant dans la même équipe.

CREATE OR REPLACE PROCEDURE liste_jour_astreinte ( id_agent1 number, id_agent2 number)
IS
	data_found number ;
	 cursor l_j_cur IS
                SELECT e1.id_Agent,e1.id_astreinte,e1.id_periode, e1.date_t as dating FROM equipe e1 inner join equipe e2
                ON e1.id_Agent=id_Agent1  
                and e2.id_agent=id_Agent2                    
				and e1.id_periode=e2.id_periode
				and e1.date_t=e2.date_t
				and e1.id_astreinte=e2.id_astreinte;	
			
BEGIN
			 
		
		data_found :=0;
		
				FOR jour_cur IN l_j_cur
				LOOP
				
					data_found := data_found + 1;
					DBMS_OUTPUT.PUT_LINE('jours : ' || jour_cur.dating);
						   
				END LOOP ;
		
			
		IF data_found = 0 THEN 
				DBMS_OUTPUT.PUT_LINE(' /!\ les deux personnes ne sont pas dans la meme equipe /!\ ');
	 END IF;
END ;
/

show errors PROCEDURE liste_jour_astreinte;
-- execute liste_jour_astreinte(1,6);
  
--Q4: Définir une fonction qui liste lors de la modification d_une équipe le planning du mois qui vient d_être mis à jour.
-- /!\ pour la question 4, j_ai utilisé un trigger à la place d_une fonction

CREATE OR REPLACE TRIGGER modif_planning
	BEFORE INSERT OR UPDATE
			ON equipe
			FOR EACH ROW
DECLARE
	
	dating char;
	ag number;
	ast varchar2(128);
	p number;
	d date;
	n number;
BEGIN
	SELECT distinct TO_CHAR(date_t, 'MM') INTO dating
	FROM equipe
	WHERE TO_CHAR(date_t, 'MM')= TO_CHAR(sysdate, 'MM');
 
	SELECT id_Agent,id_astreinte,id_periode,date_t,num_equipe into ag,ast,p,d,n
	FROM equipe
	WHERE TO_CHAR(date_t, 'MM') = dating;
	
	DBMS_OUTPUT.PUT_LINE( ag || ast || p || d || n); 
	
END ;
/

SHOW ERRORS trigger modif_planning;

--Q5: Définir une fonction fournissant pour l'année et pour chaque mois le nombre d'astreinte effectué par chaque agent
-- pour chaque type d_astreinte, le nombre de jour férié travaillé et le nombre de week-end complet travaillé.

CREATE OR REPLACE PROCEDURE planning_p
IS

 cursor p_cur1 is  select DISTINCT  e1.id_Agent,TO_CHAR(e1.date_t,'MM') as dating,count(e1.id_astreinte) as nb_astreinte from equipe e1 join equipe e2
				on e1.id_periode=e2.id_periode
				and e1.date_t=e2.date_t
				and e1.id_astreinte=e2.id_astreinte
				group by e1.id_Agent,e1.date_t,TO_CHAR(e1.date_t,'MM');
				 
 cursor p_cur2 is  select DISTINCT type_astreinte as types,FERIE_travailler as jour_ferie, WE_travailler as week_end_t
 from statistique
 GROUP BY type_astreinte,FERIE_travailler,WE_travailler;


  Begin

     For i in p_cur1
     loop
         
                DBMS_OUTPUT.PUT_LINE(
                        'Nombre astreintes : ' || i.nb_astreinte
                        || ', Mois : ' || i.dating
                        );
                      
        END LOOP ;

     For j in p_cur2
       LOOP
         
                DBMS_OUTPUT.PUT_LINE(
                       'type astreinte : '|| j.types
                        ||', nombre de jours feries travaille : ' || j.jour_ferie
                        || ', nombre de week_end travaille : ' || j.week_end_t
                        );
                      
        END LOOP;

   END;
/

show errors PROCEDURE planning_p;
-- execute planning_p
