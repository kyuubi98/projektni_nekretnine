
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

?>
<!DOCTYPE HTML>
<html lang="en-gb" class="no-js">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ekskluzivne nekretnine</title>
<meta name="description" content="">
<meta name="author" content="Nekretnine Matako">

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
                            <a class="nav-link" href="razgledanja.php">Razgledanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="izmeniRazgledanje.php">Dodaj detalje o terminu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dodajNekretninu.php">Dodaj nekretninu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="izvestaj.php">Izveštaj</a>
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
      <div class="container">
        <br>
      <h2>Spisak nekretnina</h2>
      <table id="my-example" style="color: black">
        <thead>
          <tr>
          <th style="color: white;">Adresa</th>
          <th style="color: white;">Opis</th>
          <th style="color: white;">Kvadratura</th>
          <th style="color: white;">Cena</th>
         </tr>
    </thead>
  </table>
  <br>
   <div class="main">
                    <iframe src="http://www.kursna-lista.info/resources/kursna-lista.php?format=4&br_decimala=4&promene=1&procenat=1" width="325px" height="225px" frameborder="0" scrolling="no"></iframe>
        </div>
      </div>
    <br>
<?php include 'futer.php'; ?>
</div>

<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jssor.js" type="text/javascript"></script>
<script src="js/jssor.slider.js" type="text/javascript"></script>
<script src="js/slider.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#my-example').dataTable({
        "bProcessing": true,
        "sAjaxSource": "pro.php",
        "aoColumns": [
              { mData: 'adresa' } ,
              { mData: 'opis' },
              { mData: 'kvadratura' },
              { mData: 'cena' }
            ]
      });  
  });
</script>
<style type="text/css">
  /* div koji sadrzi tabelu */
#kl-container {
    font-size:12px;
    text-align:center;
    margin:10px;
}

/* tabela kursne liste */
#kl-table {
    margin:10px auto;
}

a {
    text-decoration:none;
    color:white;
}
a:hover {
    border-bottom: 1px dashed white;
}

#kl-table td {
    padding:3px;
}

/* klasa linka oznake valute */
.code_link {

}

/* celija koja sadrzi kurs */
.td_rate {
    text-align:right;
    width:60px;
}

/* boja neparnog reda */
.rowcolor1 {
    background-color:#FFF;
}

/* boja parnog reda */
.rowcolor2 {
    background-color:#EFEFEF;
}

/* boje za promenu kurseva */
.green, .red, .yellow {
    text-align:right;
}
.green {
    color:#41A317;
}
.red {
    color:#FF0000;
    
}
.yellow {
    color:#F6CF2B;
}

.imenaKurseva {
    font-size:10px;
}  
</style>


</body>
</html>
