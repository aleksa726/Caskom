<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/gost/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/moje_ocene.css'); ?>">

</head>

<body>
    <div class="cela_strana_moj_profil" style="height: auto">




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

        <div class="wrapper_moj_profil" style="height: auto">
            

            <div style="margin-left: 11.5vw" class="desno_moj_profil" style="height: auto">
                <h1 class='naslov_sekcije'>Ocene korisnika</h1>
                <hr>
                <div class="wrapper_moje_ocene">

                    
                    <?php
                        $cntRec = 0;
                        foreach($recenzije as $recenzija){
                            $datum = date('Y:m:d', strtotime($recenzija->vreme_postavljanja));
                            echo 
                                "<div class='div_jedne_ocene'>
                                    <div class='korisnik_i_ocena'>
                                        <a ><span> {$korisnici[$cntRec]->korisnicko_ime}</span></a>
                                        <span style='color: #c2983d;'>$recenzija->ocena/5</span>
                                    </div>
                                    <span class='tekst_ocene_span'>
                                        $recenzija->tekst
                                    </span>
                                    <span class='datum_recenzije'>
                                        $datum
                                    </span>
                                </div>";
                            $cntRec++;
                        }
                        if($cntRec == 0){
                            echo "<h1 style='color:rgb(210,210,210);'>Nema dostupnih recenzija!</h1>";
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