<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<!-- Milica Milanovic 0601/18 -->
<head>
    <meta charset="utf-8">

    <title>Registracija-Pravno lice</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/gost/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/gost/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/gost/registracija.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/gost/registracija_pravnog_lica.css'); ?>">

</head>

<body>
    <div class="hoverzone" id='hoverzone' onmouseover="hovered1()" onmouseout="nothovered1()"></div>



    <div class='ceo_div_registracije'>
        <div class="levi_div_registracije">
            <div class='background_overlay'>
                <div class="div_teksta">
                    <span class="quote">“Jewelry isn’t really my thing, but I’ve always got my eye on people’s
                        watches.” <br /><br />Clive Owen</span>
                </div>
            </div>
        </div>






        <div class="desni_div_registracije">


            <div class="div_registracije" style="height: 90vh; width: 25vw;">

                <div class="registracija_gornji_deo" style="margin-top: 1vh;">
                    <span class="pridruzi_se"
                        style="font-size: 1.85vw; margin-bottom: 0.6vh; letter-spacing: 2.5px;">Registracija pravnog
                        lica</span>
                    <span class="tekst_registracija" style="font-size: 0.77vw; color: rgb(202, 202, 202);">U svrhe
                        ispunjenja svih
                        pravila,
                        neophodno
                        je uneti vase lične
                        podatke!</span>
                </div>

                <hr class='linija2'>

                <form name="loginform", action="<?= site_url("Gost/register_company_submit") ?>" method="post">
                <div class="polja_registracija">
                    <div class='labela_i_polje'>
                        <span class="labela">
                            Vaše ime firme*
                        </span>
                        <input type="text" name="ime" class="polje_za_unos" placeholder="Unesite ime firme">
                        <span class='poruka' style="color: red"><?php if(!empty($errors['ime'])) echo $errors['ime']; ?></span>
                    </div>
                    <div class='labela_i_polje'>
                        <span class="labela">
                            Vaš matični broj firme iz APR-a*
                        </span>
                        <input type=number name="apr" class="polje_za_unos" placeholder="Unesite maticni broj firme">
                        <span class='poruka' style="color: red"><?php if(!empty($errors['apr'])) echo $errors['apr']; ?></span>
                        <?php if(isset($poruka)) echo "<font color='red'></br>$poruka</font><br>"; ?>
                    </div>
                    <div class='labela_i_polje'>
                        <span class="labela">
                            Vaša email adresa*
                        </span>
                        <input type="text" name="e_mail" class="polje_za_unos" placeholder="Unesite email adresu">
                        <span class='poruka' style="color: red"><?php if(!empty($errors['e_mail'])) echo $errors['e_mail']; ?></span>
                        <?php if(isset($poruka1)) echo "<font color='red'></br>$poruka1</font><br>"; ?>
                    </div>
                    <div class='labela_i_polje'>
                        <span class="labela">
                            Vaša lozinka*
                        </span>
                        <input type="password" name="lozinka" class="polje_za_unos" placeholder="Unesite lozinku">
                        <span class='poruka' style="color: red"><?php if(!empty($errors['lozinka'])) echo $errors['lozinka']; ?></span>
                    </div>

                    <div class="checkboxovi">
                        <div class="checkbox_i_labela">
                            <input type="checkbox" name="uslovi" class="checkbox1">
                           
                            <span class="labela" style="color: rgb(214, 214, 214);">Prihvatam sve <a href="<?php echo base_url('Gost/usl'); ?>">uslove
                                korišćenja*</a></span>
                        </div>
                         <span class='poruka' style="color: red"><?php if(!empty($errors['uslovi'])) echo $errors['uslovi']; ?></span>
                    </div>
                    <!--<a href="" style="text-decoration: none;">
                        <div class="registruj_nalog">

                            <span class="tekst_registruj_nalog">Registruj se</span>

                        </div>
                    </a>-->
                    <button id= b2 type="submit" class="registruj_nalog">

                            <span class="tekst_registruj_nalog">Registruj se</span>

                        </button>
                    <?php if(isset($poruka2)) echo "<font color='red'></br>$poruka2</font><br>"; ?>
                   
                </div>
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