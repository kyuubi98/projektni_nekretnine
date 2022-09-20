
<?php

include 'init.php';

if (!isset($_SESSION['ulogovaniKorisnik']) || empty($_SESSION['ulogovaniKorisnik'])) {
    header('location: login.php');
    exit;
}

$agent = $_SESSION['ulogovaniKorisnik'];

if ($agent->uloga == "kupac") {
    header('location: logout.php');
    exit;
}

$kupac = new Korisnik();
$nizAgenata = $kupac->vratiSveAgente($mysqli);

$nekretnina = new Nekretnina();
$nizNekretnina = $nekretnina->vratiSve($mysqli);

$razgledanje = new Razgledanje();
$nizRazgledanja = $razgledanje->vratiSve($mysqli);
?>

?>
<!DOCTYPE HTML>
<html lang="en-gb" class="no-js">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ekskluzivne nekretnine</title>
<meta name="description" content="">
<meta name="author" content="Satovi Andrejevic">

<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/styles.css" />
<link rel="stylesheet" href="css/style-animate.css" />
<link href="font/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/slider.css">
<link rel="stylesheet" type="text/css" href="css/custom.css">

</head>

<body style="background-color: black;>


<header class="header">
  <div class="container">
      <nav class="navbar navbar-inverse" role="navigation">
          <div class="navbar-header">
              <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a href="index.php" class="navbar-brand scroll-top logo animated bounceInLeft rollIn"><b><i>Ekskluzivne nekretnine</i></b></a></div>
              <div id="main-nav" class="collapse navbar-collapse">
                <ul class="nav navbar-nav" id="mainNav">
                  <?php
                  if ($_SESSION['ulogovaniKorisnik'] != null) {
                      if ($_SESSION['ulogovaniKorisnik']->uloga == 'agent') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="obrisi.php">Obrisi razgledanje</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="izmeniRazgledanje.php">Dodaj detalje terminu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listaNekretnina.php">Nekretnine</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Izloguj se</a>
                    </li>
                      <?php 
                        } 
                        if ($_SESSION['ulogovaniKorisnik']->uloga == 'kupac') { ?>

                <li class="nav-item">
                        <a class="nav-link" href="logout.php">Izloguj se</a>
                    </li>
                        <?php } ?>
                    <?php } else { ?>
                    <li class="nav-item">
                    </li>

                    <?php } ?>
                </ul>
              </div>

        </nav>
    </div>
</header>
<?php include 'slajder.php'; ?>

<div class="container">
   <h3 class="text-center">Pregled</h3>
            <br>
            <table id="tabelaRazgledanja" class="table table-hover">
              <input id="myInput" type="text" style="color: black"  placeholder="Search..">
                <thead>
                    <tr>
                        <th onclick="sortTable(1)">Kupac</th>
                        <th onclick="sortTable(2)">Adresa</th>
                        <th onclick="sortTable(3)">Opis</th>
                        <th onclick="sortTable(4)">Kvadratura</th>
                        <th onclick="sortTable(5)">Cena</th>
                        <th onclick="sortTable(6)">Detalji</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($nizRazgledanja as $rez) {
                        ?>
                        <tr>
                            <td><?= $rez->kupac->ime_prezime ?></td>
                            <td><?= $rez->nekretnina->adresa  ?></td>
                            <td><?= $rez->nekretnina->opis  ?></td>
                            <td><?= $rez->nekretnina->kvadratura  ?></td>
                            <td><?= $rez->nekretnina->cena  ?></td>
                            <td><?= $rez->razgledanje ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
<?php include 'futer.php'; ?>
</div>

<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jssor.js" type="text/javascript"></script>
<script src="js/jssor.slider.js" type="text/javascript"></script>
<script src="js/slider.js" type="text/javascript"></script>

<script>
  function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("tabelaRazgledanja");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

            $(document).ready(function(){
            $("#myInput").on("keyup", function() {
              var value = $(this).val().toLowerCase();
                $("#tabelaRazgledanja tr").filter(function() {
                 $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                   });
                });
              });

           
        </script>
</script>


</script>
</body>
</html>
