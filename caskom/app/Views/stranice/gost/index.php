<!DOCTYPE html>
<html>
    <!--Aleksa Vukovic 18/0354 -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/index.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/meni.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gost/body.css'); ?>"/>
  
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
  
</head>
<body>
  <div style="position: fixed; top: 0;left:0; width: 100%; height: 100%; z-index: -1;">
      <video id='vid' width="1920" height="1080" src="../../images/video.mp4"  autoplay loop='true' muted></video>
  </div>
  <div class=ceo_prozor_index_stranica>
    <!--<div class=div_slike_index>
      <div class="slika_index"></div>
    </div>-->
    <div class=div_sa_tekstom>
      <a class='dugme_probaj_besplatno' href="<?php echo base_url('Gost/register')?>">
        <div class=div_teksta_dugme_probaj_besplatno>
          <span class="probaj_besplatno">Probaj BESPLATNO</span>
        </div>
      </a>
      <span class="manji_tekst">Kupi i prodaj sat po najboljim cenama<br />Mi garantujemo originalnost</span>
      <span class="veliki_tekst">Najbolje mesto za kupovinu satova na Balkanu
      </span>
    </div>
    <div class=linija_menija>
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
  </div>
    
</body>

</html>