<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Moj profil - postavljanje oglasa</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/postavi_oglas_fotografije.css'); ?>">

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

                <form method="post" action="<?php echo base_url("Korisnik/izmenaOglasaFotografijeSubmit/$maxId"); ?>" enctype="multipart/form-data">

                    <div class="informacije_oglasa">
                        <h1 class='naslov_sekcije'>Fotografije</h1>
                        <hr>
                        <div class="div_svih_dodatih_slika">
                            <div id='previewContainer1' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika1">
                            </div>
                            <div id='previewContainer2' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika2">
                            </div>
                            <div id='previewContainer3' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika3">
                            </div>
                            <div id='previewContainer4' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika4">
                            </div>
                            <div id='previewContainer5' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika5">
                            </div>
                            <div id='previewContainer6' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika6">
                            </div>
                            <div id='previewContainer7' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika7">
                            </div>
                            <div id='previewContainer8' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika8">
                            </div>
                            <div id='previewContainer9' class="div_dodate_fotografije">
                                <img src="" alt="" class="dodata_slika9">
                            </div>

                            <div class="okvir_za_dodavanje_slika">
                                <img src="<?php echo base_url('images/camera.png'); ?>" alt="">
                                <span><label><input type="file" multiple="multiple" id="inpFile" name="inpFile[]"
                                            style="display: none;">Dodajte</label> fotografiju</span>
                            </div>
                        </div>
                    </div>



                    <div  class="div_dugme_sledeca_strana">
                        
                            <button  type="submit" name="dugme_dalje" class="dugme_dalje">
                                <span class="text_dugmeta" style="letter-spacing: 0.13vw;">Izmeni oglas</span>
                            </button>
                       
                    </div>>
                
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

<script>

    const inpFile = document.getElementById("inpFile");
    const previewContainer1 = document.getElementById("previewContainer1");
    const previewContainer2 = document.getElementById("previewContainer2");
    const previewContainer3 = document.getElementById("previewContainer3");
    const previewContainer4 = document.getElementById("previewContainer4");
    const previewContainer5 = document.getElementById("previewContainer5");
    const previewContainer6 = document.getElementById("previewContainer6");
    const previewContainer7 = document.getElementById("previewContainer7");
    const previewContainer8 = document.getElementById("previewContainer8");
    
    const previewImage1 = previewContainer1.querySelector(".dodata_slika1");
    const previewImage2 = previewContainer2.querySelector(".dodata_slika2");
    const previewImage3 = previewContainer3.querySelector(".dodata_slika3");
    const previewImage4 = previewContainer4.querySelector(".dodata_slika4");
    const previewImage5 = previewContainer5.querySelector(".dodata_slika5");
    const previewImage6 = previewContainer6.querySelector(".dodata_slika6");
    const previewImage7 = previewContainer7.querySelector(".dodata_slika7");
    const previewImage8 = previewContainer8.querySelector(".dodata_slika8");
    
    var file1Added = 0;
    inpFile.addEventListener("change", function () {
        const file1 = this.files[0];
        const file2 = this.files[1];
        const file3 = this.files[2];
        const file4 = this.files[3];
        const file5 = this.files[4];
        const file6 = this.files[5];
        const file7 = this.files[6];
        const file8 = this.files[7];
      

        if (file1 && file1Added == 0) {
            const reader1 = new FileReader();
            previewImage1.style.display = "block";
            previewContainer1.style.display = "block";
            reader1.addEventListener("load", function () {
                previewImage1.setAttribute("src", this.result);
            });
            reader1.readAsDataURL(file1);
            file1Added = 1;
        }
        if (file2 && file1Added == 1) {
            const reader2 = new FileReader();
            previewImage2.style.display = "block";
            previewContainer2.style.display = "block";
            reader2.addEventListener("load", function () {
                previewImage2.setAttribute("src", this.result);
            });
            reader2.readAsDataURL(file2);
            file1Added = 2;
        }
        if (file3 && file1Added == 2) {
            const reader3 = new FileReader();
            previewImage3.style.display = "block";
            previewContainer3.style.display = "block";
            reader3.addEventListener("load", function () {
                previewImage3.setAttribute("src", this.result);
            });
            reader3.readAsDataURL(file3);
            file1Added = 3;
        }
        if (file4 && file1Added == 3) {
            const reader4 = new FileReader();
            previewImage4.style.display = "block";
            previewContainer4.style.display = "block";
            reader4.addEventListener("load", function () {
                previewImage4.setAttribute("src", this.result);
            });
            reader4.readAsDataURL(file4);
            file1Added = 4;
        }
        if (file5 && file1Added == 4) {
            const reader5 = new FileReader();
            previewImage5.style.display = "block";
            previewContainer5.style.display = "block";
            reader5.addEventListener("load", function () {
                previewImage5.setAttribute("src", this.result);
            });
            reader5.readAsDataURL(file5);
            file1Added = 5;
        }
        if (file6 && file1Added == 5) {
            const reader6 = new FileReader();
            previewImage6.style.display = "block";
            previewContainer6.style.display = "block";
            reader6.addEventListener("load", function () {
                previewImage6.setAttribute("src", this.result);
            });
            reader6.readAsDataURL(file6);
            file1Added = 6;
        }
        if (file7 && file1Added == 6) {
            const reader7 = new FileReader();
            previewImage7.style.display = "block";
            previewContainer7.style.display = "block";
            reader7.addEventListener("load", function () {
                previewImage7.setAttribute("src", this.result);
            });
            reader7.readAsDataURL(file7);
            file1Added = 7;
        }
        if (file8 && file1Added == 7) {
            const reader8 = new FileReader();
            previewImage8.style.display = "block";
            previewContainer8.style.display = "block";
            reader8.addEventListener("load", function () {
                previewImage8.setAttribute("src", this.result);
            });
            reader8.readAsDataURL(file8);
            file1Added = 8;
        }
        


    });



</script>

</html>