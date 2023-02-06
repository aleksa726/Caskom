<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/moje_ocene.css'); ?>">

</head>

<body>
    <div class="cela_strana_moj_profil" style="height: auto">




        <div class="hoverzone" id='hoverzone' onmouseover="hovered()"></div>


        <div class=linija_menija id='navbar' style="background-color: rgb(28, 28, 29);">
            <div class="moj_profil">
                <a href="<?php echo base_url('Korisnik/moj_profil'); ?>">
                    <h2>Moj profil</h2>
                    <img src="<?php echo base_url('images/profile_picture.png'); ?>" alt="">
                </a>
            </div>
            <div class=meni_info>
                <ul>
                    <li><a href='<?php echo base_url('Korisnik/index'); ?>' class="pocetna_link">Početna</a></li>
                    
                    <li><a href='<?php echo base_url('Korisnik/ponuda'); ?>' class="ponuda">Ponuda</a></li>
                    
                </ul>
            </div>
            <div class=logo_naziv>
                <a href="<?php echo base_url('Korisnik/index'); ?>">
                    <div class='logo_wrapper'>
                        
                        <h2 class="naziv">ČASKOM</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="wrapper_moj_profil" style="height: auto">
            <div class="levo_moj_profil" style="height: auto">

                <a href="<?php echo base_url('Korisnik/postavi_oglas'); ?>">
                    <div class="dugme_navigacija_naloga">
                        <span class="text_dugmeta">Postavi oglas</span>
                    </div>
                </a>
                <a href="<?php echo base_url('Korisnik/pretplata'); ?>">
                    <div class="dugme_navigacija_naloga">
                        <span class="text_dugmeta">Pretplati se</span>
                    </div>
                </a>
                <div class="navigacija_naloga">
                    <h2>Navigacija naloga</h2>
                    <div class="element_navigacije">
                        <a href="<?php echo base_url('Korisnik/moj_profil'); ?>">
                            <span class="tekst_elementa">
                                Moj korisnicki nalog
                            </span>
                        </a>
                    </div>
                    <div class="element_navigacije">
                        <a href="<?php echo base_url('Korisnik/moje_ocene'); ?>">
                            <span class="tekst_elementa">
                                Moje ocene
                            </span>
                        </a>
                    </div>
                    <div class="element_navigacije">
                        <a href="<?php echo base_url('Korisnik/moji_oglasi'); ?>">
                            <span class="tekst_elementa">
                                Moji oglasi
                            </span>
                        </a>
                    </div>
                    <div class="element_navigacije">
                        <a href="<?php echo base_url('Korisnik/moja_lista_zelja'); ?>">
                            <span class="tekst_elementa">
                                Moja lista zelja
                            </span>
                        </a>
                    </div>
                    <div class="element_navigacije">
                        <a href="<?php echo base_url('Korisnik/logout'); ?>">
                            <span class="tekst_elementa">
                                Izloguj se
                            </span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="desno_moj_profil" style="height: auto">
                <h1 class='naslov_sekcije'>Moje ocene</h1>
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