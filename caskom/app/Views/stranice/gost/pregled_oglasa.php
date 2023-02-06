<html lang="en">
<!--Aleksa Vukovic 18/0354 -->
<head>
    <meta charset="utf-8">

    <title>Ponuda</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">

   
    <link rel="stylesheet" href="<?php echo base_url('css/gost/meni.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/pregled_oglasa.css'); ?>">
 <script src="<?php echo base_url('css/korisnik/k.js'); ?>"></script>

</head>

<body onload="cena()">
    <div class="displej_cele_slike" id="displej" onclick="prikazProzora()" scroll="no">
        <div class="div_slike_celog_displeja">
            <?php 
                $cntSlika=0;
                foreach($slike as $slika){
                    if($cntSlika == 0){
                        $putanja = base_url("/$slika->putanja");
                        echo " <img src='$putanja' onmouseover='postaviOgranicenje()' onmouseout='ponistiOgranicenje()'>";
                    }
                    $cntSlika++;
            }?>
           
        </div>
    </div>

    <div class="cela_strana_moj_profil" id="cela_strana_moj_profil">



        <div class="hoverzone" id='hoverzone' onmouseover="hovered()" style="height: 10vh;"></div>


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
                    
                    <li><a href='<?php echo base_url('Gost/ponuda'); ?>' class="ponuda">Ponuda</a></li>
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
            <div class="div_pregleda">
                <div class="div_naslova_pregleda">
                    <?php echo "<span class='span_naslova_oglasa'>  $oglas->naslov</span>";?>
                </div>
                <div class="div_slika_i_informacija">
                    <div class="levo_slike">
                        <div class="div_glavne_slike" onclick="prikazivanjeSlike()">
                            <?php 
                            $cntSlika=0;
                            foreach($slike as $slika){
                                if($cntSlika == 0){
                                    $putanja = base_url("/$slika->putanja");
                                    echo "<img src=\"$putanja\" id='glavnaSlika'>";
                                }
                                $cntSlika++;
                            }?>
                        </div>
                        <div class="div_sporedne_slike">
                            <?php 
                            $cnt=1;
                            foreach($slike as $slika){
                                $putanja = base_url("/$slika->putanja");
                                echo "<div class='div_male_slike' id=\"malaSlika$cnt\">
                                    <img src=\"$putanja\">
                                </div>";
                                $cnt++;
                            }?>
                            
                        </div>
                    </div>
                    <div class="desno_informacije">
                        <?php echo "<h2 class='cena_h2'>  $oglas->cena$</h2>";?>
                        <a href="<?php echo base_url("Gost/korisnik/$korisnik->idK")?>"><?php echo "<span class='prodavac'>$korisnik->korisnicko_ime</span>"?></a>
                        <span class="ocena_prodavca">
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
                            } ?>
                        </span>
                      <script>
   
    localStorage.setItem('mejl','<?php echo $korisnik->e_mail?>');
    if(<?php echo $korisnik->vidljiv_telefon?>=="1")
    {localStorage.setItem('fon','<?php echo $korisnik->telefon?>');}
    localStorage.setItem('idKkome','<?php echo $korisnik->idK?>');

</script>





                   
                          
                      <a href="<?php echo base_url('Gost/register'); ?>">
                            <div class="dugme_kontakt">
                                <span>Kontakt</span>
                            </div>
                        </a>
                        <div class="informacije_o_satu">
                            <div class="jedan_element_opisa" style="border-top: 1px gray solid;">
                                <span class="element_opisa">Brend</span>
                                <?php echo "<span class='atribut_opisa'>$oglas->brend</span>"?>
                            </div>
                            <div class="jedan_element_opisa">
                                <span class="element_opisa">Model</span>
                                 <?php echo "<span class='atribut_opisa'>$oglas->model</span>"?>
                            </div>
                            <div class="jedan_element_opisa">
                                <span class="element_opisa">Stanje</span>
                                 <?php echo "<span class='atribut_opisa'>$oglas->stanje</span>"?>
                            </div>
                            <div class="jedan_element_opisa">
                                <span class="element_opisa">Velicina kucista</span>
                                <?php echo "<span class='atribut_opisa'>$oglas->velicina_kucista</span>"?>
                            </div>
                            <div class="jedan_element_opisa">
                                <span class="element_opisa">Materijal kucista</span>
                                <?php echo "<span class='atribut_opisa'>$oglas->materijal_kucista</span>"?>
                            </div>
                            <div class="jedan_element_opisa">
                                <span class="element_opisa">Materijal narukvice</span>
                                 <?php echo "<span class='atribut_opisa'>$oglas->materijal_narukvice</span>"?>
                            </div>
                            <div class="jedan_element_opisa">
                                <span class="element_opisa">Mehanizam</span>
                                <?php echo "<span class='atribut_opisa'>$oglas->mehanizam</span>"?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="opis_oglasa">
                    <div class="opis_oglasa2">
                        <?php echo "<span class='tekst_opisa'>$oglas->opis</span>"?>
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
    let displej = document.querySelector("#displej");
    let child = displej.childNodes;
    let child1 = child[1];
    let imgDisplej = child1.childNodes[1]
    let imgGlavna = document.querySelector("#glavnaSlika");
    let img1 = document.querySelector("#malaSlika1");
    let img2 = document.querySelector("#malaSlika2");
    let img3 = document.querySelector("#malaSlika3");
    let img4 = document.querySelector("#malaSlika4");
    let img5 = document.querySelector("#malaSlika5");
    let img6 = document.querySelector("#malaSlika6");
    let img7 = document.querySelector("#malaSlika7");
    let img8 = document.querySelector("#malaSlika8");
    img1.addEventListener('click', () => {
        let c = img1.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
    img2.addEventListener('click', () => {
        let c = img2.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
    img3.addEventListener('click', () => {
        let c = img3.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
    img4.addEventListener('click', () => {
        let c = img4.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
    img5.addEventListener('click', () => {
        let c = img5.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
    img6.addEventListener('click', () => {
        let c = img6.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
    img7.addEventListener('click', () => {
        let c = img7.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
    img8.addEventListener('click', () => {
        let c = img8.childNodes;
        imgGlavna.src = c[1].src;
        imgDisplej.src = imgGlavna.src;
    })
</script>

<script>
    var ogranicenje = 0;
    function prikazivanjeSlike() {
        var displej = document.getElementById("displej");
        var cela_strana_moj_profil = document.getElementById("cela_strana_moj_profil");
        cela_strana_moj_profil.style.filter = "blur(5px)";
        cela_strana_moj_profil.style.webkitFilter = "blur(5px)";
        displej.style.visibility = "visible";
        displej.style.opacity = "1";
    }
    function prikazProzora() {
        if (ogranicenje == 0) {
            cela_strana_moj_profil.style.filter = "blur(0px)";
            cela_strana_moj_profil.style.webkitFilter = "blur(0px)";

            displej.style.opacity = "0";
            displej.style.visibility = "hidden";
        }
    }
    function postaviOgranicenje() {
        ogranicenje = 1;
    }
    function ponistiOgranicenje() {
        ogranicenje = 0;
    }
</script>

</html>