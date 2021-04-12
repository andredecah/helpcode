<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
<meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/styledati3.css" rel="stylesheet">

<style>
table{
  text-align:center;
  width:20%;

}

th,td{
  border: 1px solid black;
  height:40px;
}

</style>
</head>


<body>

 <!-- ======= Header ======= -->
 <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="https://uli.it/"><img src="assets/img/logoULI.png" alt=""></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Bell</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="visualizzaDati.php">Visualizza Dati</a></li>
          <li><a href="Export.php">Scarica</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="https://twitter.com/uli_seveso"><i class="fa fa-twitter"></i></a> <a href="https://it-it.facebook.com/UtilityLineItalia"><i class="fa fa-facebook"></i></a> <a href="https://it.linkedin.com/company/utility-line-italia"><i class="fa fa-linkedin"></i></a> <a href="#contact"><i class="fa fa-envelope"></i></a>
      </nav>
    </div>
  </header><!-- End Header -->

  </main><!-- End #main -->

  <!-- QUERY -->

  <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "dbfinale";

    $conn = new mysqli($servername, $username, $password, $dbName);
    if ($conn->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }


    if(isset($_POST["cerca"]))
    {
        $sql = "SELECT * FROM `prova`";
        
        $regione = $_POST["regione"];
        $provincia = $_POST["provincia"];
        $comune = $_POST["comune"];
        $area = $_POST["area"];

        $params = [];
        
        if(!empty($regione))
        {
            $params[] = "REGIONE = '".$regione."'";
        }

        if(!empty($provincia))
        {
            $params[] = "PROVINCIA LIKE '%".$provincia."%'";
        }

        if(!empty($comune))
        {
            $params[] = "DESCRIZIONECOMUNE LIKE '%".$comune."%'";
        }

        if(!empty($area))
        {
            $params[] = "AREAGEOGRAFICA = '".$area."'";
        }
        
        foreach($params as $i)
        {
            echo $i;
        }
        
        if (count($params) > 0)
        {
            $sql = "SELECT * FROM `prova` WHERE ";
            
            foreach($params as $param)
            {
                $sql .= $param." AND ";
            }
            
            $sql = substr($sql,0,-4);
        }
        $result = $conn->query($sql);
        
        if ($result === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $rows = [];
        
        while($row = $result->fetch_assoc())
        {
            $rows[] = $row;
        }
        
        $_SESSION["result"] = $rows;
        
        header("Location: visualizzaFiltri.php");
        
        exit();
    }

?>


</body>
</html>
<?php
/*$conn = new mysqli("localhost","root","","dbFinale");

$risultatiperpage=25;

if(isset($_GET['page'])){
  if($_GET['page']>1){
    $start=($_GET['page']-1)*$risultatiperpage;
  }else{
  $start=0;
}
}else{
  $start=0;
}
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$sql=$conn->query("SELECT COUNT(*) as conteggio from prova");
$array=$sql->fetch_assoc();
$totalerighe=$array['conteggio'];
$pages=ceil($totalerighe/$risultatiperpage);
$query=$conn->query("SELECT * FROM prova LIMIT ".$start.",".$risultatiperpage);
$Previous = $page - 1;
$Next = $page + 1;*/
?>

<!--<html>
<head>
</head>
<body>
<table class="responsive">
<thead>
<th>
Id
</th>
<th>
A.S
</th>
<th>
AreaGeografica
</th>
<th>
REGIONE
</th>
<th>
PROVINCIA
</th>
<th>
CODICEISTITUTO
</th>
<th>
DENOMINAZIONE
</th>
<th>
CODICESCUOLA
</th>
<th>
NOMINATIVO
</th>
<th>
INDIRIZZO
</th>
<th>
CAP
</th>
<th>
CODCOMUNE
</th>
<th>
COMUNE
</th>
<th>
CARATTERISTICASCUOLA
</th>
<th>
GRADOSCUOLA
</th>
<th>
SEDEDIRETTIVO
</th>
<th>
OMNICOMPRENSIVO
</th>
<th>
EMAIL
</th>
<th>
PEC
</th>
<th>
SITOWEB
</th>
<th>
SEDE
</th>
</thead>
<tbody>-->
<?php
  /*while($riga=$query->fetch_assoc())
  echo "<tr><td>".$riga['id']."</td><td>".$riga['ANNOSCOLASTICO']."</td><td>".$riga['AREAGEOGRAFICA']."</td><td>".$riga['REGIONE']."</td><td>".$riga['PROVINCIA']."</td><td>".$riga['CODICEISTITUTORIFERIMENTO']."</td><td>".$riga['DENOMINAZIONEISTITUTORIFERIMENTO']."</td><td>".$riga['CODICESCUOLA']."</td><td>".$riga['DENOMINAZIONESCUOLA']."</td><td>".$riga['INDIRIZZOSCUOLA']."</td><td>".$riga['CAPSCUOLA']."</td><td>".$riga['CODICECOMUNESCUOLA']."</td><td>".$riga['DESCRIZIONECOMUNE']."</td><td>".$riga['DESCRIZIONECARATTERISTICASCUOLA']."</td><td>".$riga['DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA']."</td><td>".$riga['INDICAZIONESEDEDIRETTIVO']."</td><td>".$riga['INDICAZIONESEDEOMNICOMPRENSIVO']."</td><td>".$riga['INDIRIZZOEMAILSCUOLA']."</td><td>".$riga['INDIRIZZOPECSCUOLA']."</td><td>".$riga['SITOWEBSCUOLA']."</td><td>".$riga['SEDESCOLASTICA']."</td></tr>";
  ?>
  </tbody>
  </table>
  <nav aria-label="Page navigation">
					<ul class="pagination">
				    <li>
				      <a href="visualizzaDati.php?page=<?= $Previous; ?>" aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
				    <li>
				      <a href="visualizzaDati.php?page=<?= $Next; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
</body>
  </html>
  <html>
  <head>
  </head>
  <body>
  <!-- ======= Contact Section ======= -->
<section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2 class="section-title">Contact Us</h2>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-3 col-md-4">
            <div class="info">
              <div>
                <i class="fa fa-map-marker"></i>
                <p>Via Mezzera, 29/a<br>20822 Seveso (MB)</p>
              </div>

              <div>
                <i class="fa fa-envelope"></i>
                <p>assistenza@uli.com</p>
              </div>

              <div>
                <i class="fa fa-phone"></i>
                <p>+39 0362 540538</p>
              </div>

            </div>
          </div>


        </div>
      </div>
    </section><!-- End Contact Section -->
    </body>
    </html>*/