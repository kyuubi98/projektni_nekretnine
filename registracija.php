
<?php
    include 'init.php';
    $poruka = "";
    if (isset($_POST['registracija'])) {
        $ime = $mysqli->real_escape_string(trim($_POST['ime']));
        $email = $mysqli->real_escape_string(trim($_POST['email']));
        $password = $mysqli->real_escape_string(trim($_POST['password']));

        $korisnik = new Korisnik();
        $korisnik->ime_prezime = $ime;
        $korisnik->email = $email;
        $korisnik->sifra = $password;

        if ($korisnik->save($mysqli)) {
            $poruka ="Uspesno ste se registrovali";
        } else {
            $poruka ="Neuspesno ste se registrovali";
        }
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
                            <a class="nav-link" href="porudzbine.php">Razgledanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="izvestaj.php">Izvestaj</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Izloguj se</a>
                    </li>
                      <?php 
                        } 
                        if ($_SESSION['ulogovaniKorisnik']->uloga == 'kupac') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="zakazi.php">Zakazi razgledanje</a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link" href="logout.php">Izloguj se</a>
                    </li>
                        <?php } ?>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Uloguj se</a>
                    </li>

                    <?php } ?>
                </ul>
              </div>

        </nav>
    </div>
</header>
<?php include 'slajder.php'; ?>

<div class="container">

  <h3 class="text-center">Registraciona forma</h3>
    <form method= "POST" action="">
            <input type="username" class="form-control" type="text" align="center" placeholder="Name" id="ime" name="ime">
            <br>
            <input type="email" class="form-control" type="text" align="center" placeholder="Username" id="email" name="email">
            <br>
            <input type="password" class="form-control" type="password" align="center" placeholder="Password" id="password" name="password">
            <br>
           <input style="background-color: #868B8E; color: black;" lass="submit" align="center" type="submit" name="registracija" value="Sign in" class="form-control btn-primary" id="registracija">
          </form>      
    </div>
  <br>
  <br>
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
