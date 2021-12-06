<?php 
  require_once("konf.php"); 
  session_start();
  function isAdmin() {
    return $_SESSION["onAdmin"] == 1;
  }
  if(!empty($_REQUEST["vormistamine_id"])){
    $kask=$yhendus->prepare(
	  "UPDATE jalgrattaeksam SET luba=1 WHERE id=?");
	$kask->bind_param("i", $_REQUEST["vormistamine_id"]);
	$kask->execute();
  }
  $kask=$yhendus->prepare(
    "SELECT id, eesnimi, perekonnanimi, teooriatulemus, 
	     slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;");
  $kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus, 
        $slaalom, $ringtee, $t2nav, $luba);
  $kask->execute();
  
  function asenda($nr){
    if($nr==-1){return "-";} //tegemata
    if($nr== 1){return "korras";}	
    if($nr== 2){return "ebaõnnestunud";}	
	return "Tundmatu number";
  }
?>
<!doctype html>
<html>
  <head>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
  <link rel="stylesheet" href="css/styleEx.css">

    <title>Lõpetamine</title>
  </head>
  <body>
  <header class="header">
  <?php
    include 'nav.php';
     ?>
    <h1>Lõpetamine</h1>
    </header>
    <main class="container lubadeleht">
    <table>
	  <tr>
	    <th class='nimitabelis2'>Eesnimi</th>
	    <th class='nimitabelis2'>Perekonnanimi</th>
	    <th class='nimitabelis2'>Teooriaeksam</th>
	    <th class='nimitabelis2'>Slaalom</th>
	    <th class='nimitabelis2'>Ringtee</th>
	    <th class='nimitabelis2'>Tänavasõit</th>
	    <th class='nimitabelis2'>Lubade väljastus</th>
	  </tr>
	  <?php
	      
	    while($kask->fetch()){
		   $asendatud_slaalom=asenda($slaalom);
		   $asendatud_ringtee=asenda($ringtee);
		   $asendatud_t2nav=asenda($t2nav);
		   $loalahter="-";
		   if($luba==1){$loalahter="<p class='p-korras'>Väljastatud</p>";}
		   if($luba==-1 and $t2nav==1 and isAdmin()){
		     $loalahter="<a class='korras' href='?vormistamine_id=$id'>Vormista load</a>";
		   }
		   echo "
		     <tr>
			   <td>$eesnimi</td>
			   <td>$perekonnanimi</td>
			   <td>$teooriatulemus</td>
			   <td>$asendatud_slaalom</td>
			   <td>$asendatud_ringtee</td>
			   <td>$asendatud_t2nav</td>
			   <td>$loalahter</td>
			 </tr>
		   ";
	}
	  ?>
	</table>
    </main>
    <footer class="footer2">
    <p class="footer-text">
    © 2021 Copyright. Valeria Novak
    </p>
</footer>
  </body>
</html>
