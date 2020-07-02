<?php
Class PlanningMapper {
  // instance de la classe
  private static $instance;

  // Un constructeur privé ; empêche la création directe d'objet
  private function __construct() { }

  // La méthode singleton
  public static function getInstance() {
    if (!isset(self::$instance)) {
      $c = __CLASS__;
      self::$instance = new $c;
    }
    return self::$instance;
  }

  public function genererPlanningCellule($cours) {
    // $lienNiveau = UrlHelper::link_to($cours->getAlphaNiveaux()->getLibelleNiveau(), 'niveaux/listApprenantsParNiveau/idNiveau'.$cours->getAlphaNiveaux()->getIdNiveau());
    $contenuCellule = '<b>'.$cours->getAlphaFormateurs()->getPrenomFormateur().'</b><br />'
    .$cours->getAlphaNiveaux()->getLibelleNiveau();

    $planningContent = new PlanningCellule($cours->getJour(),
    $cours->getHeureDebut(),
    $cours->getHeureFin(),
    $cours->getAlphaNiveaux()->getCodeCouleur(),
    $contenuCellule);
    return $planningContent;
  }

  public function __clone() {
    trigger_error('Le clônage n\'est pas autorisé.', E_USER_ERROR);
  }
}

?>