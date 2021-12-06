<nav class="nav">
    <div class="logo">
        <img src="img/bucycle.png" alt="NOPR!">
    </div>
    <form action="logout.php" method="post">
                            <p class="adm"><span><?=$_SESSION["kasutaja"]?></span> on sisse logitud</p>
                            <br>
                            <input type="submit" id="adm-btn" value="LOGI VÄLJA" name="logout">
                           
                        </form>
          <ul class="nav__menu">
              <li class="nav__item nav_linkss"><a class="nav__link" href="registreerimine.php">Registreerimine</a></li>
              <li class="nav__item nav_linkss"><a class="nav__link" href="teooriaeksam.php">Teooriaeksam</a></li>
              <li class="nav__item nav_linkss"><a class="nav__link" href="slaalom.php">Slaloom</a></li>
              <li class="nav__item nav_linkss"><a class="nav__link" href="ringtee.php">Ringtee</a></li>
              <li class="nav__item nav_linkss"><a class="nav__link" href="t2nav.php">Tänavasõit</a></li>
              <li class="nav__item nav_linkss"><a class="nav__link" href="lubadeleht.php">Lõpetamine</a></li>
          </ul>
      </nav>