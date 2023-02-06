<!DOCTYPE html>
<html>
<!--Aleksa Vukovic 18/0354 -->
<!-- Milica Milanovic 0601/18 -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/meni.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/body.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/prijava.css'); ?>"/>
</head>
<body>
    <div class="div_prijave">
        <div class="overlay">
            <div class=linija_menija id='navbar' style="height: 40vh;  top:-30vh; margin-left: 5vw;"
                onmouseout="nothovered2()" onmouseover="hovered2()">
                
                <div class=prijava_registracija>
                    <a href="<?php echo base_url('Gost/login')?>" class="prijavi_se">Prijavi se</a>
                  <div class="linija"></div>
                  <a class='link_registracija' href="<?php echo base_url('Gost/register')?>">
                    <div class=dugme_registruj>
                      <span class="registruj_se">Registruj se</span>
                    </div>
                  </a>
                </div>
                <div class=meni_info>
                  <ul>
                    <li><a href='<?php echo base_url('Gost/pocetna')?>' class="pocetna_link">Početna</a></li>
          
          <li><a href='<?php echo base_url('Gost/ponuda')?>' class="ponuda">Ponuda</a></li>

                  </ul>
                </div>
                <div class=logo_naziv>
                  <a href="<?php echo base_url('Gost/index'); ?>">
                    <div class='logo_wrapper'>
                      <h2 class="naziv">ČASKOM</h2>
                    </div>
                  </a>
                </div>
    </div>
            <div class="unutrasnji_div_prijave">
                <div class="prijava_gornji_deo">
                    <span class="prijavi_se_tekst">Prijavi se! </span>
                </div>
                <div class="polja_prijave">
                    <form name="loginform", action="<?= site_url("Gost/loginSubmit") ?>" method="post">
                        <div class='labela_i_polje'>
                            <?php if(isset($poruka)) echo "<span  color='red'>$poruka</span>"; ?>
                            <span class="labela" style="font-size: 0.8vw;">
                                Email adresa*
                            </span>
                            <input type="text" name="e_mail" value="<?= set_value('e_mail') ?>" class="polje_za_unos" placeholder="Unesite vasu email adresu">
                            <span  class='poruka' style="color: red"><?php if(!empty($errors['e_mail'])) echo $errors['e_mail']; ?></span>
                        </div>
                        <div class='labela_i_polje'>
                            <span class="labela" style="font-size: 0.8vw;">
                                Lozinka*
                            </span>
                            <input type="password" name = "lozinka" class="polje_za_unos" placeholder="Unesite vasu lozinku">
                            <span class="poruka" style="color: red"><?php if(!empty($errors['lozinka'])) echo $errors['lozinka'];?></span>
                            <?php if(isset($poruka)) echo "<font color='red'></br>$poruka</font><br>"; ?>
                        </div>
                        
                        <!--<a href="" style="text-decoration: none; width: 53%; height: 6.5vh; margin-top: 4vh;">
                            <div class="prijavi_nalog">
                                <span class="tekst_prijavi_nalog">Prijavi se</span>          
                            </div>
                        </a>-->
                        <button type="submit" style="cursor:pointer; text-decoration: none; width: 53%; height: 7vh; margin-top: 5vh; background-color: transparent; border:none;">
                            <div class="prijavi_nalog">
                                <span class="tekst_prijavi_nalog">Prijavi se</span>
                            </div>
                        </button>
                        <div>
                            <span class="labela nemas_nalog">
                                Nemas nalog? <a ><?= anchor("Gost/register", "Registruj se") ?>  </a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
<script>

    function hovered2() {
        document.getElementById("navbar").style.transitionDuration = "0.6s";
        document.getElementById("navbar").style.top = "-13.8vh";
    }
    function nothovered2() {
        document.getElementById("navbar").style.height = "40vh";
        document.getElementById("navbar").style.top = "-30vh";
    }

</script>
</html>