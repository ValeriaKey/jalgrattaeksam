<?php 
  require_once("konf.php");
  session_start();
  function isAdmin() {
    return $_SESSION["onAdmin"] == 1;
  }
  if(!empty($_REQUEST["korras_id"])){
    $kask=$yhendus->prepare(
	  "UPDATE jalgrattaeksam SET ringtee=1 WHERE id=?");
	$kask->bind_param("i", $_REQUEST["korras_id"]);
	$kask->execute();
  }
  if(!empty($_REQUEST["vigane_id"])){
    $kask=$yhendus->prepare(
	  "UPDATE jalgrattaeksam SET ringtee=2 WHERE id=?");
	$kask->bind_param("i", $_REQUEST["vigane_id"]);
	$kask->execute();
  }
  $kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus>=9 AND ringtee=-1");
  $kask->bind_result($id, $eesnimi, $perekonnanimi);
  $kask->execute();
?>
<!doctype html>
<html>
  <head>
  <link rel="stylesheet" href="css/styleEx.css">
    <title>Ringtee</title>
  </head>
  <body>
    <header class="header">
  <?php
    include 'nav.php';
     ?>
    <h1>Ringtee</h1>
    </header>
    <main class="container">
    <table>
	  <?php
    if(isAdmin() ) {
	    while($kask->fetch()){
		  echo "
		    <tr>
			  <td class='nimitabelis'>$eesnimi</td>
			  <td class='nimitabelis'>$perekonnanimi</td>
			  <td>
			    <a class='korras' href='?korras_id=$id'>Korras</a>
			    <a class='ebaone' href='?vigane_id=$id'>Ebaõnnestunud</a>
			  </td>
			</tr>
		  ";
		}
  } else {
    echo '<p class="warn">Te olete <span>õpilane</span>, te saate ainult registreerida ja vaadata tulemusi</p>';
  }
	  ?>
	</table>
    </main>
    <?php
    include 'footer.php';
     ?>
  </body>
</html>
