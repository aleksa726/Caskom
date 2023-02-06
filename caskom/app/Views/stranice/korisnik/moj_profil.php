 <html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/moj_profil.css'); ?>">

</head>

<body>
    <div class="cela_strana_moj_profil">


        

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

        <div class="wrapper_moj_profil">
            <div class="levo_moj_profil">

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

            <div class="desno_moj_profil">
                <h1 class='naslov_sekcije'>Osnovne informacije</h1>
                <hr>
                <div class="informacije_profila">

                    <div class="profilna_slika">
                        <img src="<?php echo base_url('images/account_picture.png'); ?>" alt="">
                    </div>
                    <div class="podaci_profila">
                        <span><?php echo $_SESSION['korisnik']->korisnicko_ime; ?></span></br></br>
                        <span><?php echo $_SESSION['korisnik']->ime; ?></span></br></br>
                        <span><?php echo $_SESSION['korisnik']->e_mail; ?></span></br></br>
                        <span><?php if($_SESSION['korisnik']->telefon != null) echo $_SESSION['korisnik']->telefon; ?></span>
                    </div>

                </div>

                <div style="margin-top: 5vh; width: 100%; height: 5vh; text-align: center;">
                    <span class="datum_isticanja">
                        Vasa pretplata istice: <span class="datum_span">
                            <?php  
                                if($datum != null){
                                    $datum = date('d.m.Y.', strtotime($datum));
                                }
                                else{
                                    $datum = "Pretplata je istekla!";
                                }
                                echo $datum;?>
                        </span>
                    </span>
                </div>
                <h1 class='naslov_sekcije'>Ocene</h1>
                <hr>
                <div class="recenzije_profila">

                    <span>Prosecna ocena: <span class="ocena_broj"
                            style="color: #c2983d; font-size: 1.6vw; font-weight: bold;">
                            <?php {
                                if(count($recenzije) > 0){
                                    $zbir = 0;
                                    foreach ($recenzije as $recenzija){
                                        $zbir += $recenzija->ocena;
                                    }
                                    $rezultat = $zbir / count($recenzije);
                                    $rezultat = number_format($rezultat, 2, '.', ' ');
                                    echo "$rezultat/5";
                                }
                                else echo "Nema ocena";
                            } ?></span></span></br>
                    <span>Ukupno ocena: <span class="ocena_broj"
                            style="color: #c2983d; font-size: 1.6vw; font-weight: bold;"><?php echo count($recenzije); ?></span> </span>

                    <div class="odeljak_recenzija">
                        
                        <?php
                        $cntRec = 0;
                        if(isset($recenzije)){
                            foreach($recenzije as $recenzija){
                                if($cntRec < 4){
                                    echo 
                                    "<div class='div_recenzije'>
                                        <span class='username_korisnika_recenzije'>
                                    {$korisnici[$cntRec]->korisnicko_ime}
                                        </span>
                                        <span class='ocena_recenizje'>
                                            $recenzija->ocena/5
                                        </span>
                                        <span class='tekst_recenzije'>
                                            $recenzija->tekst;
                                        </span>
                                    </div>";
                                }
                                $cntRec++;
                            }
                            if($cntRec == 0){
                             echo "<h1 style='color:rgb(210,210,210);'>Nema dostupnih recenzija!</h1>";
                            }
                        }
                        else{
                            echo "<h1 style='color:rgb(210,210,210);'>Nema dostupnih recenzija!</h1>";
                        }
                        ?>
                        
                    </div>
                    <div class="div_prikazi_sve">
                        <a href="<?php echo base_url('Korisnik/moje_ocene'); ?>">
                            <div class="dugme_prikazi_sve">
                                <h3>Prikazi sve recenzije</h3>
                            </div>
                        </a>
                    </div>

                </div>

                <h1 class='naslov_sekcije' style="margin-top: 10vh;">Oglasi</h1>
                <hr>
                <div style="margin-top: 5vh;  width: 100%; height: 5vh; text-align: center;">
                    <span class="datum_isticanja">
                        Ukupno oglasa: <span class="datum_span"><?php echo count($oglasi);?></span>
                    </span>
                </div>
                <div class="odeljak_oglasa" style="justify-content: center;">

                    <?php 
                    $cnt = 0;
                    if($_SESSION['korisnik']->pretplacen != 0){
                        if(isset($oglasi)){
                            foreach ($oglasi as $oglas) {
                                if($cnt < 4){
                                    $fotografija = $fotografije[$cnt];
                                    $putanjaStr = "putanja";
                                    $putanja = base_url('../../images/generic_watch.png');
                                    if($fotografija != null){
                                        $putanja = base_url("/$fotografija->putanja");
                                    }
                                    if($oglas->boostovan == true){
                                        echo "
                                        <a class='moji_istaknuti_oglasi' href='  oglas/$oglas->idO'>
                                            <div class='div_oglasa istaknuti_div'>
                                                <div class='edit_istaknuti'></div>
                                                <div class='istakni_istaknuti'></div>
                                                <div style=' background-image: url($putanja); 'class='div_fotografije_oglasa'></div>
                                                <div class='div_naslova_i_cene_istaknuti'>
                                                    <h2 class='nalov_oglasa_istaknuti istaknuti_naslov'>$oglas->naslov</h2>
                                                    <h2 class='cena_oglasa_istaknuti istaknuta_cena'>$oglas->cena$</h2>
                                                </div>
                                            </div>
                                        </a>";
                                    }
                                    else{
                                        echo "
                                        <a class='moji_istaknuti_oglasi' href='  oglas/$oglas->idO'>
                                            <div class='div_oglasa'>
                                                <div class='edit'></div>
                                                <div class='istakni'></div>
                                                <div style=' background-image: url($putanja);' class='div_fotografije_oglasa'></div>
                                                <div class='div_naslova_i_cene_istaknuti'>
                                                    <h2 class='nalov_oglasa_istaknuti'>$oglas->naslov</h2>
                                                    <h2 class='cena_oglasa_istaknuti'>$oglas->cena$</h2>
                                                </div>
                                            </div>
                                        </a>";
                                    }
                                }
                            $cnt++;
                        }
                        if($cnt == 0){
                             echo "<h1 style='color:rgb(210,210,210);'>Nema dostupnih oglasa!</h1>";
                        }
                      }
                      else{
                          //nema oglasa
                          echo "<h1 style='color:rgb(210,210,210);'>Nema dostupnih oglasa!</h1>";
                      }
                  }
                  else{
                      echo "<h1 style='color:rgb(210,210,210);'>Niste pretplaceni!</h1>";
                  }
                  ?>

                   



                </div>
                <div class="div_prikazi_sve" style="margin-top: 4vh;">
                    <a href="<?php echo base_url('Korisnik/moji_oglasi'); ?>">
                        <div class="dugme_prikazi_sve">
                            <h3>Prikazi sve oglase</h3>
                        </div>
                    </a>
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