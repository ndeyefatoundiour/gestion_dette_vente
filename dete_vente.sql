DROP TABLE paiement ;
DROP TABLE dette ;
DROP TABLE ligne_vente ;
DROP TABLE vente ;
DROP TABLE produit ;
DROP TABLE paiement_mode ;
DROP TABLE reglement_mode ;
DROP TABLE client ;

CREATE TABLE client (
    id SERIAL PRIMARY KEY,
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20),
    mail VARCHAR(150) UNIQUE
);

INSERT INTO client (prenom, nom, telephone, mail)
VALUES
('Awa', 'Diop', '771234567', 'awa.diop@gmail.com'),
('Fatou', 'Ndiaye', '772345678', 'fatou.ndiaye@gmail.com'),
('Moussa', 'Fall', '773456789', 'moussa.fall@gmail.com'),
('Mariama', 'Sow', '774567890', 'mariama.sow@gmail.com'),
('Ibrahima', 'Ba', '775678901', 'ibrahima.ba@gmail.com');

CREATE TABLE paiement_mode (
    id SERIAL PRIMARY KEY,
    nom_mode VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO paiement_mode (nom_mode)
VALUES
('Espèces'),
('Wave'),
('Orange Money'),
('Carte bancaire');


CREATE TABLE reglement_mode (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

INSERT INTO reglement_mode (nom)
VALUES
('Comptant'),
('Crédit');


CREATE TABLE produit (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(150) NOT NULL,
    prix_unitaire NUMERIC(12,2) NOT NULL CHECK (prix_unitaire >= 0),
    qte_stock INTEGER NOT NULL DEFAULT 0 CHECK (qte_stock >= 0)
);

INSERT INTO produit (libelle, prix_unitaire, qte_stock)
VALUES
('Ordinateur HP', 350000, 10),
('Souris sans fil', 10000, 50),
('Clavier', 15000, 30),
('Écran Samsung', 125000, 15),
('Casque Bluetooth', 25000, 40),
('Disque SSD 512 Go', 45000, 20);

CREATE TABLE vente (
    id SERIAL PRIMARY KEY,

    client_id INTEGER NOT NULL REFERENCES client(id),
    reglement_mode_id INTEGER NOT NULL REFERENCES reglement_mode(id),

    montant_total NUMERIC(12,2) NOT NULL
        CHECK (montant_total >= 0),

    montant_verse NUMERIC(12,2) NOT NULL DEFAULT 0
        CHECK (montant_verse >= 0),

    date DATE NOT NULL DEFAULT CURRENT_DATE,

    CONSTRAINT montant_verse_valide
        CHECK (montant_verse <= montant_total)
);


INSERT INTO vente
(client_id, reglement_mode_id, montant_total, montant_verse, date)
VALUES
(1, 1, 370000, 370000, '2026-08-01'),
(2, 2, 140000, 100000, '2026-08-02'),
(3, 1, 25000, 25000, '2026-08-03'),
(4, 2, 215000, 50000, '2026-08-04');



CREATE TABLE ligne_vente (
    id SERIAL PRIMARY KEY,

    vente_id INTEGER NOT NULL REFERENCES vente(id),
    produit_id INTEGER NOT NULL REFERENCES produit(id),

    quantite_vente INTEGER NOT NULL
        CHECK (quantite_vente > 0),

    prix_vente NUMERIC(12,2) NOT NULL
        CHECK (prix_vente >= 0)
);

INSERT INTO ligne_vente
(vente_id, produit_id, quantite_vente, prix_vente)
VALUES
(1, 1, 1, 350000),
(1, 2, 2, 10000),
(2, 4, 1, 125000),
(2, 3, 1, 15000),
(4, 6, 2, 45000),
(4, 5, 5, 25000);


CREATE TABLE dette (
    id SERIAL PRIMARY KEY,

    vente_id INTEGER NOT NULL UNIQUE REFERENCES vente(id),
    client_id INTEGER NOT NULL REFERENCES client(id),

    date DATE NOT NULL DEFAULT CURRENT_DATE,

    montant_initial NUMERIC(12,2) NOT NULL
        CHECK (montant_initial > 0),

    montant_restant NUMERIC(12,2) NOT NULL
        CHECK (montant_restant >= 0),

    CONSTRAINT montant_restant_valide
        CHECK (montant_restant <= montant_initial)
);

INSERT INTO dette
(vente_id, client_id, date, montant_initial, montant_restant)
VALUES
(2, 2, '2026-08-02', 40000, 40000),
(4, 4, '2026-08-04', 165000, 165000);


CREATE TABLE paiement (
    id SERIAL PRIMARY KEY,

    dette_id INTEGER NOT NULL REFERENCES dette(id),
    paiement_mode_id INTEGER NOT NULL REFERENCES paiement_mode(id),

    date DATE NOT NULL DEFAULT CURRENT_DATE,

    montant NUMERIC(12,2) NOT NULL
        CHECK (montant > 0)

);

INSERT INTO paiement
(dette_id, paiement_mode_id, date, montant)
VALUES
(1, 2, '2026-08-05', 20000),
(2, 3, '2026-08-06', 65000);


SELECT * FROM client;

SELECT * FROM reglement_mode;

SELECT * FROM produit;

SELECT * FROM paiement_mode;

SELECT * FROM vente;

SELECT * FROM ligne_vente;

SELECT * FROM dette;

SELECT * FROM paiement;

SELECT concat('#CMD-' ,v.id), c.prenom ||' '|| c.nom , v.montant_total,rm.nom
FROM vente v
INNER JOIN client c
ON v.client_id = c.id
INNER JOIN reglement_mode rm
ON v.reglement_mode_id=rm.id;


SELECT libelle
FROM produit;

SELECT concat(prenom ||' '|| nom , telephone)
FROM client;


SELECT p.libelle,p.prix_unitaire,lv.quantite_vente,lv.prix_vente
FROM ligne_vente lv
INNER JOIN produit p
ON p.id=lv.produit_id
WHERE lv.vente_id=1;


SELECT concat('#DT-' ,d.id) AS id_dette ,d.id, c.prenom ||' '|| c.nom AS nomComplet ,c.telephone,  to_char(d.date ,'DD-MM-YYYY') AS date ,d.montant_initial,(d.montant_initial-d.montant_restant) AS montant_verse,d.montant_restant,
    CASE 
        WHEN d.montant_restant = 0 THEN  'SOLDER'
        ELSE  'NON SOLDER'
    END AS statut
FROM dette d
INNER JOIN client c
ON d.client_id = c.id;


SELECT SUM(montant_restant) AS créances-actives 
FROM dette;

SELECT COUNT(client_id) AS clients-débiteurs
FROM dette
WHERE montant_restant>0

SELECT SUM (montant_initial - montant_restant) AS  total-recouvrements
FROM dette;

SELECT COUNT(id)
FROM vente ;

SELECT SUM(montant_verse) AS total-recue
FROM vente ;
