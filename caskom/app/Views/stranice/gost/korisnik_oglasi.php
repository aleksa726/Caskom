<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/gost/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/moji_oglasi.css'); ?>">

</head>

<body>
    <div class="cela_strana_moj_profil">




        <div class="hoverzone" id='hoverzone' onmouseover="hovered()"></div>


        <div class=linija_menija id='navbar' style="background-color: rgb(28, 28, 29); animation: ani33 0.6s linear; height:11vh">
            <div class=prijava_registracija style="margin-right:4vw;">
          <a href="<?php echo base_url('Gost/login')?>" class="prijavi_se">Prijavi se</a>
        <div class="linija"></div>
        <a class='link_registracija' href="<?php echo base_url('Gost/register')?>">
          <div class=dugme_registruj>
            <span class="registruj_se">Registruj se</span>
          </div>
        </a>
      </div>
            <div class=meni_info style="margin-left: 29.5vw; margin-top: -0.75vh;">
                <ul>
                    <li><a href='<?php echo base_url('Gost/pocetna'); ?>' class="pocetna_link">Početna</a></li>
                    
                    <li><a href='<?php echo base_url('Gost/klikNaPonudu'); ?>' class="ponuda">Ponuda</a></li>
                </ul>
            </div>
            <div class=logo_naziv>
                <a href="<?php echo base_url('Korisnik/index'); ?>">
                    <div class='logo_wrapper'>
                        
                        <h2 class="naziv" style="font-weight:bold">ČASKOM</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="wrapper_moj_profil">
            

            <div style="margin-left: 11.5vw" class="desno_moj_profil">


                <h1 class='naslov_sekcije' style="margin-top: 10vh;">Oglasi korisnika</h1>
                <hr>

                <div class="odeljak_oglasa">

               <?php 
                if($korisnik->pretplacen != false){
                    if(isset($oglasi)){
                      $cnt = 0;
                      foreach ($oglasi as $oglas) {
                          $fotografija = $fotografije[$cnt];
                          $putanja = base_url('../../images/generic_watch.png');
                          if($fotografija != null){
                            $putanja = base_url("/$fotografija->putanja");
                          }
                          if($oglas->boostovan == true){
                            $url = site_url("Gost/oglas/$oglas->idO");
                            echo "<div class='moji_istaknuti_oglasi'>
                                    <div class='div_oglasa istaknuti_div'>
                                        
                                        <a class='link_za_klik' href='$url'>
                                            <div style=' background-image: url($putanja);' class='div_fotografije_oglasa'></div>
                                            <div class='div_naslova_i_cene_istaknuti'>
                                                <h2 class='nalov_oglasa_istaknuti istaknuti_naslov'>$oglas->naslov</h2>
                                                <h2 class='cena_oglasa_istaknuti istaknuta_cena'>$oglas->cena$</h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>";
                            }
                            else{
                               $url = site_url("Gost/oglas/$oglas->idO");
                                echo 
                                "<div class='moji_istaknuti_oglasi'>
                                    <div class='div_oglasa'>
                                        
                                        <a class='link_za_klik' href='$url'>
                                            <div style=' background-image: url($putanja);' class='div_fotografije_oglasa'></div>
                                            <div class='div_naslova_i_cene_istaknuti'>
                                                <h2 class='nalov_oglasa_istaknuti'>$oglas->naslov</h2>
                                                <h2 class='cena_oglasa_istaknuti'>$oglas->cena$</h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>";
                            }
                            $cnt++;
                      }
                      if(count($oglasi) == 0){
                          echo "<h1 style='margin-left:22vw; color:rgb(210,210,210);'>Nema dostupnih oglasa!</h1>";
                      }

                    }
                    else{
                          echo "<h1 style='margin-left:22vw; color:rgb(210,210,210);'>Nema trenutno dostupnih oglasa</h1>";
                    }
                }else{
                    echo "<h1 style='margin-left:22vw; color:rgb(210,210,210);'>Niste pretplaceni!</h1>";
                }
                ?>

                    



                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.transitionDuration = "0.4s";
            document.getElementById("navbar").style.top = "-150px";
        }
        prevScrollpos = currentScrollPos;
    }
</script>

<script>
    function hovered() {
        document.getElementById("navbar").style.top = "0";
        document.getElementById("navbar").style.transitionDuration = "0.6s";
    }
</script>


</html>