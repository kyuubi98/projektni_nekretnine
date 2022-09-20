<?php

include 'init.php';
$id = $_GET['id'];

if (!isset($_SESSION['ulogovaniKorisnik']) || empty($_SESSION['ulogovaniKorisnik'])) {
    header('location: login.php');
    exit;
}

$kupac = $_SESSION['ulogovaniKorisnik'];

if ($kupac->uloga == "agent") {
    header('location: logout.php');
    exit;
}

$idKupac = $kupac->id;
$datum = date("Y-m-d");
$sql = "INSERT INTO razgledanje(id, id_agent, id_kupac, id_nekretnina, razgledanje, datum) VALUES (null,44,$idKupac,$id,null, 'datum')";

if ($mysqli->query($sql) === TRUE) {

    header("location: nekretnine.php");
} else {
    echo "err";
}

$mysqli->close();


?>