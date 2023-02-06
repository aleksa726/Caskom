<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/pretplata_uplatnica.css'); ?>">
  

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


                <h1 class='naslov_sekcije' style="margin-top: 10vh;">Pretplacivanje - postavljanje uplatnice</h1>
                <hr>

                <div class="div_pretplacivanja">

                    <span class="primer_uplatnice">
                        Primer uplatnice:
                    </span>

                    <div class="primer_uplatnice_slika"></div>

                    <form method="post" action="<?php echo base_url("Korisnik/dodajFotografijeUplatnica/$meseci/$cena"); ?>" enctype="multipart/form-data">
                        <div class="div_posavljanja_uplatnice">
                            <span><label><input type="file" id="inpFile" name="inpFile"
                                        style="display: none;">Dodajte</label> fotografiju Vase uplatnice</span>
                            <div id='previewContainer1' class="primer_uplatnice_slika2">
                                <img src="" alt="" class="slika_moje_uplatnice">
                            </div>
                        </div>

                        <div class="div_dugme_pretplati_se">
                            <a href="">
                                <button  type="submit" name="dugme_dalje" class="dugme_pretplati_se">
                                    <h3>Predaj</h3>
                                </button>
                            </a>
                        </div>
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
    const inpFile = document.getElementById("inpFile");
    const previewContainer1 = document.getElementById("previewContainer1");
    const previewImage1 = previewContainer1.querySelector(".slika_moje_uplatnice");
    inpFile.addEventListener("change", function () {
        const file1 = this.files[0];
        if (file1) {
            const reader1 = new FileReader();
            previewImage1.style.display = "block";
            previewContainer1.style.display = "flex";
            previewContainer1.style.flexDirection = "column";
            previewContainer1.style.justifyContent = "center";
            reader1.addEventListener("load", function () {
                previewImage1.setAttribute("src", this.result);
            });
            reader1.readAsDataURL(file1);

        }
    });
</script>

</html>