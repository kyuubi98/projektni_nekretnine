<?php
require 'flight/Flight.php';
require 'jsonindent.php';
Flight::register('db', 'Database', array('nekretnine'));
$json_podaci = file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci);

Flight::route('/', function () {
    echo 'hello world!';
});

Flight::route('GET /razgledanja.json', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->selectRazgledanja();
    $niz = array();
    $i=0;
    while ($red=$db->getResult()->fetch_object()) {
        $niz[$i]["id"] = $red->id;
        $niz[$i]["razgledanje"] = $red->razgledanje;
        $niz[$i]["datum"] = $red->datum;
        $niz[$i]["cena"] = $red->cena;
        $niz[$i]["agent"] = $red->agent;
        $niz[$i]["kupac"] = $red->kupac;
        $niz[$i]["adresa"] = $red->adresa;
        $niz[$i]["opis"] = $red->opis;
        $i++;
    }

    $json_niz = json_encode($niz, JSON_UNESCAPED_UNICODE);
    echo indent($json_niz);
    return false;
});

Flight::route('GET /razgledanja/@id.json', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->selectRazgledanja($id);
    $red = $db->getResult()->fetch_object();
    $json_niz = json_encode($red, JSON_UNESCAPED_UNICODE);
    echo indent($json_niz);
    return false;
});

Flight::route('POST /nekretnine', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["poruka"] = "Niste prosledili podatke";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
        return false;
    } else {
        if (!property_exists($podaci, 'adresa')||
            !property_exists($podaci, 'opis')||
            !property_exists($podaci, 'cena')||
            !property_exists($podaci, 'kvadratura')) {
            $odgovor["poruka"] = "Niste prosledili korektne podatke";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->insertNekretnina($podaci->adresa, $podaci->opis, $podaci->cena, $podaci->kvadratura)) {
                $odgovor["poruka"] = "Nekretnina je uspesno uneta";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } else {
                $odgovor["poruka"] = "Došlo je do greške pri unosenju nekretnine.";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            }
        }
    }
});

Flight::route('PUT /razgledanja/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $podaci_json = Flight::get("json_podaci");
    $podaci = json_decode($podaci_json);
    if ($podaci == null) {
        $odgovor["poruka"] = "Niste prosledili podatke";
        $json_odgovor = json_encode($odgovor);
        echo $json_odgovor;
    } else {
        if (!property_exists($podaci, 'razgledanje')) {
            $odgovor["poruka"] = "Niste prosledili korektne podatke";
            $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
            echo $json_odgovor;
            return false;
        } else {
            if ($db->updateRazgledanja($id, $podaci->razgledanje)) {
                $odgovor["poruka"] = "Uspesno ste izmenili termin";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } else {
                $odgovor["poruka"] = "Došlo je do greške pri izmeni termina";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            }
        }
    }
});

Flight::route('DELETE /razgledanja/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    if ($db->deleteRazgledanja($id)) {
        $odgovor["poruka"] = "Termin je uspesno otkazan";
        $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    } else {
        $odgovor["poruka"] = "Došlo je do greške prilikom otkazivanja termina";
        $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
        echo $json_odgovor;
        return false;
    }
});


Flight::start();
