
<html>
<head>
  <title> planning </title>
  <link rel="stylesheet" type="text/css" media="screen" href="planning.css" />
<body>

<div id="planning">
<?php
include('Planning.php');
include('PlanningCellule.php');
include('PlanningMapper.php');

$contenusCellules[] = new PlanningCellule(1,'17:00:00','19:00:00','#008000','<b>Zeus</b><br />ODO');
$contenusCellules[] = new PlanningCellule(1,'19:00:00','21:00:00','#7CCAF4','<b>Ryle</b><br />ODO');
$contenusCellules[] = new PlanningCellule(2,'12:00:00','14:00:00','#7CCAF4','<b>Mère-Térésa</b><br />ODO');
$contenusCellules[] = new PlanningCellule(2,'14:00:00','15:00:00','#314E8C','<b>Truc</b><br />ODO');
$contenusCellules[] = new PlanningCellule(2,'16:00:00','17:00:00','#314E8C','<b>Albat</b><br />ODO');
$contenusCellules[] = new PlanningCellule(2,'17:00:00','19:00:00','#C080C0','<b>Calimero</b><br />ODO');
$contenusCellules[] = new PlanningCellule(3,'10:00:00','12:00:00','#800080','<b>Damien</b><br />ODO');
$contenusCellules[] = new PlanningCellule(3,'13:00:00','14:30:00','#314E8C','<b>Cobaye</b><br />ODO');
$contenusCellules[] = new PlanningCellule(3,'14:00:00','16:00:00','#80C080','<b>Moosh</b><br />ODO');
$contenusCellules[] = new PlanningCellule(3,'16:00:00','17:00:00','#008000','<b>@rthur</b><br />ODO');
$contenusCellules[] = new PlanningCellule(3,'18:00:00','20:00:00','#80C080','<b>Dunbar</b><br />ODO');
$contenusCellules[] = new PlanningCellule(3,'20:00:00','21:00:00','#7CCAF4','<b>Ryle</b><br />ODO');
$contenusCellules[] = new PlanningCellule(4,'11:00:00','12:00:00','#314E8C','<b>AB</b><br />ODO');
$contenusCellules[] = new PlanningCellule(4,'14:00:00','15:00:00','#7CCAF4','<b>Hywan</b><br />ODO');
$contenusCellules[] = new PlanningCellule(4,'17:00:00','18:00:00','#7CCAF4','<b>Sekiltoyai</b><br />ODO');
$contenusCellules[] = new PlanningCellule(4,'18:00:00','20:00:00','#800080','<b>Genova</b><br />ODO');
$contenusCellules[] = new PlanningCellule(4,'20:00:00','21:00:00','#008000','<b>Ouckileou</b><br />ODO');
$contenusCellules[] = new PlanningCellule(5,'09:00:00','10:00:00','#314E8C','<b>Nagol</b><br />ODO');
$contenusCellules[] = new PlanningCellule(5,'18:00:00','19:00:00','#80C080','<b>Fab</b><br />ODO');
$contenusCellules[] = new PlanningCellule(6,'10:00:00','12:00:00','#80C080','<b>Naholyr</b><br />ODO');




$contenusCellules1[] = new PlanningCellule(1,'17:30:00','19:00:00','#008000','<b>Zeus</b><br />B1/1');
$contenusCellules1[] = new PlanningCellule(1,'19:30:00','21:00:00','#7CCAF4','<b>Ryle</b><br />A2');
$contenusCellules1[] = new PlanningCellule(2,'12:30:00','14:00:00','#7CCAF4','<b>Mère-Térésa</b><br />A2');
$contenusCellules1[] = new PlanningCellule(2,'14:00:00','15:30:00','#314E8C','<b>Truc</b><br />A1');
$contenusCellules1[] = new PlanningCellule(2,'16:00:00','17:30:00','#314E8C','<b>Albat</b><br />A1');
$contenusCellules1[] = new PlanningCellule(2,'17:30:00','19:00:00','#C080C0','<b>Calimero</b><br />B3');
$contenusCellules1[] = new PlanningCellule(3,'10:30:00','12:00:00','#800080','<b>Damien</b><br />B2');
$contenusCellules1[] = new PlanningCellule(3,'13:00:00','14:30:00','#314E8C','<b>Cobaye</b><br />A1');
$contenusCellules1[] = new PlanningCellule(3,'14:30:00','16:00:00','#80C080','<b>Moosh</b><br />B1/2');
$contenusCellules1[] = new PlanningCellule(3,'16:00:00','17:30:00','#008000','<b>@rthur</b><br />B1/1');
$contenusCellules1[] = new PlanningCellule(3,'18:30:00','20:00:00','#80C080','<b>Dunbar</b><br />B1/2');
$contenusCellules1[] = new PlanningCellule(3,'20:00:00','21:30:00','#7CCAF4','<b>Ryle</b><br />A2');
$contenusCellules1[] = new PlanningCellule(4,'11:00:00','12:30:00','#314E8C','<b>AB</b><br />A1');
$contenusCellules1[] = new PlanningCellule(4,'14:00:00','15:30:00','#7CCAF4','<b>Hywan</b><br />A2');
$contenusCellules1[] = new PlanningCellule(4,'17:00:00','18:30:00','#7CCAF4','<b>Sekiltoyai</b><br />A2');
$contenusCellules1[] = new PlanningCellule(4,'18:30:00','20:00:00','#800080','<b>Genova</b><br />B2');
$contenusCellules1[] = new PlanningCellule(4,'20:00:00','21:30:00','#008000','<b>Ouckileou</b><br />B1/1');
$contenusCellules1[] = new PlanningCellule(5,'09:00:00','10:30:00','#314E8C','<b>Nagol</b><br />A1');
$contenusCellules1[] = new PlanningCellule(5,'18:00:00','19:30:00','#80C080','<b>Fab</b><br />B1/2');
$contenusCellules1[] = new PlanningCellule(6,'10:30:00','12:00:00','#80C080','<b>Naholyr</b><br />B1/2');



//$planning = new Planning(1, 6, 540, 1260, 60, $contenusCellules);
//$planning = new Planning(0, 1, 480, 1320, 60, $contenusCellules);
//$planning->afficherHtmlTable();


	$planning1 = new Planning(1, 6, 540, 1260, 30, $contenusCellules1);
	$planning1->afficherHtmlTable();



?>
</div>

</body>
</html>