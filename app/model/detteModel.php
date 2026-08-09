<?php

require_once dirname(__DIR__)."/config/database.php";

function getDette() : array {

    $pdo=connexionDB();

    $sql="SELECT concat('#DT-' ,d.id) AS id_dette ,d.id, c.prenom ||' '|| c.nom AS nomComplet ,c.telephone,  to_char(d.date ,'DD-MM-YYYY') AS date ,d.montant_initial,(d.montant_initial-d.montant_restant) AS montant_verse,d.montant_restant,
        CASE 
            WHEN d.montant_restant = 0 THEN  'SOLDER'
            ELSE  'NON SOLDER'
        END AS statut
    FROM dette d
    INNER JOIN client c
    ON d.client_id = c.id;
    ";

    $result=query( $pdo, $sql, false);

    $pdo = null;

    return $result;
}



function nombreDette() {

    $pdo=connexionDB();

     $sql="SELECT COUNT(client_id) AS clients-débiteurs
            FROM dette
            WHERE montant_restant>0 ;
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

     $sql="SELECT SUM (montant_initial - montant_restant) AS  total-recouvrements
        FROM dette; 
    ";
    $result=query( $pdo, $sql, false);

    $pdo = null;

    return $result;
   
}