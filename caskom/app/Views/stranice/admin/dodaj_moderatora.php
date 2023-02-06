<!DOCTYPE html>
<!-- Marija Dobric 0417/18 -->
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo base_url('css/admin/dodaj_moderatora.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('css/admin/meni.css'); ?>">


</head>
<body>
    <div id=ad3>
        <div class="levi_div_registracije" >
            <div class='background_overlay' >
        
                <div class="div_teksta">
                    <span class="quote">“Jewelry isn’t really my thing, but I’ve always got my eye on people’s
                        watches.” <br /><br />Clive Owen</span>
                </div>
            </div>
        </div>
    <div id=ad5>
<h2 id=ad6> Dodaj moderatora</h2>
<hr class='linija2'>
<form name="loginform", action="<?= site_url("Admin/register_moderator") ?>" method="post">
<div class="polja_registracija">
    <div class='labela_i_polje'>
        <span class="labela">
            Ime:
        </span>
        <input type="text" class="polje_za_unos" name='ime' placeholder="Unesite ime ">
        <span style="color: red"><?php if(!empty($errors['ime'])) echo $errors['ime']; ?></span>
    </div>
    <div class='labela_i_polje'>
        <span class="labela">
          Prezime:
        </span>
        <input type="text" class="polje_za_unos" name='prezime'placeholder="Unesite preime">
        <span style="color: red"><?php if(!empty($errors['prezime'])) echo $errors['prezime']; ?></span>
    </div>
    <div class='labela_i_polje'>
        <span class="labela">
            Email adresa:
        </span>
        <input type="text" class="polje_za_unos" name='e_mail' placeholder="Unesite e-mail adresu ">
        <span style="color: red"><?php if(!empty($errors['e_mail'])) echo $errors['e_mail']; ?></span>
        <?php if(isset($poruka1)) echo "<font color='red' ></br>$poruka1</font><br>"; ?>
    </div>
    <div class='labela_i_polje'>
        <span class="labela">
            Korisničko ime:
        </span>
        <input type="text" class="polje_za_unos" name='korisnicko_ime' placeholder="Unesite korisničko ime">
        <span style="color: red"><?php if(!empty($errors['korisnicko_ime'])) echo $errors['korisnicko_ime']; ?></span>
    </div>
    <div class='labela_i_polje'>
        <span class="labela">
          Šifra:
        </span>
        <input type="password" class="polje_za_unos" name='lozinka' placeholder="Unesite šifru">
        <span style="color: red"><?php if(!empty($errors['lozinka'])) echo $errors['lozinka']; ?></span>
        <?php if(isset($poruka)) echo "<font color='red' ></br>$poruka</font><br>"; ?>
        <?php if(isset($poruka2)) echo "<font color='red' ></br>$poruka2</font><br>"; ?>
    </div>

 
    <a href="" style="text-decoration: none;">
      <div id=nn>
        <input class="registruj_nalog" type="submit" value=" Potvrdi"/>
      
        </div>
   
    </a>
   
</form>
</div>


</div>
    </div>
    </div>
    <div id=ad2>
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
          
    
          </div>


</body>


</html>
