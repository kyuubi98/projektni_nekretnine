<?php
include 'db/konekcija.php';

include 'init.php';

if (!isset($_SESSION['ulogovaniKorisnik']) || empty($_SESSION['ulogovaniKorisnik'])) {
    header('location: login.php');
    exit;
}

$kupac = $_SESSION['ulogovaniKorisnik'];

if ($kupac->uloga == "agent") {
    header('location: logout.php');
    exit;
}

$sortiranje = $_GET['sort'];
$min = floatval($_GET['min']);
$max = floatval($_GET['max']);

$nekretnina = new Nekretnina();

$podaci = $nekretnina->vratiSortiraneNekretnine($mysqli,$sortiranje);

 ?>
<table class="table table-hover">
  <thead>
    <tr>
      <th>Adresa</th>
      <th>Opis</th>
      <th>Cena</th>
      <th>Kvadratura</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach($podaci as $nekretnine){
          if($nekretnine->kvadratura > $min && $nekretnine->kvadratura < $max){
            ?>
            <tr>
              <td><?php echo $nekretnine->adresa ?></td>
              <td><?php echo $nekretnine->opis?></td>
              <td><?php echo $nekretnine->cena ?> EUR</td>
              <td><?php echo $nekretnine->kvadratura ?></td>
              <td><a href="dodajRazgledanje.php?id=<?= $nekretnine->id ?>" class="btn btn-danger">Zakazi termin</a></td>
            </tr>
            <?php
          }
        }
    ?>
  </tbody>
</table>