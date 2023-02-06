<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<!-- Milica Milanovic 0601/18 -->
<head>
    <meta charset="utf-8">

    <title>Registracija</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url('css/gost/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/gost/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/gost/registracija.css'); ?>">

</head>

<body>
    <div class="hoverzone" id='hoverzone' onmouseover="hovered1()" onmouseout="nothovered1()"></div>

    <div class=linija_menija id='navbar' style="height: 40vh;  top:-30vh" onmouseout="nothovered2()"
        onmouseover="hovered2()">
        
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

    <div class='ceo_div_registracije'>
        <div class="levi_div_registracije">
            <div class='background_overlay'>
                <div class="div_teksta">
                    <span class="quote">“A gentleman’s choice of timepiece says as much about him as does his Saville
                        Row
                        suit.” <br /><br />Ian Fleming</span>
                </div>
            </div>
        </div>

        <div class="desni_div_registracije">
            <div class="div_registracije">

                <div class="registracija_gornji_deo">
                    <span class="pridruzi_se">Pridruži se!</span>
                    <span class="tekst_registracija">Za početak nam recite koju vrstu naloga želite da napravite.</span>
                </div>

                <div class="dugmici_registracija">
                    <a href="<?php echo site_url('Gost/register_person'); ?>" style="width: 90%; height: 11vh;">
                        <div class="dugme_fizicko_lice">
                            <span class="vrsta_lica">Fizičko lice</span>
                            <span class="opis_lica">Personalni profil kojim ćes upravljati svim svojim
                                aktivnostima</span>
                        </div>
                    </a>
                    <a href="<?php echo site_url('Gost/register_company'); ?>" style="width: 90%; height: 11vh;">
                        <div class="dugme_pravno_lice">
                            <span class="vrsta_lica">Pravno lice</span>
                            <span class="opis_lica">Ako poseduješ kompaniju ovo je prava opcija za tebe</span>
                        </div>
                    </a>
                </div>

                <div class="imas_nalog">
                    <span>Već imaš nalog? <a ><?= anchor("Gost/login", "Prijavi se!") ?></a></span>
                </div>
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