<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

// DEBUT GET -------------------------------------------------------------------------
// Utilisateur
$app->get('/utilisateur/[{login}/{password}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT id FROM utilisateur WHERE login=:login AND password=:password");
    $sth->bindParam("login", $args['login']);
    $sth->bindParam("password", $args['password']);
    $sth->execute();
    $utilisateur = $sth->fetchObject();
    return $this->response->withJson($utilisateur->id);
});

// Liste des magasins par utilisateur
$app->get('/magasins/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM magasin WHERE idutilisateur=:id ORDER BY dateajout DESC");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $magasins = $sth->fetchAll();
    return $this->response->withJson($magasins);
});

// Magasin par id
$app->get('/magasin/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM magasin WHERE id=:id ORDER BY dateajout DESC");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $magasin = $sth->fetchAll();
    return $this->response->withJson($magasin);
});

// Liste des logiciels pour un magasin
$app->get('/magasin/logiciels/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM logiciel WHERE idmagasin=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $logiciels = $sth->fetchAll();
    return $this->response->withJson($logiciels);
});

// Logiciel par id
$app->get('/logiciel/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM logiciel WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $logiciel = $sth->fetchAll();
    return $this->response->withJson($logiciel);
});

// Liste des serveurs pour un magasin
$app->get('/magasin/serveurs/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM serveur WHERE idmagasin=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $serveurs = $sth->fetchAll();
    return $this->response->withJson($serveurs);
});

// Serveur par id
$app->get('/serveur/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM serveur WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $serveur = $sth->fetchAll();
    return $this->response->withJson($serveur);
});

// Liste des tpvs pour un magasin
$app->get('/magasin/tpvs/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM tpv WHERE idmagasin=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $tpv = $sth->fetchAll();
    return $this->response->withJson($tpv);
});

// Tpv par id
$app->get('/tpv/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM tpv WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $tpv = $sth->fetchAll();
    return $this->response->withJson($tpv);
});

// Envoie de mail
$app->get('/mail/[{id}]', function (Request $request, Response $response, array $args) {
    $sth = $this->db->prepare("SELECT * FROM magasin WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    $magasin = $sth->fetchObject();

    $message = '
    <html>
        <head>
            <title>Ajout d\'un magasin</title>
            <style>
                table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 5px;
                }
            </style>
        </head>
        <body>
            <p>Ajout d\'un nouveau magasin : </p>
            <table>
                <tr>
                    <th>Date d\'ajout</th>
                    <th>Enseigne</th>
                    <th>Site</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>CP</th>
                    <th>Responsable</th>
                    <th>Téléphone</th>
                    <th>Contact</th>
                    <th>Fax</th>
                    <th>Caisses</th>
                    <th>Nombre</th>
                    <th>Telemaintenance</th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                    <th>Dimanche</th>
                </tr>
                <tr style="border: 1px solid black;">
                    <td>'.$magasin->dateajout.'</td>
                    <td>'.$magasin->enseigne.'</td>
                    <td>'.$magasin->site.'</td>
                    <td>'.$magasin->adresse.'</td>
                    <td>'.$magasin->ville.'</td>
                    <td>'.$magasin->CP.'</td>
                    <td>'.$magasin->responsable.'</td>
                    <td>'.$magasin->telephone.'</td>
                    <td>'.$magasin->contact.'</td>
                    <td>'.$magasin->fax.'</td>
                    <td>'.$magasin->caisses.'</td>
                    <td>'.$magasin->nombre.'</td>
                    <td>'.$magasin->telemaintenance.'</td>
                    <td>'.$magasin->lundiDebut.' - '.$magasin->lundiFin.'</td>
                    <td>'.$magasin->mardiDebut.' - '.$magasin->mardiFin.'</td>
                    <td>'.$magasin->mercrediDebut.' - '.$magasin->mercrediFin.'</td>
                    <td>'.$magasin->jeudiDebut.' - '.$magasin->jeudiFin.'</td>
                    <td>'.$magasin->vendrediDebut.' - '.$magasin->vendrediFin.'</td>
                    <td>'.$magasin->samediDebut.' - '.$magasin->samediFin.'</td>
                    <td>'.$magasin->dimancheDebut.' - '.$magasin->dimancheFin.'</td>
                </tr>
            </table>
            <p>Les équipements : </p>
            <table>
                <tr>
                    <th>Désignation</th>
                    <th>Référence</th>
                    <th>Licence</th>
                    <th>Quantité</th>
                </tr>';

    $sth = $this->db->prepare("SELECT * FROM logiciel WHERE idmagasin=:idmagasin");
    $sth->bindParam("idmagasin", $magasin->id);
    $sth->execute();

    while($logiciels = $sth->fetchObject()) {
        $message .= '
                <tr>
                    <td>'.$logiciels->designation.'</td>
                    <td>'.$logiciels->reference.'</td>
                    <td>'.$logiciels->licence.'</td>
                    <td>'.$logiciels->quantite.'</td>
                </tr>';
    }

    $message .= '
            </table>
            <p>Les serveurs : </p>
            <table>
                <tr>
                    <th>Désignation</th>
                    <th>Référence</th>
                    <th>Numéro de série</th>
                    <th>Quantité</th>
                </tr>';

    $sth = $this->db->prepare("SELECT * FROM serveur WHERE idmagasin=:idmagasin");
    $sth->bindParam("idmagasin", $magasin->id);
    $sth->execute();

    while($serveurs = $sth->fetchObject()) {
        $message .= '
                <tr>
                    <td>'.$serveurs->designation.'</td>
                    <td>'.$serveurs->reference.'</td>
                    <td>'.$serveurs->numeroserie.'</td>
                    <td>'.$serveurs->quantite.'</td>
                </tr>';
    }

    $message .= '
            </table>
            <p>Les TPVs : </p>
            <table>
                <tr>
                    <th>Désignation</th>
                    <th>Référence</th>
                    <th>Numéro de série</th>
                    <th>Quantité</th>
                </tr>';

    $sth = $this->db->prepare("SELECT * FROM tpv WHERE idmagasin=:idmagasin");
    $sth->bindParam("idmagasin", $magasin->id);
    $sth->execute();

    while($tpvs = $sth->fetchObject()) {
        $message .= '
                <tr>
                    <td>'.$tpvs->designation.'</td>
                    <td>'.$tpvs->reference.'</td>
                    <td>'.$tpvs->numeroserie.'</td>
                    <td>'.$tpvs->quantite.'</td>
                </tr>';
    }

    $message .= '
            </table>
        </body>
    </html>';

    $from = "cfgAdmin@symag.com";
    
    $to = "yann.lemoal@lasersymag.com";

    $subject = "Magasin ajouté";

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From:" . $from; 

    mail($to,$subject,$message, $headers);

    return $this->response->write("Mail envoyé");
});
// FIN GET

// DEBUT POST -----------------------------------------------------------
// Ajout d'un magasin
$app->post('/magasin', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `magasin`(`dateajout`, `enseigne`, `site`, `adresse`, `ville`, `CP`, `responsable`, `telephone`, `contact`, `fax`, `caisses`, `nombre`, `telemaintenance`, `idutilisateur`, `lundiDebut`, `lundiFin`, `mardiDebut`, `mardiFin`, `mercrediDebut`, `mercrediFin`, `jeudiDebut`, `jeudiFin`, `vendrediDebut`, `vendrediFin`, `samediDebut`, `samediFin`, `dimancheDebut`, `dimancheFin`) 
            VALUES (:dateajout, :enseigne, :site, :adresse, :ville, :CP, :responsable, :telephone, :contact, :fax, :caisses, :nombre, :telemaintenance, :idutilisateur, :lundiDebut, :lundiFin, :mardiDebut, :mardiFin, :mercrediDebut, :mercrediFin, :jeudiDebut, :jeudiFin, :vendrediDebut, :vendrediFin, :samediDebut, :samediFin, :dimancheDebut, :dimancheFin);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("dateajout", $input['dateajout']);
    $sth->bindParam("enseigne", $input['enseigne']);
    $sth->bindParam("site", $input['site']);
    $sth->bindParam("adresse", $input['adresse']);
    $sth->bindParam("ville", $input['ville']);
    $sth->bindParam("CP", $input['CP']);
    $sth->bindParam("responsable", $input['responsable']);
    $sth->bindParam("telephone", $input['telephone']);
    $sth->bindParam("contact", $input['contact']);
    $sth->bindParam("fax", $input['fax']);
    $sth->bindParam("caisses", $input['caisses']);
    $sth->bindParam("nombre", $input['nombre']);
    $sth->bindParam("telemaintenance", $input['telemaintenance']);
    $sth->bindParam("idutilisateur", $input['idutilisateur']);
    $sth->bindParam("lundiDebut", $input['lundiDebut']);
    $sth->bindParam("lundiFin", $input['lundiFin']);
    $sth->bindParam("mardiDebut", $input['mardiDebut']);
    $sth->bindParam("mardiFin", $input['mardiFin']);
    $sth->bindParam("mercrediDebut", $input['mercrediDebut']);
    $sth->bindParam("mercrediFin", $input['mercrediFin']);
    $sth->bindParam("jeudiDebut", $input['jeudiDebut']);
    $sth->bindParam("jeudiFin", $input['jeudiFin']);
    $sth->bindParam("vendrediDebut", $input['vendrediDebut']);
    $sth->bindParam("vendrediFin", $input['vendrediFin']);
    $sth->bindParam("samediDebut", $input['samediDebut']);
    $sth->bindParam("samediFin", $input['samediFin']);
    $sth->bindParam("dimancheDebut", $input['dimancheDebut']);
    $sth->bindParam("dimancheFin", $input['dimancheFin']);
    $sth->execute();
    return $this->response->withJson($input);
});

// Ajout d'un logiciel
$app->post('/logiciel', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `logiciel`(`designation`, `reference`, `licence`, `quantite`, `idmagasin`) 
            VALUES (:designation, :reference, :licence, :quantite, :idmagasin);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("designation", $input['designation']);
    $sth->bindParam("reference", $input['reference']);
    $sth->bindParam("licence", $input['licence']);
    $sth->bindParam("quantite", $input['quantite']);
    $sth->bindParam("idmagasin", $input['idmagasin']);
    $sth->execute();
    return $this->response->withJson($input);
});

// Ajout d'un serveur
$app->post('/serveur', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `serveur`(`designation`, `reference`, `numeroserie`, `quantite`, `idmagasin`) 
            VALUES (:designation, :reference, :numeroserie, :quantite, :idmagasin);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("designation", $input['designation']);
    $sth->bindParam("reference", $input['reference']);
    $sth->bindParam("numeroserie", $input['numeroserie']);
    $sth->bindParam("quantite", $input['quantite']);
    $sth->bindParam("idmagasin", $input['idmagasin']);
    $sth->execute();
    return $this->response->withJson($input);
});

// Ajout d'un serveur
$app->post('/tpv', function ($request, $response) {
    $input = $request->getParsedBody();
    $sql = "INSERT INTO `tpv`(`designation`, `reference`, `numeroserie`, `quantite`, `idmagasin`) 
            VALUES (:designation, :reference, :numeroserie, :quantite, :idmagasin);";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("designation", $input['designation']);
    $sth->bindParam("reference", $input['reference']);
    $sth->bindParam("numeroserie", $input['numeroserie']);
    $sth->bindParam("quantite", $input['quantite']);
    $sth->bindParam("idmagasin", $input['idmagasin']);
    $sth->execute();
    return $this->response->withJson($input);
});
// FIN POST

// DEBUT PUT
// Modification d'un magasin
$app->put('/magasin/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `magasin` SET `dateajout`= :dateajout,
                                 `enseigne`= :enseigne,
                                 `site`= :site,
                                 `adresse`= :adresse,
                                 `ville`= :ville,
                                 `CP`= :CP,
                                 `responsable`= :responsable,
                                 `telephone`= :telephone,
                                 `contact`= :contact,
                                 `fax`= :fax,
                                 `caisses`= :caisses,
                                 `nombre`= :nombre,
                                 `telemaintenance`= :telemaintenance,
                                 `lundiDebut`= :lundiDebut,
                                 `lundiFin`= :lundiFin,
                                 `mardiDebut`= :mardiDebut,
                                 `mardiFin`= :mardiFin,
                                 `mercrediDebut`= :mercrediDebut,
                                 `mercrediFin`= :mercrediFin,
                                 `jeudiDebut`= :jeudiDebut,
                                 `jeudiFin`= :jeudiFin,
                                 `vendrediDebut`= :vendrediDebut,
                                 `vendrediFin`= :vendrediFin,
                                 `samediDebut`= :samediDebut,
                                 `samediFin`= :samediFin,
                                 `dimancheDebut`= :dimancheDebut,
                                 `dimancheFin`= :dimancheFin 
                                WHERE `id`=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("dateajout", $input['dateajout']);
    $sth->bindParam("enseigne", $input['enseigne']);
    $sth->bindParam("site", $input['site']);
    $sth->bindParam("adresse", $input['adresse']);
    $sth->bindParam("ville", $input['ville']);
    $sth->bindParam("CP", $input['CP']);
    $sth->bindParam("responsable", $input['responsable']);
    $sth->bindParam("telephone", $input['telephone']);
    $sth->bindParam("contact", $input['contact']);
    $sth->bindParam("fax", $input['fax']);
    $sth->bindParam("caisses", $input['caisses']);
    $sth->bindParam("nombre", $input['nombre']);
    $sth->bindParam("telemaintenance", $input['telemaintenance']);
    $sth->bindParam("lundiDebut", $input['lundiDebut']);
    $sth->bindParam("lundiFin", $input['lundiFin']);
    $sth->bindParam("mardiDebut", $input['mardiDebut']);
    $sth->bindParam("mardiFin", $input['mardiFin']);
    $sth->bindParam("mercrediDebut", $input['mercrediDebut']);
    $sth->bindParam("mercrediFin", $input['mercrediFin']);
    $sth->bindParam("jeudiDebut", $input['jeudiDebut']);
    $sth->bindParam("jeudiFin", $input['jeudiFin']);
    $sth->bindParam("vendrediDebut", $input['vendrediDebut']);
    $sth->bindParam("vendrediFin", $input['vendrediFin']);
    $sth->bindParam("samediDebut", $input['samediDebut']);
    $sth->bindParam("samediFin", $input['samediFin']);
    $sth->bindParam("dimancheDebut", $input['dimancheDebut']);
    $sth->bindParam("dimancheFin", $input['dimancheFin']);
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('modifié');
});

// Modification d'un logiciel
$app->put('/logiciel/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `logiciel` SET `designation`= :designation,
                                 `reference`= :reference,
                                 `licence`= :licence,
                                 `quantite`= :quantite
                                WHERE `id`=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("designation", $input['designation']);
    $sth->bindParam("reference", $input['reference']);
    $sth->bindParam("licence", $input['licence']);
    $sth->bindParam("quantite", $input['quantite']);
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('modifié');
});

// Modification d'un serveur
$app->put('/serveur/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `serveur` SET `designation`= :designation,
                                 `reference`= :reference,
                                 `numeroserie`= :numeroserie,
                                 `quantite`= :quantite
                                WHERE `id`=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("designation", $input['designation']);
    $sth->bindParam("reference", $input['reference']);
    $sth->bindParam("numeroserie", $input['numeroserie']);
    $sth->bindParam("quantite", $input['quantite']);
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('modifié');
});

// Modification d'un tpv
$app->put('/tpv/[{id}]', function ($request, $response, $args) {
    $input = $request->getParsedBody();
    $sql = "UPDATE `tpv` SET `designation`= :designation,
                                 `reference`= :reference,
                                 `numeroserie`= :numeroserie,
                                 `quantite`= :quantite
                                WHERE `id`=:id";
    $sth = $this->db->prepare($sql);
    $sth->bindParam("designation", $input['designation']);
    $sth->bindParam("reference", $input['reference']);
    $sth->bindParam("numeroserie", $input['numeroserie']);
    $sth->bindParam("quantite", $input['quantite']);
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('modifié');
});
// FIN PUT

// DEBUT DELETE
// Suppression magasin
$app->delete('/magasin/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM `magasin` WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('Supprimé');
});

// Suppression logiciel
$app->delete('/logiciel/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM `logiciel` WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('Supprimé');
});

// Suppression serveur
$app->delete('/serveur/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM `serveur` WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('Supprimé');
});

// Suppression tpv
$app->delete('/tpv/[{id}]', function ($request, $response, $args) {
    $sth = $this->db->prepare("DELETE FROM `tpv` WHERE id=:id");
    $sth->bindParam("id", $args['id']);
    $sth->execute();
    return $this->response->write('Supprimé');
});
// FIN DELETE