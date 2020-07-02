--Q1: Une équipe est composée au maximum de trois personnes.

CREATE OR REPLACE TRIGGER max_3_personnes
	BEFORE INSERT OR UPDATE
			ON equipe
			FOR EACH ROW
DECLARE
	
	limite number;
BEGIN
	SELECT count(DISTINCT e.num_equipe) INTO limite FROM equipe e
	 where e.num_equipe=e.num_equipe
	 and e.id_astreinte=e.id_astreinte
	 and e.date_t=e.date_t; 
	
	IF limite > 3 THEN 
		RAISE_APPLICATION_ERROR(-20000,'Equipe Complet !!') ;
	END IF;
	
END;
/

SHOW ERRORS trigger max_3_personnes;


--Q2:Une même équipe est en mode astreinte pendant au moins deux semaines de suites.

CREATE OR REPLACE TRIGGER mode_astreinte
	BEFORE INSERT OR UPDATE
			ON equipe
			FOR EACH ROW
DECLARE
	cpt number;
BEGIN

	cpt := 1;
	
	FOR cpt in 1 .. 14
	LOOP
	
		:NEW.date_t := :OLD.date_t + cpt;
		INSERT INTO equipe VALUES(:OLD.id_Agent,:OLD.id_equipement,:OLD.id_astreinte,:OLD.id_periode,:NEW.date_t,:OLD.num_equipe);
	END LOOP;
	
END;
/

SHOW ERRORS trigger mode_astreinte;


-- Q3:Un agent ne peut pas être en astreinte pendant plus de quatre semaines de suite, sans compter le mode SLOW.



-- Q4: Un congé ne peut pas être posé pour une date ultérieur sauf si l'utilisateur est un administrateur

CREATE OR REPLACE TRIGGER date_ulterieur
	BEFORE INSERT OR UPDATE
			ON equipe
			FOR EACH ROW
DECLARE
	dating date;
	admin number;  --je declare admin comme identifiant qui represente l'adminstrateur = 0
BEGIN
	SELECT DISTINCT id_Agent,date_t INTO admin,dating FROM equipe group by id_Agent, date_t;
	
	
	IF dating > sysdate and admin != 0 THEN
		RAISE_APPLICATION_ERROR(-20001,' Acces interdit!!') ;
	END IF;
	
END;
/

SHOW ERRORS trigger date_ulterieur;

-- Q5: Une semaine d'astreinte ODO par mois, entre une et deux semaines d'astreinte complète PS par mois, maximum
--     une astreinte SB par mois. Un mois peut contenir deux semaines d'astreinte PS et une fin de semaine PS du
--     mois précédent ou un début de semaine PS du mois suivant.






