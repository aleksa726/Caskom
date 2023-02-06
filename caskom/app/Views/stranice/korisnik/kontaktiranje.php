<html lang="en">
<!-- Milica Milanovic 0601/18 -->
    <head>
        <meta charset="utf-8">
    
        <title>Moj profil</title>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        
    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('css/korisnik/meni_prijavljen.css'); ?>">
      
        <link rel="stylesheet" href="<?php echo base_url('css/korisnik/body.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/korisnik/kontaktiranje.css'); ?>">
        <script src="<?php echo base_url('css/korisnik/k.js'); ?>"></script>
    </head>
    
    <body onload="inic()" >
        <div class='overlay'>
        <div class="cela_strana_moj_profil">
    
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
    
   </div>
            
        
        
        <div id=br1 class=row>

            <div id=br3 class=col>
                <button class="dugme_dalje" id=b1 ><span class='text_dugmeta' style='letter-spacing: 0.13vw;'>Kontaktiraj putem mail-a</span></button><br>
                 <div id=br2 class=col style='opacity:0'>
                     <textarea type=text id=poljeMejl placeholder="Poštovani korisniče, zainteresovan/a sam za Vaš oglas. "></textarea>
                     <button  class="malo_dugme" style="margin-top:2vh;" onclick="redirect()" id=b3><span class='link1'>Posalji mejl</span></button>
                     <button  class="malo_dugme"  id=b3><a href="<?php echo base_url('Korisnik/rec'); ?>" class="link1">Oceni prodavca</a></button>
                 </div>
            </div>
             <form name="loginform", action="<?= site_url("Korisnik/prikazFormeMejl") ?>" method="post">
             </form>      
            <div id=br5 class=col>
                <button  class="dugme_dalje" id=b2><span class='text_dugmeta' style='letter-spacing: 0.13vw;'>Prikaži broj telefona</span></button>

                <div id=br4 class=col style='opacity:0'>
                   <label name='telefon'id='telefon'></label>
                   <button  class="malo_dugme"  id=b3 > <a href="<?php echo base_url('Korisnik/rec'); ?>" class="link1">Oceni prodavca</a></button>
               </div>
            </div>
         </div>
  </div>
</body>