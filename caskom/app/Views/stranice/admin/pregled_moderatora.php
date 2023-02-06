<!-- Marija Dobric 0417/18 -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('css/admin/pregled_moderatora.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('css/admin/meni.css'); ?>">



</head>
<body>
    <div id=broj4>
        <div id=main_left>
            <div id=ad23>
            <form name="pretragavesti" method="get"  action="<?= site_url("Admin/pregledmod") ?>" >
            <table class=table id=tabtab>
    <tr>
<?php
foreach ($sviM as $moderatori) {
    echo "<tr><td>{$moderatori->korisnicko_ime}</td></tr>";
  //  echo "<td>".anchor("$controller/Admin/{$Moderator->korisnicko_ime}", "Link")."</td></tr>";
}
?>
</table>
    

</div>

                </form>
        </div>
        <div id=main_right>
            <div id=main_right_left>
            <form name="deleteform", action="<?= site_url("Admin/delete_moderator") ?>" method="post">
                <h2>Ime:</h3>
             <input type="text" name='ime'class="polje_za_unos" placeholder="ime moderatora">
             <span style="color: red"><?php if(!empty($errors['ime'])) echo $errors['ime']; ?></span> 
                <h2>Prezime:</h3>
           <input type="text" name='prezime' class="polje_za_unos" placeholder="prezime moderatora">   
               
                <h2>e-mail adresa:</h3>
              <input type="text" name='e_mail' class="polje_za_unos" placeholder="e-mail adresa">
              <span style="color: red"><?php if(!empty($errors['e_mail'])) echo $errors['e_mail']; ?></span>
                <h2>Korisničko ime:</h3>
                 <input type="text" name='korisnicko_ime' class="polje_za_unos" placeholder="korisničko ime">
                 <span style="color: red"><?php if(!empty($errors['korisnicko_ime'])) echo $errors['korisnicko_ime']; ?></span>
                 <?php if(isset($poruka)) echo "<font color='red'></br>$poruka</font><br>"; ?>
            </div>
            <div id=main_right_right>
               
                <div id=main_right_right_bot>
                    <a href="" style="text-decoration: none;">
                  
                
                           
                            <input class="registruj_nalog" type="submit" value=" Ukloni"/>
                            <?php if(isset($poruka1)) echo "<font color='red'></br>$poruka1</font><br>"; ?>
                    </a>
                </div></form>
            </div>
        </div>
        </div>
    <div class=linija_menija>
            
        <div class=meni_info>
          <ul>
          <li><a href='Admin pocetna.html' class="pocetna_link"> <?= anchor("Admin/index", "Početna") ?> </a></li>
            <li><a href='statistika_moderatora.html' class="o_nama"><?= anchor("Admin/stat", "Statistika moderatora") ?> </a></li>
            <li><a href='pregled_moderatora.html' class="ponuda"><?= anchor("Admin/pregledmod", "Pregled moderatora") ?> </a></li>
            <li><a href='dodaj_moderatora.html' class="ponuda"> <?= anchor("Admin/registermod", "Dodaj moderatora") ?> </a></li>
            <li>
                <!--<a href='#' class="kontakt">Odjavi se</a>-->
                <?= anchor("Admin/logout", "Odjavi se") ?> 
            </li>
          </ul>
        </div>
        <div class=logo_naziv>
          <a href="index.html">
            <div class='logo_wrapper'>
             
              <h2 class="naziv">ČASKOM</h2>
            </div>
          </a>
        </div>
      </div>

</body>
</html>
