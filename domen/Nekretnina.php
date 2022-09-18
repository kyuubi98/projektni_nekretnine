<?php

class Nekretnina
{
    public $id;
    public $adresa;
    public $opis;
    public $cena;
    public $kvadratura;

    public function vratiSve($mysqli)
    {
        $sql = "SELECT * FROM nekretnina WHERE adresa LIKE '%" . $this->adresa . "%' ORDER BY adresa, opis ASC";
        $rezultat = $mysqli->query($sql);
        $nizNekretninaa = [];
        while ($red = $rezultat->fetch_object()) {
            $nekretnina = new Nekretnina();
            $nekretnina->id = $red->id;
            $nekretnina->adresa = $red->adresa;
            $nekretnina->opis = $red->opis;
            $nekretnina->cena = $red->cena;
            $nekretnina->kvadratura = $red->kvadratura;

            $nizNekretninaa[] = $nekretnina;
        }
        return $nizNekretninaa;
    }

    static function vratiSortiraneNekretnine($mysqli,$sort){
       $sql = "SELECT * FROM nekretnina n order by n.cena ".$sort;

       $rez = $mysqli->query($sql);

       $nizNekretninaa = [];
        while ($red = $rez->fetch_object()) {
            $nekretnina = new Nekretnina();
            $nekretnina->id = $red->id;
            $nekretnina->adresa = $red->adresa;
            $nekretnina->opis = $red->opis;
            $nekretnina->cena = $red->cena;
            $nekretnina->kvadratura = $red->kvadratura;

            $nizNekretninaa[] = $nekretnina;
        }
        return $nizNekretninaa;

     }
}
