<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Ponuda</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('css/gost/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/ponuda.css'); ?>">

</head>

<body onload="cena()">
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
                <a href="<?php echo base_url('Gost/index'); ?>">
                    <div class='logo_wrapper'>
                        
                        <h2 class="naziv" style="font-weight:bold">ČASKOM</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="wrapper_search">
            <div class="orkuzujuci_div_search_bar">
                <div class='div_search_bar'>

                    <form name="pretragaOglasa" method="get" action="<?php echo site_url("Gost/pretraga")?>" >
                        
                        <input class="search__input"  name="pretraga" type="text" placeholder="Pretrazi" autocomplete="off">
                    </form>
                </div>
            </div>
        </div>
        <div class="wrapper_moj_profil">
            <div class="levo_moj_profil">


                <form method="get" action="<?php echo site_url("Gost/filtriranje")?>">
                
                <div class="div_filtriranja">

                    <div class="element_filtriranja" style="margin-top: 3vh;" onclick="toggleListaBrendova()">

                        <span class="tekst_elementa">
                            Brend
                        </span>

                    </div>

                    <div id="listaBrendova" class="lista_izbora">
                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="brend[]" class="checkbox1" id="checkbox1" value="Rolex"> <span class="labela">
                                        Rolex</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="brend[]" class="checkbox1" id="checkbox1" value="Audemars Piguet"> <span class="labela">
                                        Audemars Piguet</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox"  name="brend[]" class="checkbox1" id="checkbox1" value="Patek Philippe"> <span class="labela">
                                        Patek Philippe</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="brend[]" class="checkbox1" id="checkbox1" value="Hublot"> <span class="labela">
                                        Hublot</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox"  name="brend[]" class="checkbox1" id="checkbox1" value="Longines"> <span class="labela">
                                        Longines</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="brend[]" class="checkbox1" id="checkbox1" value="Jacob & Co."> <span class="labela">
                                        Jacob & Co.</span>
                                </label>

                            </div>
                        </div>


                    </div>

                    <div class="element_filtriranja" onclick="toggleListaModela()">
                        <span class="tekst_elementa">
                            Model
                        </span>
                    </div>

                    <div id="listaModela" class="lista_izbora">
                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="model[]"class="checkbox1" id="checkbox1" value="Submariner"> <span class="labela">
                                        Submariner</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="model[]" class="checkbox1" id="checkbox1" value="Nautilus"> <span class="labela">
                                        Nautilus</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="model[]" class="checkbox1" id="checkbox1" value="Astronomia"> <span class="labela">
                                        Astronomia</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="model[]"  class="checkbox1" id="checkbox1" value="Seamaster"> <span class="labela">
                                        Seamaster</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="model[]" class="checkbox1" id="checkbox1" value="Royal Oak"> <span class="labela">
                                        Royal Oak</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="model[]"class="checkbox1" id="checkbox1" value="Datejust"> <span class="labela">
                                        Datejust</span>
                                </label>

                            </div>
                        </div>


                    </div>

                    <div class="element_filtriranja" onclick="toggleListaStanja()">
                        <span class="tekst_elementa">
                            Stanje sata
                        </span>
                    </div>

                    <div id="listaStanja" class="lista_izbora" style="margin-bottom: -17vh;">
                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="stanje[]" class="checkbox1" id="checkbox1" value="Mint"> <span class="labela">
                                        Mint</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="stanje[]" class="checkbox1" id="checkbox1" value="Veoma dobro"> <span class="labela">
                                        Veoma dobro</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="stanje[]" class="checkbox1" id="checkbox1" value="Dobro"> <span class="labela">
                                        Dobro</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="stanje[]" class="checkbox1" id="checkbox1" value="Lose"> <span class="labela">
                                        Lose</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="stanje[]" class="checkbox1" id="checkbox1" value="Vintage"> <span class="labela">
                                        Vintage</span>
                                </label>

                            </div>
                        </div>


                    </div>

                    <div class="element_filtriranja" onclick="toggleVelicina()">
                        <span class="tekst_elementa">
                            Velicina kucista
                        </span>
                    </div>

                    <div id="listaVelicina" class="lista_izbora" style="margin-bottom: 3vh;">
                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <input type="number" name="velicina_kucista">
                                <span class="labela" style="cursor: pointer; ">mm</span>
                            </div>
                        </div>




                    </div>


                    <div class="element_filtriranja" onclick="toggleListaMaterijalKucista()">
                        <span class="tekst_elementa">
                            Materijal kucista
                        </span>
                    </div>

                    <div id="listaMaterijalKucista" class="lista_izbora" style="margin-bottom: -27vh;">
                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_kucista[]" class="checkbox1" id="checkbox1" value="Celik"> <span class="labela">
                                        Celik</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_kucista[]" class="checkbox1" id="checkbox1" value="Zuto zlato"> <span class="labela">
                                        Zuto zlato</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_kucista[]" class="checkbox1" id="checkbox1" value="Belo zlato"> <span class="labela">
                                        Belo zlato</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_kucista[]" class="checkbox1" id="checkbox1" value="Roze zlato"> <span class="labela">
                                        Roze zlato</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_kucista[]" class="checkbox1" id="checkbox1" value="Titanijum"> <span class="labela">
                                        Titanijum</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_kucista[]" class="checkbox1" id="checkbox1" value="Platina"> <span class="labela">
                                        Platina</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" class="checkbox1" name="materijal_kucista[]" id="checkbox1" value="Plastika"> <span class="labela">
                                        Plastika</span>
                                </label>

                            </div>
                        </div>


                    </div>

                    <div class="element_filtriranja" onclick="toggleListaMaterijalNarukvice()">
                        <span class="tekst_elementa">
                            Materijal narukvice
                        </span>
                    </div>

                    <div id="listaMaterijalNarukvice" class="lista_izbora" style="margin-bottom: -27vh;">
                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_narukvice[]" class="checkbox1" id="checkbox1" value="Celik"> <span class="labela">
                                        Celik</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_narukvice[]" class="checkbox1" id="checkbox1" value="Zuto zlato"> <span class="labela">
                                        Zuto zlato</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_narukvice[]" class="checkbox1" id="checkbox1" value="Belo zlato"> <span class="labela">
                                        Belo zlato</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_narukvice[]" class="checkbox1" id="checkbox1" value="Roze zlato"> <span class="labela">
                                        Roze zlato</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_narukvice[]" class="checkbox1" id="checkbox1" value="Titanijum"> <span class="labela">
                                        Titanijum</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_narukvice[]" class="checkbox1" id="checkbox1" value="Platina"> <span class="labela">
                                        Platina</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="materijal_narukvice[]" class="checkbox1" id="checkbox1" value="Plastika"> <span class="labela">
                                        Plastika</span>
                                </label>

                            </div>
                        </div>


                    </div>

                    <div class="element_filtriranja" onclick="toggleListaMehanizam()">
                        <span class="tekst_elementa">
                            Mehanizam sata
                        </span>
                    </div>

                    <div id="listaMehanizama" class="lista_izbora" style="margin-bottom: -12vh;">
                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="mehanizam[]" class="checkbox1" id="checkbox1" value="Automatik"> <span class="labela">
                                        Automatik</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="mehanizam[]" class="checkbox1" id="checkbox1" value="Quartz"> <span class="labela">
                                        Quartz</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="mehanizam[]" class="checkbox1" id="checkbox1" value="Spring drive"> <span class="labela">
                                        Spring drive</span>
                                </label>

                            </div>
                        </div>

                        <div class="div_jednog_izbora">
                            <div class="checkbox_i_labela">
                                <label><input type="checkbox" name="mehanizam[]" class="checkbox1" id="checkbox1" value="Digitalni"> <span class="labela">
                                        Digitalni</span>
                                </label>

                            </div>
                        </div>


                    </div>

                    <div class="element_filtriranja" onclick="toggleListaCena()">
                        <span class="tekst_elementa">
                            Cena
                        </span>
                    </div>

                    <div id="listaCene" class="lista_izbora" style="margin-bottom: -3vh;">
                        <div class="div_jednog_izbora">
                            <div class="slidecontainer">
                                <input type="range" name="cena" min="1" max="100" value="100" class="slider" id="myRange"
                                     />

                            </div>
                        </div>
                        <output for="myRangeCena" class="output">100,000 $</output>

                    </div>
                    
                    <button type="submit" name="filterSubmit" class="submit_filtriranje">
                        <h3>Filtriraj</h3>
                    </button>
                </div>
                </form>

            </div>

            
         
            <div class="desno_moj_profil">

                <div class="odeljak_oglasa">
                <?php 
                
                if($korisnici != null){
                    $putanja = base_url('../../images/profile_picture.png');
                    foreach($korisnici as $korisnik){
                        if(((isset($korisnik->apr) && $korisnik->odobren) || !isset($korisnik->apr)) && !$korisnik->banovan){
                            
                            echo "
                                <div class='moji_istaknuti_oglasi' >
                                    <div class='div_oglasa korisnik_div'>

                                        <a class='link_za_klik' href='korisnik/$korisnik->idK'>
                                            <div style='background-size:70%; background-image: url($putanja);' class='div_fotografije_oglasa'></div>
                                            <div class='div_naslova_i_cene_istaknuti'>

                                                <h2 class='cena_oglasa_istaknuti' style='margin-top:4vh;'>$korisnik->korisnicko_ime</h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>";
                        }
                    }
                }
                
                
                if(isset($oglasi)){
                  $cnt = 0;
                 
                  foreach ($oglasi as $oglas) {
                   $fotografija = $fotografije[$cnt];
                        $putanja = base_url('../../images/generic_watch.png');
                        $putanjaObican = base_url('../../images/generic_watch_light.png');
                        $putanjapom = base_url('../../images/generic_watch.png');
                        if($fotografija != null){
                            $putanja = base_url("/$fotografija->putanja");
                            $putanjaObican = base_url("/$fotografija->putanja");
                        }
                        $stil = "";
                        if($putanja == $putanjapom){
                            $stil = "background-size:70%;";
                        }
                        $urlOglasa = site_url("Gost/oglas/$oglas->idO");
                       if($oglas->boostovan == true){
                      
                        
                        echo "
                        <div class='moji_istaknuti_oglasi' >
                            <div class='div_oglasa istaknuti_div'>
                                
                              
                                <a class='link_za_klik' href='$urlOglasa'>
                                    <div style='$stil background-image: url($putanja);' class='div_fotografije_oglasa'></div>
                                    <div class='div_naslova_i_cene_istaknuti'>
                                        <h2 class='nalov_oglasa_istaknuti istaknuti_naslov'>$oglas->naslov</h2>
                                        <h2 class='cena_oglasa_istaknuti istaknuta_cena'>$oglas->cena$</h2>
                                    </div>
                                </a>
                            </div>
                        </div>";
                        }
                        else{
                           
                            echo "
                            <div class='moji_istaknuti_oglasi' >
                                <div class='div_oglasa'>
                                  
                                    <a class='link_za_klik' href='$urlOglasa'>
                                        <div style='$stil background-image: url($putanjaObican);' class='div_fotografije_oglasa'></div>
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
                  if($cnt == 0){
                      echo "<h1>Nema trenutno dostupnih oglasa</h1>";
                  }
                }
                else{
                      echo "<h1>Nema trenutno dostupnih oglasa</h1>";
                }
                
                
                ?>
                   
                   
                    
                    <div class="div_dugme_pretplati_se">    
                        <a href="<?php  $page=$page-2;  echo base_url("Gost/ponuda/$page"); ?>">
                            <div class="dugme_pretplati_se">
                                <h3>&lt Prethodna</h3>
                            </div>
                        </a>
                    
                    
                    
                        <a href="<?php if(count($oglasi)==16) {$page=$page+2; echo base_url("Gost/ponuda/$page");} ?>">
                            <div class="dugme_pretplati_se">
                                <h3>Sledeca ></h3>
                            </div>
                        </a>
                    </div>
                    
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
    var listaBrendova = document.getElementById("listaBrendova");
    var listaModela = document.getElementById("listaModela");
    var listaStanja = document.getElementById("listaStanja");
    var listaMaterijalaKucista = document.getElementById("listaMaterijalKucista");
    var listaMaterijalaNarukvice = document.getElementById("listaMaterijalNarukvice");
    var listaMehanizam = document.getElementById("listaMehanizama");
    var listaVelicina = document.getElementById("listaVelicina");
    var listaCene = document.getElementById("listaCene");
    function toggleListaBrendova() {
        if (listaBrendova.style.visibility == "hidden") {
            listaBrendova.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaBrendova.style.visibility = "visible";
            listaBrendova.style.marginTop = "-3vh";
            listaBrendova.style.opacity = "1";
            listaBrendova.style.marginBottom = "2vh";
        }
        else {
            listaBrendova.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaBrendova.style.visibility = "hidden";
            listaBrendova.style.marginTop = "-7vh";
            listaBrendova.style.opacity = "0";
            listaBrendova.style.marginBottom = "-22vh"
        }
    }
    function toggleListaModela() {
        if (listaModela.style.visibility == "hidden") {
            listaModela.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaModela.style.visibility = "visible";
            listaModela.style.marginTop = "-3vh";
            listaModela.style.opacity = "1";
            listaModela.style.marginBottom = "2vh";
        }
        else {
            listaModela.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaModela.style.visibility = "hidden";
            listaModela.style.marginTop = "-7vh";
            listaModela.style.opacity = "0";
            listaModela.style.marginBottom = "-22vh"
        }
    }
    function toggleListaStanja() {
        if (listaStanja.style.visibility == "hidden") {
            listaStanja.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaStanja.style.visibility = "visible";
            listaStanja.style.marginTop = "-3vh";
            listaStanja.style.opacity = "1";
            listaStanja.style.marginBottom = "2vh";
        }
        else {
            listaStanja.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaStanja.style.visibility = "hidden";
            listaStanja.style.marginTop = "-7vh";
            listaStanja.style.opacity = "0";
            listaStanja.style.marginBottom = "-17vh"
        }
    }
    function toggleListaMaterijalKucista() {
        if (listaMaterijalaKucista.style.visibility == "hidden") {
            listaMaterijalaKucista.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaMaterijalaKucista.style.visibility = "visible";
            listaMaterijalaKucista.style.marginTop = "-3vh";
            listaMaterijalaKucista.style.opacity = "1";
            listaMaterijalaKucista.style.marginBottom = "2vh";
        }
        else {
            listaMaterijalaKucista.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaMaterijalaKucista.style.visibility = "hidden";
            listaMaterijalaKucista.style.marginTop = "-7vh";
            listaMaterijalaKucista.style.opacity = "0";
            listaMaterijalaKucista.style.marginBottom = "-27vh"
        }
    }
    function toggleListaMaterijalNarukvice() {
        if (listaMaterijalaNarukvice.style.visibility == "hidden") {
            listaMaterijalaNarukvice.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaMaterijalaNarukvice.style.visibility = "visible";
            listaMaterijalaNarukvice.style.marginTop = "-3vh";
            listaMaterijalaNarukvice.style.opacity = "1";
            listaMaterijalaNarukvice.style.marginBottom = "2vh";
        }
        else {
            listaMaterijalaNarukvice.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaMaterijalaNarukvice.style.visibility = "hidden";
            listaMaterijalaNarukvice.style.marginTop = "-7vh";
            listaMaterijalaNarukvice.style.opacity = "0";
            listaMaterijalaNarukvice.style.marginBottom = "-27vh"
        }
    }
    function toggleListaMehanizam() {
        if (listaMehanizam.style.visibility == "hidden") {
            listaMehanizam.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaMehanizam.style.visibility = "visible";
            listaMehanizam.style.marginTop = "-3vh";
            listaMehanizam.style.opacity = "1";
            listaMehanizam.style.marginBottom = "2vh";
        }
        else {
            listaMehanizam.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaMehanizam.style.visibility = "hidden";
            listaMehanizam.style.marginTop = "-7vh";
            listaMehanizam.style.opacity = "0";
            listaMehanizam.style.marginBottom = "-12vh"
        }
    }
    function toggleVelicina() {
        if (listaVelicina.style.visibility == "hidden") {
            listaVelicina.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaVelicina.style.visibility = "visible";
            listaVelicina.style.marginTop = "-3vh";
            listaVelicina.style.opacity = "1";
            listaVelicina.style.marginBottom = "2vh";
        }
        else {
            listaVelicina.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaVelicina.style.visibility = "hidden";
            listaVelicina.style.marginTop = "-7vh";
            listaVelicina.style.opacity = "0";
            listaVelicina.style.marginBottom = "3vh"
        }
    }
    function toggleListaCena() {
        if (listaCene.style.visibility == "hidden") {
            listaCene.style.transition = "opacity 0.3s ease-in 0.15s,margin-top 0.6s, visibility 0.6s, margin-bottom 0.4s ease-out";
            listaCene.style.visibility = "visible";
            listaCene.style.marginTop = "-3vh";
            listaCene.style.opacity = "1";
            listaCene.style.marginBottom = "3vh";
        }
        else {
            listaCene.style.transition = "opacity 0.15s, margin-top 0.6s, visibility 0.6s, margin-bottom 0.5s ease-in";
            listaCene.style.visibility = "hidden";
            listaCene.style.marginTop = "-7vh";
            listaCene.style.opacity = "0";
            listaCene.style.marginBottom = "-3vh"
        }
    }
</script>

<script>
    document.getElementById("myRange").oninput = function () {
        var value = (this.value - this.min) / (this.max - this.min) * 100;
        this.style.background = 'linear-gradient(to right, #c2983d 0%, #c2983d ' + value + '%, #fff ' + value + '%, white 100%)';
    };
    function cena() {
        var myRange = document.getElementById("myRange");
        var value = (myRange.value - myRange.min) / (myRange.max - myRange.min) * 100;
        myRange.style.background = 'linear-gradient(to right,#c2983d 0%, #c2983d ' + value + '%, #fff ' + value + '%, white 100%)';
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#myRange').on("input", function () {
        $('.output').val(this.value + ",000 $");
    }).trigger("change");
</script>

</html>