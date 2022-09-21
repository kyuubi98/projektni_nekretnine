
<?php

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
                            <a class="nav-link" href="porudzbine.php">Razgledanja</a>
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
   <div class="row">
   <div class="col-lg-12">
      <h1>Dostupne nekretnine</h1>
    </div>
    <div class="col-lg-6">
      <label for="minP">Minimum kvadrata</label>
      <input type="text" id="minP" value="0" class="form-control" onkeyup="showHint(this.value)">
      <p>Primer: <span id="txtHint"></span></p>
     </div>
     <div class="col-lg-6">
       <label for="maxP">Maksimum kvadrata</label>
       <input type="text" id="maxP" value="100" class="form-control">
      </div>
      <div class="col-lg-12">
        <label for="sortiranje">Sortiraj po ceni</label>
        <select id="sortiranje" class="form-control">
          <option value="asc">Rastuće po ceni</option>
          <option value="desc"> Opadajuće po ceni</option>
        </select>
      </div>
      <div class="col-lg-12">
        <label for="pretrazi"></label>
        <input type="button" id="pretrazi" style="background-color: #555;" value="Pretraži" class="form-control btn-primary" onclick="pretrazi()">
       </div>
       <div id="rezultatPretrage"></div>

  </div>
<?php include 'futer.php'; ?>
</div>

<script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jssor.js" type="text/javascript"></script>
<script src="js/jssor.slider.js" type="text/javascript"></script>
<script src="js/slider.js" type="text/javascript"></script>

<script>
  function pretrazi(){
    $.ajax({
      url: "pretraga.php",
      data: {sort: $("#sortiranje").val(), min: $("#minP").val() , max: $("#maxP").val()},
      success: function(html){
        $("#rezultatPretrage").html(html);
      }
      });
  }

function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    }
    xmlhttp.open("GET", "gethint.php?q="+str, true);
    xmlhttp.send();
  }
}
</script>


</script>
</body>
</html>
