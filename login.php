<?php 

include 'init.php'; 

$poruka = "";
if(isset($_POST['login'])){
  $email = $mysqli->real_escape_string(trim($_POST['email']));
  $password = $mysqli->real_escape_string(trim($_POST['password']));

  $korisnik = new Korisnik();
  $korisnik->email = $email;
  $korisnik->sifra = $password;

  if($korisnik->login($mysqli)){
    $poruka ="Uspesno ste se ulogovali";
  }else{
    $poruka ="Neuspesno ste se ulogovali, proverite podatke";
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
                  <li><a href="registracija.php">Registruj se</a></li>
                  <?php
                  if ($_SESSION['ulogovaniKorisnik'] != null) {
                      if ($_SESSION['ulogovaniKorisnik']->uloga == 'agent') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="razgledanja.php">Razgledanja</a>
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
                    <a class="nav-link" href="nekretnine.php">Nekretnine</a>
                </li>
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
  <h3 class="text-center">Login forma</h3>

         <form method= "POST" action="">
           <label for="email">Email</label>
           <input type="email" name="email" class="form-control" id="email" name="email">
           <label for="password">Sifra</label>
           <input type="password" name="password" class="form-control" id="password" name="password">
           <br>
           <input style="background-color: #868B8E; color: black;" type="submit" name="login" value="Login" class="form-control btn-primary" id="login">
           <br>
           <br>
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



</script>
</body>
</html>
