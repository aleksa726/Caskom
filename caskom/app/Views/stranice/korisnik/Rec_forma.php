<html lang="en">
<!-- Milica Milanovic 0601/18 -->
<!-- Marija Dobric 0417/18 -->
<head>
    <meta charset="utf-8">

    <title>Recenzija</title>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
   <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/korisnik/rec_forma.css'); ?>">
    <script src="<?php echo base_url('css/korisnik/k.js'); ?>"></script>
    </head>
    
<body onload="inic()">
    <div class='overlay'>    
    
    
    <div class=linija_menija id='navbar' style="background-color: transparent; animation: ani33 0.6s linear; height:12vh">
            <div class="moj_profil" style="width: 8.5%; height:80%; ">
                <a href="<?php echo base_url('Korisnik/moj_profil'); ?>" style="margin-left:7vw;">
                    <h2 style="width:10vw !important">Moj profil</h2>
                    <img style="margin-left:-0.75vw; width:18%"src="<?php echo base_url('images/profile_picture.png'); ?>" alt="">
                </a>
            </div>
            <div class=meni_info style="margin-left: 35vw">
                <ul>
                    <li><a href='<?php echo base_url('Korisnik/index'); ?>' class="pocetna_link">Početna</a></li>
                    
                    <li><a href='<?php echo base_url('Korisnik/ponuda'); ?>' class="ponuda">Ponuda</a></li>
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
    <div id=poc>
   <div class=col id=formazarec>
      <div class=col>
        <h1 class='ns'>Recenziraj prodavca</h1>


        <form name="rec", action="<?= site_url("Korisnik/unesi_recenziju") ?>" method="post">
            <input type=text id=idK_kome name=idK_kome style="width: 1px; height:1px;">
         <span class="ocena_broj" style="height:3vh; color: #c2983d; font-size: 0.9vw; font-weight: bold; margin-top: 4vh; margin-bottom: 2vh;">Ocena(od 1 do 5):</span>
       <input type="number" name="ocena" class="polje_za_unos" placeholder="Unesite ocenu">
       <span class="poruka"style="color: red"><?php if(!empty($errors['ocena'])) echo $errors['ocena']; ?></span> 
      <?php if(isset($poruka)) echo "<font color='red'></br>$poruka</font>"; ?>

     <span class="ocena_broj" style="color: #c2983d; font-size: 1.2vw; font-weight: bold; margin-top: 2vh; margin-bottom: 2vh;">Komentar:</span>
     <textarea type="text" name="tekst" class="polje_za_unos" placeholder="Unesite komentar"></textarea>
      <span class="poruka"style="color: red; margin-top:2vh;"><?php if(!empty($errors['tekst'])) echo $errors['tekst']; ?>
      <div class="div_prikazi_sve">


          <button class="dugme_dalje" type=submit><span class='text_dugmeta'>Pošalji recenziju</span></button>

        </div>
     </form>

     </div>


    </div>
 </div>
        </div>
</body>
</html>
