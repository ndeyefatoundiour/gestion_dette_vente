<?php

require_once dirname(__DIR__)."/config/database.php";

function getAllVente() : array {
    
    $pdo=connexionDB();

    $sql="SELECT v.id ,concat('#CMD-' ,v.id) AS ide, c.prenom ||' '|| c.nom  AS nomComplet, v.montant_total AS total, rm.nom AS nom,c.telephone AS telephone
        FROM vente v
        INNER JOIN client c
        ON v.client_id = c.id
        INNER JOIN reglement_mode rm
        ON v.reglement_mode_id=rm.id;
    ";

    $ventes=query( $pdo, $sql, false);

    $sql1="SELECT p.libelle AS libelle,p.prix_unitaire AS prix_unitaire,lv.quantite_vente AS qt_vente,(p.prix_unitaire*lv.quantite_vente)AS prix_vendu
    FROM ligne_vente lv
    INNER JOIN produit p
    ON p.id=lv.produit_id
    WHERE lv.vente_id=:idvente;";

    foreach ($ventes as &$vente) {

        $vente['leprod']=executeQuery( $pdo, $sql1, [':idvente' => $vente['id']], false) ;
    }
    unset($vente);

    $pdo = null;

    return $ventes;
}


function getModePay() : array {

    $pdo=connexionDB();

    $sql="SELECT nom
        FROM reglement_mode;
    ";

    $result=query( $pdo, $sql, false);

    $pdo = null;

    return $result;
}


function nombreVente() {

    $pdo=connexionDB();

     $sql="SELECT COUNT(id) AS nombr_vente
    FROM vente ;
    ";
    $result=query( $pdo, $sql, false);

    $pdo = null;

    return $result;
   
}


function totalDUE() {

    $pdo=connexionDB();

     $sql="SELECT SUM(montant_restant) AS créances_actives 
        FROM dette; 
    ";
    $result=query( $pdo, $sql, false);

    $pdo = null;
  
    return $result;
   
}


function totalRecue() {

    $pdo=connexionDB();

     $sql="SELECT SUM(montant_verse) AS total_recue
        FROM vente  ;
    ";
    $result=query( $pdo, $sql, false);

    $pdo = null;

    return $result;
}