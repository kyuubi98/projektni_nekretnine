<?php


class Razgledanje
{
    public $id;
    public $agent;
    public $kupac;
    public $nekretnina;
    public $razgledanje;
    public $datum;

    public function vratiSve($mysqli)
    {
        $sql = "SELECT r.*, a.ime_prezime AS agent, k.ime_prezime AS kupac, n.adresa, n.opis, n.cena, n.kvadratura
                FROM razgledanje r 
                LEFT JOIN korisnik a ON r.id_agent=a.id 
                LEFT JOIN korisnik k ON r.id_kupac=k.id
                LEFT JOIN nekretnina n ON r.id_nekretnina=n.id";
        if (isset($this->agent->id)) {
            $sql .= " WHERE r.id_agent=" . $this->agent->id;
        }
        $sql .= " ORDER BY r.razgledanje ASC";
        $rezultat = $mysqli->query($sql);
        if( !$rezultat)
        die($mysqli->error);

        $nizRazgledanja = [];
        while ($red = $rezultat->fetch_object()) {
            $agent = new Korisnik();
            $agent->id = $red->id_agent;
            $agent->ime_prezime = $red->agent;
            
            $kupac = new Korisnik();
            $kupac->id = $red->id_kupac;
            $kupac->ime_prezime = $red->kupac;            
            
            $nekretnina = new Nekretnina();
            $nekretnina->adresa = $red->adresa;
            $nekretnina->opis = $red->opis;
            $nekretnina->kvadratura = $red->kvadratura;
            $nekretnina->cena = $red->cena;

            $razgledanje = new Razgledanje();
            $razgledanje->id = $red->id;
            $razgledanje->agent = $agent;
            $razgledanje->kupac = $kupac;
            $razgledanje->nekretnina = $nekretnina;
            $razgledanje->razgledanje = $red->razgledanje;
            $razgledanje->datum = $red->datum;
            
            $nizRazgledanja[] = $razgledanje;
        }
        return $nizRazgledanja;
    }
}
