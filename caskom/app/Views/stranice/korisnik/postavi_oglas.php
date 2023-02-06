<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil - postavljanje oglasa</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/postavi_oglas.css'); ?>">
    <script src="<?php echo base_url('css/korisnik/postavljanje_oglasa_script.js'); ?>"></script>

</head>

<body onload="prvi_option()">
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

            <div class="desno_postavljanje_oglasa">
                
                <form name="postaviOglas", action="<?= site_url("Korisnik/PostavljanjeOglasaSubmitPodaci") ?>" method="post">
                <div class="informacije_oglasa">
                    <h1 class='naslov_sekcije'>Detalji oglasa</h1>
                    <hr>
                    
                        <div class="labela_polje_postavljanje_oglasa" style="margin-top: 7vh;">
                            <span>Naslov oglasa*</span>
                            <input type="text" name="naslov" placeholder="Unesite naslov oglasa">
                        </div>
                        <span class='porukaOglas'><?php if(!empty($errors['naslov'])) echo $errors['naslov']; ?></span>
                       
                        <div class="labela_polje_postavljanje_oglasa">
                            <span>Cena*</span>
                            <input type="number" name="cena" placeholder="Unesite cenu oglasa">
                        </div>
                        <span class='porukaOglas'><?php if(!empty($errors['cena'])) echo $errors['cena']; ?></span>
                        
                        <div class="labela_polje_postavljanje_oglasa">
                            <span style="margin-top: -10vh;">Opis oglasa*</span>
                            <textarea type="text" name="opis" placeholder="Dodajte opis oglasa"></textarea>>
                        </div>
                        <span class='porukaOglas'><?php if(!empty($errors['opis'])) echo $errors['opis']; ?></span>
                    
                </div>

                <div class="informacije_sata">
                    <h1 class='naslov_sekcije'>Detalji sata</h1>
                    <hr>
                    <div class="labela_polje_postavljanje_oglasa" style="margin-top: 8vh;">
                        <span >Brend sata*</span>
                        <select id="padajuca_lista1" name="brend" oninput="prvi_option()" onseeked="prvi_option()">
                            <option>Izaberite brend sata</option>
                            <option>Rolex</option>
                            <option>Audemars Piguet</option>
                            <option>Hublot</option>
                            <option>Omega</option>
                        </select>
                    </div>
                    <?php if(isset($porukaBrend)){    
                        echo "<span class='porukaOglas''>$porukaBrend</span>";
                    }?>
                    
                    <div class="labela_polje_postavljanje_oglasa">
                        <span>Model sata*</span>
                        <select id="padajuca_lista2" name="model" oninput="prvi_option()" onseeked="prvi_option()">
                            <option>Izaberite model sata</option>
                            <option>Submariner</option>
                            <option>Royal Oak</option>
                            <option>Nautilus</option>
                            <option>Daytona</option>
                        </select>
                    </div>
                    <?php if(isset($porukaModel)){                  
                        echo "<span class='porukaOglas''>$porukaModel</span>";
                    }?>
                    
                    <div class="labela_polje_postavljanje_oglasa">
                        <span>Stanje sata*</span>
                        <select id="padajuca_lista3" name="stanje" oninput="prvi_option()" onseeked="prvi_option()">
                            <option>Izaberite stanje sata</option>
                            <option>Mint</option>
                            <option>Veoma dobro</option>
                            <option>Dobro</option>
                            <option>Lose</option>
                            <option>Vintage</option>
                        </select>
                    </div>
                    <?php if(isset($porukaStanje)){                  
                        echo "<span class='porukaOglas''>$porukaStanje</span>";
                    }?>
                    
                    <div class="labela_polje_postavljanje_oglasa">
                        <span>Velicina kucista* (mm)</span>
                        <input type="number" name="velicina_kucista" placeholder="Unesite velicinu kucista">
                    </div>
                    <span class='porukaOglas'><?php if(!empty($errors['velicina_kucista'])) echo $errors['velicina_kucista']; ?></span>
                    
                    <div class="labela_polje_postavljanje_oglasa">
                        <span>Materijal kucista*</span>
                        <select id="padajuca_lista4" name="materijalKucista" oninput="prvi_option()" onseeked="prvi_option()">
                            <option>Izaberite materijal kucista</option>
                            <option>Celik</option>
                            <option>Zuto zlato</option>
                            <option>Belo zlato</option>
                            <option>Roze zlato</option>
                            <option>Titanijum</option>
                            <option>Platina</option>
                            <option>Plastika</option>
                        </select>
                    </div>
                    <?php if(isset($porukaMaterijalKucista)){                  
                        echo "<span class='porukaOglas'>$porukaMaterijalKucista</span>";
                    }?>
                    <div class="labela_polje_postavljanje_oglasa">
                        <span>Materijal narukvice*</span>
                        <select id="padajuca_lista5" name="materijalNarukvice" oninput="prvi_option()" onseeked="prvi_option()">
                            <option>Izaberite materijal narukvice</option>
                            <option>Celik</option>
                            <option>Zuto zlato</option>
                            <option>Belo zlato</option>
                            <option>Roze zlato</option>
                            <option>Titanijum</option>
                            <option>Platina</option>
                            <option>Plastika</option>
                        </select>
                    </div>
                    <?php if(isset($porukaMaterijalNarukvice)){                  
                        echo "<span class='porukaOglas'>$porukaMaterijalNarukvice</span>";
                    }?>
                    <div class="labela_polje_postavljanje_oglasa">
                        <span>Mehanizam sata*</span>
                        <select id="padajuca_lista6" name="mehanizam" oninput="prvi_option()" onseeked="prvi_option()">
                            <option>Izaberite mehanizam sata</option>
                            <option>Automatik</option>
                            <option>Quartz</option>
                            <option>Spring drive</option>
                            <option>Digitalni</option>
                        </select>
                    </div>
                </div>
                    <?php if(isset($porukaMehanizam)){                  
                        echo "<span class='porukaOglas'>$porukaMehanizam</span>";
                    }?>

                    
                    <div class="div_dugme_sledeca_strana">
                        <?php 
                            if($_SESSION['korisnik']->pretplacen != 0){
                                echo "<button type='submit' class='dugme_dalje'>
                                    <span class='text_dugmeta' style='letter-spacing: 0.13vw;'>Dalje</span>
                                </button>";
                            }
                            else{
                                echo "<h1 style='color:rgb(240,240,240);'>Niste pretplaceni!</h1>";
                            }
                        ?>
                    </div>
                

                </form>
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