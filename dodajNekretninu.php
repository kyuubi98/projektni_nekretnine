
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
                            <a class="nav-link" href="razgledanja.php">Razgledanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="izmeniRazgledanje.php">Dodaj detalje terminu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dodajNekretninu.php">Dodaj nekretninu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="listaNekretnina.php">Lista nekretnina</a>
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
      <h3 class="text-center">Unos nekretnina</h3>
            <form method="POST" action="restful/nekretnine">
                <input type="text" placeholder="Unesi adresu" class="form-control" name="adresa">
                <br>
                <input type="text" placeholder="Unesi opis" class="form-control" name="opis">
                <br>
                <input type="number" placeholder="Unesi kvadraturu" class="form-control" name="kvadratura">
                <br>
                <input type="number" placeholder="Unesi cenu" class="form-control" name="cena">
                <br>
                <input type="submit" style="background-color: #868B8E; color: black;" class="form-control btn-primary" name="unosNekretnine" value="Unesi nekretninu">
            </form>
            <h4 id="msgPost" class="text-center"></h4>
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
   $(':input[name=unosNekretnine]').click(function() {
                // process the form
                $("form").submit(function(event) {

                    // get the form data
                    // there are many ways to get this data using jQuery (you can use the class or id also)
                    var formData = {
                        'adresa'  : $(':input[name=adresa]').val(),
                        'opis'  : $(':input[name=opis]').val(),
                        'cena'   : $(':input[name=cena]').val(),
                        'kvadratura'    : $(':input[name=kvadratura]').val()
                    };
                    
                    $.ajax({
                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url         : 'restful/nekretnine', // the url where we want to POST
                        data        : JSON.stringify(formData), // our data object
                        dataType    : 'json', // what type of data do we expect back from the server
                        encode      : true,
                        contentType: "application/json; charset=UTF-8"
                    }).done(function(data) {
                        $('#msgPost').html(data.poruka); 
                    });
                    
                    // stop the form from submitting the normal way and refreshing the page
                    event.preventDefault();
                });
            });
</script>


</body>
</html>
