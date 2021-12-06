<?php 
  require_once("konf.php"); 
  session_start();
  function isAdmin() {
    return $_SESSION["onAdmin"] == 1;
  }
  if(!empty($_REQUEST["teooriatulemus"])){
    $kask=$yhendus->prepare(
	  "UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
	$kask->bind_param("ii", $_REQUEST["teooriatulemus"], $_REQUEST["id"]);
	$kask->execute();
  }
  $kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi 
     FROM jalgrattaeksam WHERE teooriatulemus=-1");
  $kask->bind_result($id, $eesnimi, $perekonnanimi);
  $kask->execute();
?>
<!doctype html>
<html>
  <head>
  <link rel="stylesheet" href="css/styleEx.css">

    <title>Teooriaeksam</title>
  </head>
  <body>
  <header class="header">
  <?php
    include 'nav.php';
     ?>
    <h1>Teooriaeksam</h1>
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
			  <td><form action=''>
			         <input type='hidden' name='id' value='$id' />
					 <input type='text' class='textbox2' name='teooriatulemus' />
					 <input type='submit' class='nupp2' value='Sisesta tulemus' />
			      </form>
			  </td>
			</tr>
		  ";
		}
  } else {
    echo '<p class="warn">Te olete <b>õpilane</b>, te saate ainult registreerida ja vaadata tulemusi</p>';
  }
	  ?>
	</table>
    </main>
    <?php
    include 'footer.php';
     ?>
  </body>
</html>

