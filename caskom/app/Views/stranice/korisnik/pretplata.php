<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/pretplata.css'); ?>">
    <script src="<?php echo base_url('css/korisnik/biranje_pretplate.js'); ?>"></script>

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


                <h1 class='naslov_sekcije' style="margin-top: 10vh;">Pretplacivanje</h1>
                <hr>

                <div class="div_pretplacivanja">

                    <span class="datum_isticanja">
                        Vasa pretplata istice: <span class="datum_span"><?php  
                        if($datum != null){
                            $datum = date('d.m.Y.', strtotime($datum));
                        }
                        else{
                            $datum = "Pretplata je istekla!";
                        }
                        echo $datum;?></span>
                    </span>

                    <div class="biranje_pretplate">
                        <div id='pretplata1' class="div_tipa_pretplate" onclick="biranje_pretplate1()">
                            <span class="naslov_pretplate">
                                <span style="font-size: 1.9vw;"> 1 </span></br>mesec
                            </span>
                            <div class="dekorativna_slika"
                                style="background-image: url(../../images/submariner_green.png); background-size: 85%; margin-top: -1vh; margin-bottom: 1vh;">
                            </div>
                            <span class="cena_pretplate">
                                100 <span style="font-size: 0.85vw; font-weight: normal;"> dinara</span>
                            </span>
                        </div>
                        <div id='pretplata2' class="div_tipa_pretplate" onclick="biranje_pretplate2()">
                            <span class="naslov_pretplate">
                                <span style="font-size: 1.9vw;"> 6 </span></br>meseci
                            </span>
                            <div class="dekorativna_slika" style="background-image: url(../../images/jacobandco.png);"></div>
                            <span class="cena_pretplate">
                                500 <span style="font-size: 0.85vw; font-weight: normal;"> dinara</span>
                            </span>
                        </div>
                        <div id='pretplata3' class="div_tipa_pretplate" onclick="biranje_pretplate3()">
                            <span class="naslov_pretplate">
                                <span style="font-size: 1.9vw;"> 12 </span></br>meseci
                            </span>
                            <div class="dekorativna_slika" style="background-image: url(../../images/richard_mille.png);">
                            </div>
                            <span class="cena_pretplate">
                                900 <span style="font-size: 0.85vw; font-weight: normal;"> dinara</span>
                            </span>
                        </div>
                    </div>

                    <?php if(!$_SESSION['korisnik']->pretplacen){
                        $link = base_url("Korisnik/pretplata_uplatnica");
                        echo 
                        "<div class='div_dugme_pretplati_se'>
                            <a href='$link'>
                                <div class='dugme_pretplati_se'>
                                    
                                </div>
                            </a>
                        </div>";
                    }
                    else{
                       
                    }
                        
                    ?>
                   
                    <form method="post" action="<?php echo base_url("Korisnik/pretplata_uplatnica")?>">
                        <input type="checkbox" id="ch1" style="display: none;" name="ch1">
                        <input type="checkbox" id="ch2" style="display: none;" name="ch2">
                        <input type="checkbox" id="ch3" style="display: none;" name="ch3">
                        <?php if(!$_SESSION['korisnik']->pretplacen){
                            echo 
                            "<div class='div_dugme_pretplati_se'>
                                <button type='submit' value='' class='dugme_pretplati_se'><h3>Pretplati se</h3></button>
                            </div>";
                        }
                        else{
                        echo "<div class='div_dugme_pretplati_se'>
                                    <h3 style='font-size:2vw; color:white;'>Pretplaceni ste</h3>
                                </div>";
                        }
                        ?>
                    </form>
                    
                    

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

<script>
    function biranje_pretplate1() {
        document.getElementById("pretplata1").style.background = "linear-gradient(#006039, #009e5f)";
        document.getElementById("pretplata1").style.boxShadow = "10px 16px 16px rgb(10, 10, 10)";

        document.getElementById("pretplata3").style.background = "linear-gradient(#00814d , #006039)";
        document.getElementById("pretplata3").style.boxShadow = "2px 4px 4px rgb(15, 15, 15)";

        document.getElementById("pretplata2").style.background = "linear-gradient(#00814d , #006039)";
        document.getElementById("pretplata2").style.boxShadow = "2px 4px 4px rgb(15, 15, 15)";
        document.getElementById("ch1").checked = true;
        document.getElementById("ch2").checked = false;
        document.getElementById("ch3").checked = false;
   
    }
    
    function biranje_pretplate2() {
        document.getElementById("pretplata2").style.background = "linear-gradient(#006039, #009e5f)";
        document.getElementById("pretplata2").style.boxShadow = "4px 6px 10px rgb(10, 10, 10)";

        document.getElementById("pretplata1").style.background = "linear-gradient(#00814d , #006039)";
        document.getElementById("pretplata1").style.boxShadow = "2px 4px 4px rgb(15, 15, 15)";

        document.getElementById("pretplata3").style.background = "linear-gradient(#00814d , #006039)";
        document.getElementById("pretplata3").style.boxShadow = "2px 4px 4px rgb(15, 15, 15)";
        document.getElementById("ch1").checked = false;
        document.getElementById("ch2").checked = true;
        document.getElementById("ch3").checked = false;
    }
    
    function biranje_pretplate3() {
        document.getElementById("pretplata3").style.background = "linear-gradient(#006039, #009e5f)";
        document.getElementById("pretplata3").style.boxShadow = "4px 6px 10px rgb(10, 10, 10)";

        document.getElementById("pretplata1").style.background = "linear-gradient(#00814d , #006039)";
        document.getElementById("pretplata1").style.boxShadow = "2px 4px 4px rgb(15, 15, 15)";

        document.getElementById("pretplata2").style.background = "linear-gradient(#00814d , #006039)";
        document.getElementById("pretplata2").style.boxShadow = "2px 4px 4px rgb(15, 15, 15)";    
        document.getElementById("ch1").checked = false;
        document.getElementById("ch2").checked = false;
        document.getElementById("ch3").checked = true;
    }
 
</script>


</html>