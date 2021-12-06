<?php 
  require_once("konf.php"); 
  session_start();
if (!isset($_SESSION['tuvastamine'])) {
    header('Location: ab_login.php');
    exit();
}
  if(isSet($_REQUEST["sisestusnupp"])){
    $kask=$yhendus->prepare(
        "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
	$kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
	$kask->execute();
	$yhendus->close();
	header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
	exit();
  }
  function isTava() {
    return $_SESSION["onAdmin"] == 0;
  }
?>
<!doctype html>
<html>
  <head>
  <link rel="stylesheet" href="css/styleEx.css">
     <title>Kasutaja registreerimine</title>
  </head>
  <body>
  <header class="header">
  <?php
    include 'nav.php';
     ?>
    <h1>Registreerimine</h1>
    </header>
    <main class="container">
    <div class="login-box">
    <?php
    if( isTava()) {
	  if(isSet($_REQUEST["lisatudeesnimi"])){
	   echo "<p class='lisanimi'>Lisati - $_REQUEST[lisatudeesnimi]</p>";
	  }
    ?>
	<form action="?">
	  <dl>
		<dd><input class="textbox" type="text" name="eesnimi" placeholder="Eesnimi"/></dd>
		<dd><input class="textbox" type="text" name="perekonnanimi" placeholder="Perekonnanimi"/></dd>
	    <dt><input type="submit" class="nupp" name="sisestusnupp" value="sisesta" /></dt>
	  </dl>
	</form>
    </div>
    </main>
    <?php
    include 'footer.php';
    } else {
        echo '<p class="warn">Te olete õpetaja. Registreerimine on ainult õpilaste jaoks!</p>';
    }
     ?>
  </body>
</html>
