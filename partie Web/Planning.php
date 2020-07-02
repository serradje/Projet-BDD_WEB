<?php
class Planning {
  private	$joursFr = Array(0=>'Dimanche', 1=>'Lundi', 2=>'Mardi', 3=>'Mercredi', 4=>'Jeudi', 5=>'Vendredi', 6=>'Samedi');
  
  private $jourDebut;		// jour de début du planning (0 à 6)
  private $jourFin;		// jour de fin du planning

  private $heureDebut; 	// heure de début de chaque jour (en minutes)
  private $heureFin;		// heure de fin de chaque jour (en minutes)

  private $pas; 			// durée d'une case (en minutes)
  private $minutesKeys;
  
  private $contenu;		// contenu général du planning (tableau de PlanningCellule)

  private $tabSemaine;	// stockage des données (tableau initialisé avec des cellules vides)

  const htmlSpace = '&nbsp;';
  const htmlEmptyCell = '<td>&nbsp;</td>';
  const htmlCellOpen = '<td>';
  const htmlCellClose = '</td>';
  const htmlRowOpen = '<tr>';
  const htmlRowClose = '</tr>';
  const htmlTableOpen = '<table class="tabPlanning">';
  const htmlTableClose = '</table>';
  
  const separateurHeure = 'h';

  public function __construct($jourDebut=1, $jourFin=5, $heureDebut=540, $heureFin=1260, $pas=30, $contenu = Array()){
    $this->jourDebut = $jourDebut;
    $this->jourFin = $jourFin;
    $this->heureDebut = $heureDebut;
    $this->heureFin = $heureFin;
    $this->pas = $pas;
    $this->contenu = $contenu;
    
    $this->initTableauSemaine($this->contenu);
    // $this->debugPHPArrays();
    $this->insererContenus($contenu);
  }
  
  /**
   * Génère un tableau dont les clés sont les heures de début de chaque case (en minutes)
   * Serviront à identifier facilement chaque case du planning
   * @return unknown_type
   */
  private function genererMinutesKeys() {
    $keys = Array();
    for ($key=$this->heureDebut; $key<=$this->heureFin; $key+=$this->pas) {
      $keys[] = $key;
    }
    $this->keys = $keys;
    return $keys;
  }

  /**
   * Génère un tableau correspondant à un jour
   * @return unknown_type
   */
  private function initTableauJour() {
    if ($this->pas != 0) {
      $numCells = ($this->heureDebut - $this->heureFin) / $this->pas;
    } else {
      echo 'pas == 0 !!';
    }
    $keys = $this->genererMinutesKeys();
    $tabJour = array_fill_keys($keys, self::htmlEmptyCell);
    return $tabJour;
  }

  private  function initTableauSemaine() {
    $this->tabSemaine = Array();
    $tabJour = $this->initTableauJour();
    for($i=$this->jourDebut; $i<=$this->jourFin; $i++) {
      $this->tabSemaine[$i] = $tabJour;
    }
  }
  
  private function getNumeroCellule($minutesDebut, $minutesFin) {
    return ($minutesFin - $minutesDebut) / $this->pas;
  }
  
  /**
   * Insère tous les contenus de cellulés envoyés
   * @param $contenuPlanning
   * @return unknown_type
   */
  private function insererContenus($contenuPlanning) {
    foreach ($contenuPlanning as $contenuCellule) {
      $this->insererContenu($contenuCellule);
    }
  }
  
  /**
   * Insère le contenu d'une cellule précise
   * @param $contenuCellule
   * @return unknown_type
   */
  private function insererContenu($contenuCellule) {
    // ajout de la cellule fusionnée
    $duree = $this->getNumeroCellule($contenuCellule->heureDebut, $contenuCellule->heureFin);
    $contenu = $contenuCellule->contenu.'<br />';
    $contenu .= $this->convertMinutesEnHeuresMinutes($contenuCellule->heureDebut);
    $contenu .= ' - '.$this->convertMinutesEnHeuresMinutes($contenuCellule->heureFin);
    
    $this->tabSemaine[$contenuCellule->numJour][$contenuCellule->heureDebut] = $this->genererCelluleHTML($contenu, $duree, '', $contenuCellule->bgColor);
    
    // suppression du contenu suivant
    $key = $contenuCellule->heureDebut;
    for ($cpt = $duree-1; $cpt>0; $cpt--) {
      $key += $this->pas;
      $this->tabSemaine[$contenuCellule->numJour][$key] = '';			
    }
  }
  
  /* Affichage */	
  public function debugPHPArrays() {
    echo '<pre>';
    print_r($this->tabSemaine);
    echo '</pre>';		
  }
  
  public function genererHtmlTable() {
    $htmlTable = self::htmlTableOpen;

    $htmlTable .= $this->genererBandeauJours();
    
    $key = $this->heureDebut;
    $keyEnd = $this->heureFin;
    for ($key; $key <= $keyEnd; $key+=$this->pas) {
      $htmlTable .= self::htmlRowOpen;
      $htmlTable .= '<td class="cellHour">'.$this->convertMinutesEnHeuresMinutes($key).'</td>';
      foreach ($this->tabSemaine as $tabHeures) {
        $htmlTable .= $tabHeures[$key];
      }
      $htmlTable .= self::htmlRowClose;
    }
    
    $htmlTable .= self::htmlTableClose;
    return $htmlTable;
  }
  
  public function afficherHtmlTable() {
    echo $this->genererHtmlTable();
  }
  
  private function genererBandeauJours() {
    $daysLine = self::htmlRowOpen;
    $daysLine .= $this->genererCelluleHTML(self::htmlSpace);
    $day = $this->jourDebut;
    while ($day <= $this->jourFin) {
      $daysLine .= $this->genererCelluleHTML($this->jourFr($day), '', 'cellDay');
      $day++;
    }
    $daysLine .= self::htmlRowClose;
    return $daysLine;
  }
  
  /**
   * Génère une ligne HTML contenant le libellé des jours utilisés dans le planning
   * @param $contenuCellule
   * @param $colspan
   * @param $class
   * @param $bgColor
   * @return unknown_type
   */
  private function genererCelluleHTML($contenuCellule, $colspan = '', $class = '', $bgColor = '') {
    $celluleHTML = '<td';
    if (!empty($colspan)) 
      $celluleHTML .= ' rowspan="'.$colspan.'"';			
    if (!empty($class)) 
      $celluleHTML .= ' class="'.$class.'"';
    if (!empty($bgColor)) 
      $celluleHTML .= ' bgcolor="'.$bgColor.'"';
    $celluleHTML .= '/>';
    $celluleHTML .= $contenuCellule;
    $celluleHTML .= '</td>';
    return $celluleHTML;
  }
  
  /**
   * Renvoie le libellé d'un jour en Français
   * @param $dayNum
   * @return unknown_type
   */
  private function jourFr($dayNum) {
    return $this->joursFr[$dayNum];
  }

  private function convertMinutesEnHeuresMinutes($minutes) {
    $heure = floor($minutes / 60);
    $minutes = ($minutes % 60);
    $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
    return ($heure. self::separateurHeure .$minutes);
  }
}
?>