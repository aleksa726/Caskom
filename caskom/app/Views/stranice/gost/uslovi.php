<!DOCTYPE html>
<!-- Milica Milanovic 0601/18 -->
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/meni.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/body.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/uslovi.css'); ?>"/>
</head>
<body>
    <div class="div_prijave">
        <div class="overlay">
            <div class=linija_menija id='navbar' style="height: 40vh;  top:-30vh; margin-left: 5vw;"
                onmouseout="nothovered2()" onmouseover="hovered2()">
                
                <div class=prijava_registracija>
                    <a href="<?php echo base_url('Gost/login')?>" class="prijavi_se">Prijavi se</a>
                  <div class="linija"></div>
                  <a class='link_registracija' href="<?php echo base_url('Gost/register')?>">
                    <div class=dugme_registruj>
                      <span class="registruj_se">Registruj se</span>
                    </div>
                  </a>
                </div>
                <div class=meni_info>
                  <ul>
                    <li><a href='<?php echo base_url('Gost/pocetna')?>' class="pocetna_link">Početna</a></li>
          
          <li><a href='<?php echo base_url('Gost/ponuda')?>' class="ponuda">Ponuda</a></li>

                  </ul>
                </div>
                <div class=logo_naziv>
                  <a href="<?php echo base_url('Gost/index'); ?>">
                    <div class='logo_wrapper'>
                      <h2 class="naziv">ČASKOM</h2>
                    </div>
                  </a>
                </div>
              </div>
            <div class="unutrasnji_div_prijave" style="width:60vw">
                <div class="prijava_gornji_deo" style="margin-bottom: 5vh;">
                    <span class="prijavi_se_tekst">Uslovi korišćenja </span>
                </div>
                <span style="font-size: 0.85vw; letter-spacing: 1.5px; font-style: italic;" id=l1>Opštim uslovima korišćenja sajta se pre svega reguliše način upotrebe sajta. Pojam upotrebe se prvenstveno osnosi na definisanje ugovarača tj. vas kao vlasnika sajta (privatni, poslovni sajt, ime pojedinca, naziv firme itd), šta od podataka prikuplja sajt (tzv. kolačići ili ako je u pitanju druga vrsta podataka i kako se oni koriste), zavisno od vrste sajta uslovi pod kojima se delatnost obavlja (elektronska trgovina – način poslovanja, dostave, plaćanja itd), autorsko pravo (način prenošenja sadržaja na druge sajtove ili apsolutna zabrana, analogno primenjivo i na fotografije, tekstove, video materijal, audio materijal i bilo šta drugo što je predmet autorskog ili srodnih prava) i slično.

Opštim uslovima se može ugovoriti nadležnost suda, može se odreći mnogih stvari (mnogih, doduše, ne može), može se iskazati stav ili poruka (odricanje od autorskih prava, davanje sadržaja pod određenim „licencama” kao što su Creative Commons, GNU GPL, kao i definisanje načina i uslova prelaska sadržaja u javnu svojinu).



Vaš pristup, kao i korišćenje ovog našeg internet sajta (u daljem tekstu „sajt“) podleže ovim uslovima korišćenja i važećim zakonskim propisima koji uređuju ovu oblast. Pristupom i korišćenjem sajta, prihvatate bez ograničenja, ove uslove korišćenja. Ukoliko ne prihvatate ove uslove korišćenja bez ograničenja, molimo Vas da napustite sajt.

Intelektualna svojina

Sajt i svi tekstovi, logotipi, grafika, slike, audio i video materijal i ostali materijal na ovom internet sajtu (u daljem tekstu „Sadržaj“), jesu autorsko pravo ili vlasništvo ČASKOM-a ili su na sajt postavljeni uz dozvolu vlasnika ili ovlašćenog nosioca prava. 
ČASKOM zadržava sva registrovana i neregistrovana autorska prava na sajtu.
Dozvoljeno je pregledanje, deljenje na društvanim mrežama ili štampanje stranica sa sajta za lične, naučne, neprofitabilne i nekomercijalne namene.
Dozvoljeno je krišćenje i publikovanje informacija ili delova tekstova u nekomercijalne, neprofitabilne ili naučne svrhe uz precizno navodjenje sajta ČASKOM-a kao izvora podataka.

Nije dozvoljeno modifikovanje, kopiranje, reprodukcija, objavljivanje niti prodaja bilo kog materijala uključujući grafiku, ilustracije, tekst, informacije ili usluge dostupne na sajtu bez prethodne pismene dozvole ČASKOM-a.

ČASKOM će zaštiti svoja autorska prava, svoja prava intelektualne svojine i ostala srodna prava, kao i druga prava, u najvećoj meri dozvoljenoj zakonom, uključujući i krivično gonjenje.

Izuzeće od odgovornosti

Sajt koristite na sopstveni rizik. ČASKOM nije odgovorana za materijalnu ili nematerijalnu štetu, direktnu ili indirektnu koja nastane iz korišćenja ili je u nekoj vezi sa korišćenjem Sajta ili njegovog sadržaja.

Promena Sajta bez prethodne najave

Ovaj sajt je dinamičan i vremenom će se menjati bez prethodne najave. Korisnici ovog sajta su stoga u potpunosti odgovorni za proveru tačnosti, potpunosti i podobnosti sadržaja koji se na njemu nalaze.

Izmene ovih uslova korišćenja

ČASKOM zadržava pravo da izmeni ove uslove korišćenja u bilo kom trenutku.

</span>
            </div>
        </div>
</body>
<script>

    function hovered2() {
        document.getElementById("navbar").style.transitionDuration = "0.6s";
        document.getElementById("navbar").style.top = "-13.8vh";
    }
    function nothovered2() {
        document.getElementById("navbar").style.height = "40vh";
        document.getElementById("navbar").style.top = "-30vh";
    }

</script>
</html>