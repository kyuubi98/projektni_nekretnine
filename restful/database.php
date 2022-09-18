<?php
class Database
{
    private $hostname="localhost";
    private $username="root";
    private $password="";
    private $dbname="nekretnine";
    private $dblink; 
    private $result; 
    private $records; 
    private $affected; 

    public function __construct($dbname)
    {
        $this->dbname = $dbname;
        $this->Connect();
    }

    public function getResult()
    {
        return $this->result;
    }

    public function Connect()
    {
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if ($this->dblink ->connect_errno) {
            printf("Konekcija neuspešna: %s\n", $mysqli->connect_error);
            exit();
        }
        $this->dblink->set_charset("utf8");
    }


    public function selectRazgledanja($id = null)
    {
        $sql = "SELECT r.*, a.ime_prezime AS agent, k.ime_prezime AS kupac, n.adresa, n.opis, n.kvadratura , n.cena
                FROM razgledanje r 
                LEFT JOIN korisnik a ON r.id_agent=a.id 
                LEFT JOIN korisnik k ON r.id_kupac=k.id
                LEFT JOIN nekretnina n ON r.nekretnina=n.id";
                
        if ($id != null) {
            $sql .= " WHERE r.id=" . $id;
        }
        $sql .= " ORDER BY r.id";
        $this->ExecuteQuery($sql);
    }
    
    public function insertNekretnina($adresa, $opis, $cena, $kvadratura)
    {
        $insert = "INSERT INTO nekretnina(id, adresa, opis, cena, kvadratura) VALUES (null,'$adresa','$opis',$cena,$kvadratura)";

        if ($this->ExecuteQuery($insert)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateRazgledanja($id, $razgledanje)
    {
        $datum = date("Y-m-d");
        $update = "UPDATE razgledanje SET razgledanje = '$razgledanje', datum = '$datum' WHERE id = $id";
        if (($this->ExecuteQuery($update)) && ($this->affected >0)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteRazgledanja($id)
    {
        $delete = "DELETE FROM razgledanje WHERE id = $id";
        if ($this->ExecuteQuery($delete)) {
            return true;
        } else {
            return false;
        }
    }

    public function ExecuteQuery($query)
    {
        if ($this->result = $this->dblink->query($query)) {
            if (isset($this->result->num_rows)) {
                $this->records         = $this->result->num_rows;
            }
            if (isset($this->dblink->affected_rows)) {
                $this->affected        = $this->dblink->affected_rows;
            }
            // echo "Uspesno izvrsen upit";
            return true;
        } else {
            return false;
        }
    }
}
