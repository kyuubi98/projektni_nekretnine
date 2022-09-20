<?php
include 'db/konekcija.php';
include 'domen/Razgledanje.php';
include 'domen/Korisnik.php';
include 'domen/Nekretnina.php';

session_start();

if (!isset($_SESSION['ulogovaniKorisnik'])) {
    $_SESSION['ulogovaniKorisnik'] = null;
}
